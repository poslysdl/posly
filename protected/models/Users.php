<?php
/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property integer $user_details_id
 * @property integer $user_location_id
 * @property integer $user_socialmedia_id
 * @property integer $user_hashtags_id
 * @property integer $user_notification_id
 * @property integer $user_language_id
 * @property integer $user_ethnicity_id
 * @property integer $user_security_id
 *
 * The followings are the available model relations:
 * @property Albums[] $albums
 * @property LogPhotosComment[] $logPhotosComments
 * @property LogPhotosHearts[] $logPhotosHearts
 * @property LogPhotosShare[] $logPhotosShares
 * @property UsersSecurity $userSecurity
 * @property UsersDetails $userDetails
 * @property UsersLocation $userLocation
 * @property UsersSocialmedia $userSocialmedia
 * @property UsersHashtags $userHashtags
 * @property UsersNotification $userNotification
 * @property UsersLanguage $userLanguage
 * @property UsersEthnicity $userEthnicity
 * @property UsersDetails[] $usersDetails
 * @property UsersFollow[] $usersFollows
 * @property UsersFollow[] $usersFollows1
 * @property UsersHashtags[] $usersHashtags
 * @property UsersSecurity[] $usersSecurities
 */
 
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_details_id, user_location_id, user_socialmedia_id, user_hashtags_id, user_notification_id, user_language_id, user_ethnicity_id, user_security_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, user_details_id, user_location_id, user_socialmedia_id, user_hashtags_id, user_notification_id, user_language_id, user_ethnicity_id, user_security_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'albums' => array(self::HAS_MANY, 'Albums', 'user_id'),
			'photos' => array(self::HAS_MANY, 'Photos', 'user_id'),
			'logPhotosComments' => array(self::HAS_MANY, 'LogPhotosComment', 'user_id'),
			'logPhotosHearts' => array(self::HAS_MANY, 'LogPhotosHearts', 'user_id'),
			'logPhotosShares' => array(self::HAS_MANY, 'LogPhotosShare', 'user_id'),
			'userSecurity' => array(self::BELONGS_TO, 'UsersSecurity', 'user_security_id'),
			'userDetails' => array(self::BELONGS_TO, 'UsersDetails', 'user_details_id'),
			'userLocation' => array(self::BELONGS_TO, 'UsersLocation', 'user_location_id'),
			'userSocialmedia' => array(self::BELONGS_TO, 'UsersSocialmedia', 'user_socialmedia_id'),
			//'userHashtags' => array(self::BELONGS_TO, 'UsersHashtags', 'user_hashtags_id'),
			'userNotification' => array(self::BELONGS_TO, 'UsersNotification', 'user_notification_id'),
			'userLanguage' => array(self::BELONGS_TO, 'UsersLanguage', 'user_language_id'),
			'userEthnicity' => array(self::BELONGS_TO, 'UsersEthnicity', 'user_ethnicity_id'),
			'userSocialPrivacy' => array(self::BELONGS_TO, 'UserSocialPrivacy', 'user_social_privacy_id'),
			//'usersDetails' => array(self::HAS_MANY, 'UsersDetails', 'user_id'),
			'usersFollows' => array(self::HAS_MANY, 'UsersFollow', 'follow_id'),
			'usersFollows1' => array(self::HAS_MANY, 'UsersFollow', 'user_id'),
			'usersHashtags' => array(self::HAS_MANY, 'UsersHashtags', 'user_id'),
			//'usersSecurities' => array(self::HAS_MANY, 'UsersSecurity', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_details_id' => 'User Details',
			'user_location_id' => 'User Location',
			'user_socialmedia_id' => 'User Socialmedia',
			'user_hashtags_id' => 'User Hashtags',
			'user_notification_id' => 'User Notification',
			'user_language_id' => 'User Language',
			'user_ethnicity_id' => 'User Ethnicity',
			'user_security_id' => 'User Security',
		);
	}
	
	public function findBySocial($provider, $identifier, $email)
	{	
		$checkemail=$this->with('userDetails')->find("userDetails.user_details_email='$email'");		
		$user_socialmedia_id = $checkemail->user_socialmedia_id;
		$checkIdentifier=$this->with('userSocialmedia')->find("userSocialmedia.user_socialmedia_id=$user_socialmedia_id");		
		if(isset($checkemail) && isset($checkIdentifier))
			return $checkIdentifier;
		else
			return null;
   }
 
   // for social user login
   public function findByAuthSocial($provider, $identifier){
     return $this->with('userSocialmedia', 'userDetails')->find("userSocialmedia.user_socialmedia_provider='$provider' and user_socialmedia_identifier=$identifier");
   }
 
   // for normal registered user login
   public function findByAuthUser($username, $password){
   	  $email=strtolower($username);
   	  $pass=$password;
      $user=$this->with('userDetails')->find("userDetails.user_details_email='$email' and userDetails.user_details_password='$pass'");
      return $user; //->password === crypt($password, $user->password)? $user:null;
   }
   
	/* this function is used to find weather, email exists in DB or not
	* Last modified: 01-Sep-14
	*/
	public function findByEmailId($username)
	{
	  $email=strtolower($username);	  
	  $user=$this->with('userDetails')->find("userDetails.user_details_email='$email'");
	  if(is_object($user) && isset($user->user_id))
		return true;
	  else
		return false;	  
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

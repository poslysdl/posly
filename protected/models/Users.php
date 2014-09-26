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
			'userNotification' => array(self::BELONGS_TO, 'UsersNotification', 'user_notification_id'),
			'userLanguage' => array(self::BELONGS_TO, 'UsersLanguage', 'user_language_id'),
			'userEthnicity' => array(self::BELONGS_TO, 'UsersEthnicity', 'user_ethnicity_id'),
			'userSocialPrivacy' => array(self::BELONGS_TO, 'UserSocialPrivacy', 'user_social_privacy_id'),			
			'usersFollows' => array(self::HAS_MANY, 'UsersFollow', 'follow_id'),
			'usersFollows1' => array(self::HAS_MANY, 'UsersFollow', 'user_id'),
			'usersHashtags' => array(self::HAS_MANY, 'UsersHashtags', 'user_id'),			
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
		if(isset($checkemail->user_socialmedia_id)){
			$user_socialmedia_id = $checkemail->user_socialmedia_id;
			$checkIdentifier=$this->with('userSocialmedia')->find("userSocialmedia.user_socialmedia_id=$user_socialmedia_id");
		}
		if(isset($checkemail) && isset($checkIdentifier))
			return $checkIdentifier;
		else
			return null;
	}
	
	public function getUserAge($userId){
		$query = "SELECT ud.user_details_dob FROM `users_details` ud JOIN `users` u ON u.user_details_id = ud.user_details_id";
		$query.=" WHERE u.user_id = :userId ";
		$command= Yii::app()->db->createCommand($query);
		$command->bindParam(":userId", $userId);
		$rawData = $command->queryAll();
		foreach($rawData as $raw){
			$dob = $raw['user_details_dob'];
		}
		if($dob){
			//calculate years of age (input string: YYYY-MM-DD)
			list($year, $month, $day) = explode("-", $dob);		
			$year_diff  = date("Y") - $year;
			$month_diff = date("m") - $month;
			$day_diff   = date("d") - $day;		
			if ($day_diff < 0 || $month_diff < 0)
			$year_diff--;
			return $year_diff;			
		}
		else{
			return false;
		}
		
		exit;
	}
	
	public function getUserInfo($userId){
	//	$data = array();
		 $query = "SELECT UD.*,UL.* FROM users_details UD
						JOIN users U ON U.user_details_id = UD.user_details_id 
					JOIN users_location UL ON U.user_location_id = UL.user_location_id
						WHERE U.user_id = :userId
		";
		$command= Yii::app()->db->createCommand($query);
		$command->bindParam(":userId", $userId);
		$rawData = $command->queryAll();
		return $rawData[0];			
	}  	
 
 
   // for social user login
   public function findByAuthSocial($provider, $identifier){
     return $this->with('userSocialmedia', 'userDetails')->find("userSocialmedia.user_socialmedia_provider='$provider' and userSocialmedia.user_socialmedia_identifier=$identifier");
   }
 
   // for normal registered user login
   public function findByAuthUser($username, $password){
   	  $email=strtolower($username);
   	  $pass=$password;
      $user=$this->with('userDetails')->find("userDetails.user_details_email='$email' and userDetails.user_details_password='$pass'");
      return $user; //->password === crypt($password, $user->password)? $user:null;
   }
   
	/* Get Users Details from their Social identifier
	* Last modified: 09-Sep-14
	*/
	public function findBySocialId($provider, $identifier)
	{
		$query = "SELECT u.user_id FROM `users_socialmedia` uso JOIN `users` u ON u.user_socialmedia_id = uso.user_socialmedia_id";
		$query.=" WHERE uso.user_socialmedia_provider = :provider AND uso.user_socialmedia_identifier = :identifier";	
		$command= Yii::app()->db->createCommand($query);
		$command->bindParam(":provider", $provider);
		$command->bindParam(":identifier", $identifier,PDO::PARAM_INT);		
		$rawData = $command->queryAll();
		if(isset($rawData) && count($rawData)>0)
		{			
			$uid = $rawData[0]['user_id'];
			unset($rawData);
			return $this->with('userSocialmedia', 'userDetails')->findByPk($uid);
		} else{ return NULL; }
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
	
	/* this function is used to check , if user already registered
	* using FB emailId through SignUp with Emailid steps.
	* Then if emailid exits and social_media didn't then go for Update
	* Last modified: 09-Sep-14
	*/
	public function findByFBmailId($username)
	{
		$email=strtolower($username);	
		$criteria=new CDbCriteria;
		$criteria->select='user_id,user_socialmedia_id';		
		$criteria->condition="userDetails.user_details_email=:username";		
		$criteria->params=array(':username'=>$email);		
		$user=$this->with(array('userDetails'=>array('select'=>'user_details_id,user_details_email')))->find($criteria);	
		if(is_object($user) && isset($user->user_id))
		{	
			if(!empty($user->user_socialmedia_id)){
				return true;
			} else{
				return false;
			}
		} else{
			return false;
		}		
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
	
	/**
	 * Name: checkSocialAuth
	 * Will find weather in Socialmedia that provider exits
	 * @param string $provider, Int $identifier .
	 * @return true or false 
	 */
	public function checkSocialAuth($provider, $identifier){	
		$query = "SELECT count(*) as cnt FROM `users_socialmedia` WHERE `user_socialmedia_provider` = :provider AND `user_socialmedia_identifier` = :identifier";		
		$command= Yii::app()->db->createCommand($query);
		$command->bindParam(":provider", $provider);
		$command->bindParam(":identifier", $identifier,PDO::PARAM_INT);		
		$rawData = $command->queryAll();		
		if(!empty($rawData) && isset($rawData[0]['cnt'])){
			if($rawData[0]['cnt']==1)
				return true;
			else
				return false;
		}
		elseif(empty($rawData)){
			return false;
		}
		else{
			return false;
		}		
	}
	
	/**
	 * Name: updateNotificationDate
	 * An User_define function to Update user Read notify date
	 * when user click on Notify icon to read it	 
	 */
	public function updateNotificationDate($uid,$time){		
		$query="UPDATE users SET notification_read_date='".$time."' WHERE user_id='".$uid."'";
		$command= Yii::app()->db->createCommand($query);
		$command->execute();
	}
	
	
		//get user location
	
	function get_profile_location($userId){
		$query = "SELECT UL.user_location_id as locationId, UL.user_location_country AS country, UL.user_location_region AS region, UL.user_location_city AS city   FROM users U JOIN users_location UL ON U.user_location_id = UL.user_location_id WHERE U.user_id = :userId";
		$command = yii::app()->db->createCommand($query);
		$command->bindparam(":userId",$userId);
		$rawData = $command->queryAll();
		return $rawData[0];
	}	

	
	
	//get hearts count
	
	function get_profile_hearts_count($userId){
		$query = "SELECT count(user_id) AS total FROM `log_photos_hearts` WHERE  `owner_id` = :userId";
		$command = yii::app()->db->createCommand($query);
		$command->bindparam(":userId",$userId);
		$rawData = $command->queryAll();
		foreach($rawData as $raw){
			$count = $raw['total'];
		}
		return $count;
	}
	
	//get friends count
	
	function get_profile_friends_count($userId){
		
		$query = "
			SELECT
				 (SELECT count(*) FROM `users_friends` WHERE user_id = :userId AND `status` = 1 )
				 +
				 (SELECT count(*) FROM `users_friends` WHERE `friend_id` = :userId AND `status` = 1)
			AS `total`		
		";
		$command = yii::app()->db->createCommand($query);		
		$command->bindparam(":userId",$userId);
		$rawData = $command->queryAll();
		foreach($rawData as $raw){
			$count = $raw['total'];
		}
		return $count;		
	}
	// get profile following count
	function get_profile_following_count($userId){
		$query = "SELECT count(user_id) AS total FROM `users_follow` WHERE  `user_id` = :userId";
		$command = yii::app()->db->createCommand($query);
		$command->bindparam(":userId",$userId);
		$rawData = $command->queryAll();
		foreach($rawData as $raw){
			$count = $raw['total'];
		}
		return $count;
	}
	
	// get profile following users list
	function get_profile_following_users($userId){
		$query = "SELECT follow_id FROM `users_follow` WHERE  `user_id` = :userId";
		$command = yii::app()->db->createCommand($query);
		$command->bindparam(":userId",$userId);
		$rawData = $command->queryAll();
		$rawCount = count($rawData);
		if($rawCount>0){
			return $rawData;
		}
		else{
			return false;
		}
	}
	
	// get profile follower count	
	
	function get_profile_follower_count($userId){
		$query = "SELECT count(user_id) AS total FROM `users_follow` WHERE  `follow_id` = :follow_id";
		$command = yii::app()->db->createCommand($query);
		$command->bindparam(":follow_id",$userId);
		$rawData = $command->queryAll();
		foreach($rawData as $raw){
			$count = $raw['total'];
		}
		return $count;
	}
	
	
	// get profile follower users list	
	
	function get_profile_follower_users($userId){
		$query = "SELECT user_id FROM `users_follow` WHERE  `follow_id` = :follow_id";
		$command = yii::app()->db->createCommand($query);
		$command->bindparam(":follow_id",$userId);
		$rawData = $command->queryAll();
		$rawCount = count($rawData);
		if($rawCount>0){
			return $rawData;
		}
		else{
			return false;
		}
	}	
	
	// get user hash tags
	
	function get_user_hashtag($hash_cat_id,$userId){
		 $query = "SELECT H.hashtags_name FROM hashtags H 
						JOIN hashtags_category HC ON H.hashtags_category_id = HC.hashtags_category_id 
					JOIN users_hashtags UH ON UH.hashtags_id = H.hashtags_id
						WHERE HC.hashtags_category_id = :hash_cat_id AND UH.user_id = :userId
		";
		$command = yii::app()->db->createCommand($query);
		$command->bindparam(":userId",$userId);
		$command->bindparam(":hash_cat_id",$hash_cat_id);
		$rawData = $command->queryAll();
		$rawCount = count($rawData);
		if($rawCount>0){
			return($rawData);			
		}
		else{
			return false;
		}
	}
	
}

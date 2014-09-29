<?php

/**
 * This is the model class for table "users_details".
 *
 * The followings are the available columns in table 'users_details':
 * @property integer $user_details_id
 * @property string $user_details_firstname
 * @property string $user_details_lastname
 * @property string $user_details_email
 * @property string $user_details_password
 * @property integer $user_details_dob
 * @property string $user_gender
 * @property string $user_height
 * @property string $user_weight
 * @property string $user_specification
 * @property string $user_eye_color
 * @property string $user_hair_color
 * @property integer $user_rank_incity
 * @property integer $user_rank_instate
 * @property integer $user_rank_inregion
 * @property integer $user_rank_incountry
 * @property integer $user_rank_worldwide
 * @property integer $user_id
 * @property integer $user_details_created_date
 *
 * The followings are the available model relations:
 * @property Users[] $users
 * @property Users $user
 */
class UsersDetails extends CActiveRecord
{
	public $highestrank;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_rank_incity, user_rank_instate, user_rank_inregion, user_rank_incountry, user_rank_worldwide, user_id, user_details_created_date', 'numerical', 'integerOnly'=>true),
			array('user_details_firstname, user_details_lastname, user_details_email, user_details_password, user_details_avatar, user_details_slogan', 'length', 'max'=>255),
			array('user_details_gender', 'length', 'max'=>1),
			array('user_details_height, user_details_weight, user_details_specification, user_details_eye_color, user_details_hair_color', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_details_id, searchprivacy, user_unique_url, user_details_firstname, user_details_lastname, user_details_email, user_details_password, user_details_dob, user_details_slogan, user_details_avatar, user_details_gender, user_details_height, user_details_weight, user_details_specification, user_details_eye_color, user_details_hair_color, user_rank_incity, user_rank_instate, user_rank_inregion, user_rank_incountry, user_rank_worldwide, user_id, user_details_created_date', 'safe', 'on'=>'search'),
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
			//'users' => array(self::HAS_MANY, 'Users', 'user_details_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_details_id' => 'User Details',
			'user_details_firstname' => 'User Details Firstname',
			'user_details_lastname' => 'User Details Lastname',
			'user_details_email' => 'User Details Email',
			'user_details_dob' => 'User Details Dob',
			'user_details_gender' => 'User Gender',
			'user_details_height' => 'User Height',
			'user_details_weight' => 'User Weight',
			'user_details_slogan'=>'User Slogan',
			'user_details_specification' => 'User Specification',
			'user_details_eye_color' => 'User Eye Color',
			'user_details_hair_color' => 'User Hair Color',
			'user_rank_incity' => 'User Rank Incity',
			'user_rank_instate' => 'User Rank Instate',
			'user_rank_inregion' => 'User Rank Inregion',
			'user_rank_incountry' => 'User Rank Incountry',
			'user_rank_worldwide' => 'User Rank Worldwide',
			'user_unique_url' => 'Unique URL',
			'searchprivacy' => 'Search Privacy',
			'user_id' => 'User',
			'user_details_created_date' => 'User Details Created Date',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	* Name: getMaxRank
	* User_Define Function To get MaxRank wrt All Users of city,region,country & world	
	* @return Array of ranks
	* Last Modified:24-Sep-14
	*/
	public function getMaxRank($userid,$userdetailid)
	{
		$maxrankArray=array('city'=>0,'region'=>0,'country'=>0,'world'=>0,'cityid'=>0,'regionid'=>0,'countryid'=>0);
		if(!empty($userid) && !empty($userdetailid))
		{
			//Get this user Locations
			$query="SELECT l.* FROM users_location l JOIN users u ON u.user_location_id=l.user_location_id";
			$query.=" WHERE u.user_id='".$userid."'";
			$command= Yii::app()->db->createCommand($query);
			$rawData = $command->queryAll();
			if(isset($rawData) && count($rawData)>0){
				$city = $rawData[0]['user_location_city'];
				$region = $rawData[0]['user_location_region'];
				$country = $rawData[0]['user_location_country'];
			}
			unset($rawData);
			//Now for this user country Get Max Country Rank
			if(isset($country) && !empty($country)){
				$maxrankArray['countryid']=$country;
				$query="SELECT max(ud.user_rank_incountry) as maxcountry FROM users_details ud JOIN users u";
				$query.=" ON u.user_id=ud.user_id JOIN users_location ul ON u.user_location_id=ul.user_location_id";
				$query.=" WHERE ul.user_location_country='".$country."'";
				$command= Yii::app()->db->createCommand($query);		
				$rawData = $command->queryAll();
				if(isset($rawData) && count($rawData)>0)
					$maxrankArray['country']=$rawData[0]['maxcountry'];	
				unset($rawData);
			}
			//Now for this user city Get Max City Rank
			if(isset($city) && !empty($city)){
				$maxrankArray['cityid']=$city;
				$query="SELECT max(ud.user_rank_incity) as maxcity FROM users_details ud JOIN users u";
				$query.=" ON u.user_id=ud.user_id JOIN users_location ul ON u.user_location_id=ul.user_location_id";
				$query.=" WHERE ul.user_location_city='".$city."'";
				$command= Yii::app()->db->createCommand($query);		
				$rawData = $command->queryAll();
				if(isset($rawData) && count($rawData)>0)
					$maxrankArray['city']=$rawData[0]['maxcity'];	
				unset($rawData);
			}
			//Now for this user region Get Max Region Rank
			if(isset($region) && !empty($region)){
				$maxrankArray['regionid']=$region;
				$query="SELECT max(ud.user_rank_inregion) as maxregion FROM users_details ud JOIN users u";
				$query.=" ON u.user_id=ud.user_id JOIN users_location ul ON u.user_location_id=ul.user_location_id";
				$query.=" WHERE ul.user_location_region='".$region."'";
				$command= Yii::app()->db->createCommand($query);		
				$rawData = $command->queryAll();
				if(isset($rawData) && count($rawData)>0)
					$maxrankArray['region']=$rawData[0]['maxregion'];	
				unset($rawData);
			}
			//Now total World Wide Rank
			$query="SELECT max(user_rank_worldwide) as maxworld FROM users_details";		
			$command= Yii::app()->db->createCommand($query);		
			$rawData = $command->queryAll();
			if(isset($rawData) && count($rawData)>0){
				$maxrankArray['world']=$rawData[0]['maxworld'];
			}
		}
		return $maxrankArray;
	}
	
	/**
	* Name: updateOthersRank
	* User_Define Function To Replace Other User's Rank with 
	* This user's Old Rank, as This user gets new top Rank.	
	* Last Modified:24-Sep-14
	*/
	public function updateOthersRank($flag,$existingValue,$newValue,$flagid,$userdetailid)
	{
		if($flag=="city"){
			$query="UPDATE users_details ud JOIN users u ON ud.user_id=u.user_id";	
			$query.=" JOIN users_location l ON l.user_location_id=u.user_location_id";
			$query.=" SET ud.user_rank_incity='".$newValue."' WHERE l.user_location_city='".$flagid."'";
			$query.=" AND ud.user_rank_incity='".$existingValue."' AND ud.user_details_id<>'".$userdetailid."'";
			$command= Yii::app()->db->createCommand($query);
			$command->execute();
		}
		if($flag=="region"){
			$query="UPDATE users_details ud JOIN users u ON ud.user_id=u.user_id";	
			$query.=" JOIN users_location l ON l.user_location_id=u.user_location_id";
			$query.=" SET ud.user_rank_inregion='".$newValue."' WHERE l.user_location_region='".$flagid."'";
			$query.=" AND ud.user_rank_inregion='".$existingValue."' AND ud.user_details_id<>'".$userdetailid."'";
			$command= Yii::app()->db->createCommand($query);
			$command->execute();
		}
		if($flag=="country"){
			$query="UPDATE users_details ud JOIN users u ON ud.user_id=u.user_id";	
			$query.=" JOIN users_location l ON l.user_location_id=u.user_location_id";
			$query.=" SET ud.user_rank_incountry='".$newValue."' WHERE l.user_location_country='".$flagid."'";
			$query.=" AND ud.user_rank_incountry='".$existingValue."' AND ud.user_details_id<>'".$userdetailid."'";
			$command= Yii::app()->db->createCommand($query);
			$command->execute();
		}
		if($flag=="world"){
			$query="UPDATE users_details ud SET ud.user_rank_worldwide='".$newValue."'";
			$query.=" WHERE ud.user_rank_worldwide='".$existingValue."' AND ud.user_details_id<>'".$userdetailid."'";
			$command= Yii::app()->db->createCommand($query);
			$command->execute();
		}
		return null;
	}	
}

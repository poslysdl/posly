<?php
/* An Component for User Authentication
* is used By FB SignUp & SignIn, Email SignUp & SignIn.
** Posly Users SESSIONS gets started Here
* Last Modified - 19-Sep-14
* http://www.yiiframework.com/doc/api/1.1/CUserIdentity
*/
class UserIdentity extends CUserIdentity {
	private $_id; 
	public $registration_steps;
	protected $provider;
	protected $socialidentifier;
	
	//Main function for authenticate
	public function authenticate($type=null) 
	{	
		switch(strtolower($type))
		{	
			case 'social': // for social user login - use in HybridauthController.php
				$user=Users::model()->findByAuthSocial($this->provider, $this->socialidentifier);
				break;
			case 'media': 
				$user=Users::model()->findBySocialId($this->provider, $this->socialidentifier);
				break;
			case 'user':
			default: 				
				// when user enters EmailId for SignIn,SignUp
				$user=Users::model()->findByAuthUser($this->username, $this->password);
				break;
		}
		//end switch
		if(empty($user)){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $user->user_id;
			$this->registration_steps = $user->user_registration_steps;
			if(isset($user->userDetails->user_details_firstname) || isset($user->userDetails->user_details_lastname))
			$this->setState('name', $user->userDetails->user_details_firstname." ".$user->userDetails->user_details_lastname);
			else
			$this->setState('name', $user->userDetails->user_details_email);
			//$this->setState('language', $user->preferredLanguage);
			$this->setState('notify_readdate', $user->notification_read_date);
			$this->setState('notify_count', '');
			if(isset($user->userDetails->user_details_id))
				$this->setState('detailid', $user->userDetails->user_details_id);
			$this->errorCode = self::ERROR_NONE;
			$device = "0";
			$detect = Yii::app()->mobileDetect;
			if($detect->isMobile())
				$device = "1"; //LoggedIn from Mobile Device
			//Update User login status
			$attributes = array("user_online_flag"=>'1',"user_logged_device"=>$device);
			$condition = 'user_id = :id';
			$params = array(':id'=>$user->user_id);
			Users::model()->updateByPk($user->user_id,$attributes,$condition,$params);
			//Update User's Locations ..			
			$temp = UsersLocation::model()->findByPK($user->user_location_id);
			$user_city = $temp->user_location_city;
			$user_country = $temp->user_location_country;
			$user_region = $temp->user_location_region;
			$this->setState('usercity', $user_city);
			$this->setState('usercountry', $user_country);
			$this->setState('userregion', $user_region);
			/* To show #Rank in Card wrt country or city or worldwide,
				will Show All Cards of Only Those Users who in same Country of LoggedIn User
				Default is LoggedIn User's Registered Country
			*/
			$this->setState('showrank', 'country');			
			unset($temp);
			unset($user_city);
			unset($user_country);
			unset($user_region);
			unset($user);
		}
		return $this->errorCode == self::ERROR_NONE;
	}
	
	/* Will check emailId exits in DB or Not
	* Model used: Users
	* return true or false
	*/
	public function checkemailid($emailid){
		$user=Users::model()->findByEmailId($emailid);
		return $user; 
	}
	
	/* Will check the users Table "user_registration_steps" column and check the flag and return the url
	* Important: if user doesn't complete 3-Step Registration , it will redirect to respective page
	* Model used: Users
	* return string
	*/
	public function getusereturnurl($emailid)
	{
		$url = '/site/index';
		if($this->registration_steps!="")
		{
			$step = $this->registration_steps;	
			switch($step){
				case 0:
				$url = '/registration/settings';
				break;
				case 1:
				$url = '/registration/settings';
				break;
				case 2:
				$url = '/registration/secondstep';
				break;
				case 3:
				$url = '/registration/thirdstep';
				break;
				case 4:
				$url = '/registration/fourthstep';
				break;
				case 5:
				$url = '/site/index';
				break;
				default:
				$url = '/site/index';
			}				
		}
		return $url; 
	}
 
	public function getId() {
		return $this->_id;
	}
	
	public function setsocialdata($socialprovider,$identifier){
		$this->provider = $socialprovider;
		$this->socialidentifier = $identifier;
	}
}
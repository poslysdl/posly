<?php
/* An Component for User Authentication
* is used By FB, Email SignUp & SignIn.
* Last Modified - 01-Sep-14
*/
class UserIdentity extends CUserIdentity {
	private $_id; 
	public function authenticate($type=null) 
	{
		switch(strtolower($type))
		{
			case 'social': // for social user login - use in HybridauthController.php
				$user=Users::model()->findByAuthSocial($this->username, $this->password);
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
			if(isset($user->userDetails->user_details_firstname) || isset($user->userDetails->user_details_lastname))
			$this->setState('name', $user->userDetails->user_details_firstname." ".$user->userDetails->user_details_lastname);
			else
			$this->setState('name', $user->userDetails->user_details_email);
			//$this->setState('language', $user->preferredLanguage);
			$this->errorCode = self::ERROR_NONE;
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
	public function getusereturnurl($emailid){
		$url = '/registration/settings';
		$user=Users::model()->findByEmailId($emailid);
		return $url; 
	}
 
	public function getId() {
		return $this->_id;
	}
}
<?php

/**
 * ForgetpasswordForm class.
 * ForgetpasswordForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgetpasswordForm extends CFormModel
{
	public $email;
	public $errmsg;
	public $returnurl;
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('email', 'required'),
		);
	}
	
	public function reset_password_token($token,$email){
		$sql = "UPDATE users_details SET reset_password_token = '$token' WHERE user_details_email= '$email'";
		$command= Yii::app()->db->createCommand($sql);
		$rawData = $command->execute();
	}
	
	public function get_user_id($email){
		$query_user= "SELECT *
						FROM users_details
					WHERE user_details_email= '".$email."'
					LIMIT 1";
		$command = Yii::app()->db->createCommand($query_user);
		$rawData = $command->queryAll();
		foreach($rawData as $raw){
			$user_details_id = $raw['user_details_id'];
		}		
		return $user_details_id;
	}
	
	public function findTokenByUserDetailId($user_detail_id){
		$user_detail_id;
		$query_user= "SELECT reset_password_token
						FROM users_details
					WHERE user_details_id= '".$user_detail_id."'
					LIMIT 1";
		$command = Yii::app()->db->createCommand($query_user);
		$rawData = $command->queryAll();
		foreach($rawData as $raw){
			$reset_password_token = $raw['reset_password_token'];
		}
		if($reset_password_token && !empty($reset_password_token)){
			return $reset_password_token;
		}
		else{
			return false;
		}
	}
	
	public function findUserDetailId($user_detail_id){
		
	}	
	
}

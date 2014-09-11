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
	
	public function reset_password($password,$email){
		$password = md5($password);		
		$sql = "UPDATE users_details SET user_details_password = '$password' WHERE user_details_email= '$email'";
		$command= Yii::app()->db->createCommand($sql);
		$rawData = $command->execute();
	}
	
}

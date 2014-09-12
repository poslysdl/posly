<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $firstname;
	//public $lastname;
	public $email;
	public $username;
	public $password;
	//public $re_password;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('firstname,email,username,password', 'required'),
			array('firstname', 'length', 'min'=>6, 'max'=>200),
			array('email', 'email'),
			array('email', 'checkunique'),
            array('password', 'length', 'min'=>6, 'max'=>15),			
		);
	}
	
	//Removed 11-Sept-2014
	//array('firstname,email,username,password,re_password', 'required'),
	//array('password, re_password', 'length', 'min'=>6, 'max'=>15),
    //array('re_password', 'compare', 'compareAttribute'=>'password'),
	
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'firstname'=>'First Name',
			'lastname'=> 'Last Name',
			'email'=>'Email',
			'password'=>'Password',
			're_password'=>'Confirm Password',
		);
	}
	/**
	* this for check email
	* 
	* @return error
	*/
	public function checkunique()
	{
		$check=UsersDetails::model()->find("user_details_email='$this->email'");
		if(isset($check))
		{
			$this->addError('email','This email already used.');
		}
	}
	/**
	 * Logs in the user using the given email and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,md5($this->password));
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=3600*24*1;
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}

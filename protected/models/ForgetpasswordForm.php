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
			// email and password are required
			array('email', 'required'),
			// rememberMe needs to be a boolean
		);
	}
	
}

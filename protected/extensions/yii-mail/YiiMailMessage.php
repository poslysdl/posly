<?php
/**
* YiiMailMessage class file.
*
* * @link https://code.google.com/p/yii-mail/
* @package Yii-Mail
*/
class YiiMailMessage extends CComponent {
	
	/**
	* @var string the view to use for rendering the body, null if no view is 
	* used.  An extra variable $mail will be passed to the view .which you may 
	* use to set e.g. the email subject from within the view
	*/
	public $view;

	/**
	* @var Swift_Mime_Message
	*/
	public $message;

	/**
	* Any requests to set or get attributes or call methods on this class that 
	* are not found are redirected to the {@link Swift_Mime_Message} object.
	* @param string the attribute name
	*/
	public function __get($name) {
		try {
			return parent::__get($name);
		} catch (CException $e) {
			$getter = 'get'.$name;
			if(method_exists($this->message, $getter))
				return $this->message->$getter();
			else
				throw $e;
		}
	}

	/**
	* Any requests to set or get attributes or call methods on this class that 
	* are not found are redirected to the {@link Swift_Mime_Message} object.
	* @param string the attribute name
	*/
	public function __set($name, $value) {
		try {
			return parent::__set($name, $value);
		} catch (CException $e) {
			$setter = 'set'.$name;
			if(method_exists($this->message, $setter))
				$this->message->$setter($value);
			else
				throw $e;		
		}
	}

	/**
	* Any requests to set or get attributes or call methods on this class that 
	* are not found are redirected to the {@link Swift_Mime_Message} object.
	* @param string the method name
	*/
	public function __call($name, $parameters) {
		try {
			return parent::__call($name, $parameters);	
		} catch (CException $e) {
			if(method_exists($this->message, $name))
				return call_user_func_array(array($this->message, $name), $parameters);
			else
				throw $e;
		}
	}

	/**
	* You may optionally set some message info using the paramaters of this 
	* constructor.
	* Use {@link view} and {@link setBody()} for more control.
	* 
	* @param string $subject
	* @param string $body
	* @param string $contentType
	* @param string $charset
	* @return Swift_Mime_Message
	*/
	public function __construct($subject = null, $body = null, $contentType = null, $charset = null) {
		Yii::app()->mail->registerScripts();
		$this->message = Swift_Message::newInstance($subject, $body, $contentType, $charset);
	}

	/**
	* Set the body of this entity, either as a string, or array of view 
	* variables if a view is set, or as an instance of 
	* {@link Swift_OutputByteStream}.
	* 
	* @param mixed the body of the message.  If a $this->view is set and this 
	* is a string, this is passed to the view as $body.  If $this->view is set 
	* and this is an array, the array values are passed to the view like in the 
	* controller render() method
	* @param string content type optional. For html, set to 'html/text'
	* @param string charset optional
	*/
	public function setBody($body = '', $contentType = null, $charset = null) {
		if ($this->view !== null) {
			if (!is_array($body)) $body = array('body'=>$body);
			
			// if Yii::app()->controller doesn't exist create a dummy 
			// controller to render the view (needed in the console app)
			if(isset(Yii::app()->controller))
				$controller = Yii::app()->controller;
			else
				$controller = new CController('YiiMail');
			
			// renderPartial won't work with CConsoleApplication, so use 
			// renderInternal - this requires that we use an actual path to the 
			// view rather than the usual alias
			$viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath.'.'.$this->view).'.php';
			$body = $controller->renderInternal($viewPath, array_merge($body, array('mail'=>$this)), true);	
		}
		return $this->message->setBody($body, $contentType, $charset);
	}
}
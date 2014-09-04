<?php

class SiteController extends Controller
{
	/**
	* Declares class-based actions.
	*/
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/**
	* Called from Ajax, multiple actions
	* Last Modified: 27-Aug-14
	*/
	public function actionSomemore()
	{
		if(isset($_GET['act']))
		{
			if($_GET['act']=='index')
			{	
				$time=new CTimestamp;
				$value=$time->getDate();
				$end= $value[0];
				$start= $end-86400000;
				$criteria = new CDbCriteria();
				$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';			
				if(Yii::app()->user->isGuest){
					if(isset($_GET['pg']) && $_GET['pg']=="newsfeed")
					$criteria->condition = 'userDetails.user_unique_url = "poslyadmin"';
				}
				$criteria->group = 't.user_id';
				$criteria->order = 'totalcount DESC';
				
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}				
				$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));
			}
			if($_GET['act']=='viral')
			{
				$time=new CTimestamp;
				$value=$time->getDate();
				$end= $value[0];
				$start= $end-86400000;
				$criteria = new CDbCriteria();
				$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';
				$criteria->group = 't.user_id';
				$criteria->order = 'totalcount DESC';
				
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}
				
				$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='newmembers')
			{				
				$criteria = new CDbCriteria();				
				$criteria->group = 'userDetails.user_id';
				$criteria->order = 'userDetails.user_details_created_date DESC';				
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}				
				$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));				
			}
			elseif($_GET['act']=='topmembers')
			{							
				$criteria = new CDbCriteria();				
				$criteria->group = 'userDetails.user_id';
				$criteria->order = 'userDetails.user_rank_worldwide ASC';				
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}				
				$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));			
			}
			elseif($_GET['act']=='males')
			{
				$criteria = new CDbCriteria();	
				$criteria->condition = 'userDetails.user_details_gender = "1"';
				$criteria->group = 'userDetails.user_id';
				$criteria->order = 'userDetails.user_rank_worldwide ASC';				
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}				
				$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='females') 
			{
				$criteria = new CDbCriteria();	
				$criteria->condition = 'userDetails.user_details_gender = "0"';
				$criteria->group = 'userDetails.user_id';
				$criteria->order = 'userDetails.user_rank_worldwide ASC';				
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}				
				$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='country')
			{
				$criteria = new CDbCriteria();
				$c=Yii::app()->request->cookies['presentC']->value;
				$criteria->condition = "exists(select * from photos where user_id=t.user_id) and userLocation.user_location_country LIKE '%$c%'";
				$criteria->limit=$_GET['l'];
				$criteria->offset=$_GET['l']-2;
				$allusersphotos=Users::model()->with('photos','userDetails', 'userLocation')->findAll($criteria);  
				$this->render('somemorenewmembers', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='hashtags')
			{
				$criteria = new CDbCriteria();
				$hid=Yii::app()->request->cookies['presentH']->value;
				$criteria = new CDbCriteria();
				$criteria->group="photos.user_id";
				$criteria->condition = "t.hashtags_id=$hid";
				$criteria->limit=$_GET['l'];
				$criteria->offset=$_GET['l']-2;
				$allusersphotos=PhotosHashtags::model()->with('photos','photos.user', 'photos.user.userDetails', 'photos.user.userLocation')->findAll($criteria); 
				$this->render('somemorehashtags', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='following')
			{
				$id=Yii::app()->user->id;
				$criteria = new CDbCriteria();
				$criteria->condition = "t.user_id=$id and exists(select * from photos where user_id=t.follow_id)";
				$criteria->limit=$_GET['l'];
				$criteria->offset=$_GET['l']-2;
				$allusersphotos=UsersFollow::model()->with('follow', 'follow.userDetails', 'follow.photos')->findAll($criteria);  
				$this->render('somemorefollowing', array('photos'=>$allusersphotos));
			}
		}
		Yii::app()->end();

	}

	/**
	* This is the default 'index' action that is invoked
	* when an action is not explicitly requested by users.
	*/
	public function actionIndex()
	{
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$time=new CTimestamp;
		$value=$time->getDate();
		$end= $value[0];
		$start= $end-86400000;
		$criteria = new CDbCriteria();
		$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';
		$criteria->group = 't.user_id';
		$criteria->order = 'totalcount DESC';
		$criteria->limit=2;
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
		unset($criteria);
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);		
		//Inside views/site/index.php ** widget are there to Include SubHeader, TopMenu & SideBar..
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags));		
	}	
	
	/**
	* New join members
	* Change urlManager array in Main.php for proper redirect
	* Last Modified: 10-Aug-14
	*/
	public function actionNewmembers()
	{		
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();		
		$criteria->group = 'user.user_id';
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id)';
		$criteria->order = 'userDetails.user_details_created_date DESC';
		$criteria->limit=2;		
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);		
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags,'menulink'=>'newmember'));
		
	}
	
	/**
	* Top members
	* Change urlManager array in Main.php for proper redirect
	* Last Modified: 01-Aug-14
	*/
	public function actionTopmembers()
	{		
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();		
		$criteria->group = 'user.user_id';
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id)';
		$criteria->order = 'userDetails.user_rank_worldwide ASC';
		$criteria->limit=2;		
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags,'menulink'=>'topmember'));		
	}
	
	/**
	* Same as That of Index, 
	* just to Link display purpose
	* Change urlManager array in Main.php for proper redirect
	* Last Modified: 28-Aug-14
	*/
	public function actionViral()
	{		
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$time=new CTimestamp;
		$value=$time->getDate();
		$end= $value[0];
		$start= $end-86400000;
		$criteria = new CDbCriteria();
		$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';
		$criteria->group = 't.user_id';
		$criteria->order = 'totalcount DESC';
		$criteria->limit=2;
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
		unset($criteria);
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);		
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags,'menulink'=>'viral'));	
	}
	
	/**
	* to show list of following
	* Last Modified: 27-July-14
	*/
	public function actionFollowing()
	{
		if(!Yii::app()->user->isGuest)
		{
			$this->layout='front_layout';
			Yii::app()->clientScript->registerCoreScript('jquery'); 
			$id=Yii::app()->user->id;
			$criteria = new CDbCriteria();
			$criteria->condition = "t.user_id=$id and exists(select * from photos where user_id=t.follow_id)";
			$criteria->limit=2;
			$allusersphotos=UsersFollow::model()->with('follow', 'follow.userDetails', 'follow.photos')->findAll($criteria);  
			$this->render('following', array('photos'=>$allusersphotos));
		}
		else
		Yii::app()->end();
	}
	
	/**
	* card with users as males
	* Last Modified: 27-July-14
	*/
	public function actionMales()
	{
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();		
		$criteria->group = 'user.user_id';
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id) AND userDetails.user_details_gender = "1"';
		$criteria->order = 'userDetails.user_rank_worldwide ASC';
		$criteria->limit=2;		
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);		
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags));
	}
	
	/**
	* card with users as Females
	* Last Modified: 27-July-14
	*/
	public function actionFemales()
	{		
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();		
		$criteria->group = 'user.user_id';
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id) AND userDetails.user_details_gender = "0"';
		$criteria->order = 'userDetails.user_rank_worldwide ASC';
		$criteria->limit=2;		
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);		
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags));		
	}
	
	/**
	* List of country
	* Last Modified: 27-July-14
	*/
	public function actionCountry($c)
	{
		if($c=='US')
		$c='United States';
		Yii::app()->request->cookies['presentC']=new CHttpCookie('presentC', $c);
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();
		$criteria->condition = "exists(select * from photos where user_id=t.user_id) and userLocation.user_location_country LIKE '%$c%'";
		$criteria->limit=2;
		$allusersphotos=Users::model()->with('photos','userDetails', 'userLocation')->findAll($criteria);  
		$this->render('country', array('photos'=>$allusersphotos));
	}
	
	/**
	* Display details of Hash tags
	* Last Modified: 27-July-14
	*/
	public function actionHashtags($hid)
	{
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		Yii::app()->request->cookies['presentH']=new CHttpCookie('presentH', $hid);
		$criteria = new CDbCriteria();
		$criteria->group="photos.user_id";
		$criteria->condition = "t.hashtags_id=$hid";
		$criteria->limit=2;
		$allusersphotos=PhotosHashtags::model()->with('photos','photos.user', 'photos.user.userDetails', 'photos.user.userLocation')->findAll($criteria);  
		$this->render('hashtags', array('photos'=>$allusersphotos));
	}
	/**
	* This is the action to handle external exceptions.
	*/
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	* Displays the contact page
	*/
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	/**
	* Site Login with EmailId
	* will authenticate email Id and allow Login
	* Last Modified: 02-Sep-14
	*/
	public function actionLogin()
	{
		$model=new LoginForm; //**models/LoginForm.php
		$returnurl = Yii::app()->user->returnUrl;
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$valid = false; 
			$model->attributes=$_POST['LoginForm'];
			$valid=$model->validate(); //Model LoginForm.php			
			//Check for email existance in DB,			
			$usermailid=Users::model()->findByEmailId($model->attributes['email']);			
			if($usermailid===false)
				$model->errmsg = 'Email Not Exists! Please SignUp';			
			if($valid)
			{	
				$model->login();
				$returnurl = Yii::app()->createUrl($model->returnurl);
			   //do anything here
				echo CJSON::encode(array(
					  'status'=>'success',
					  'returnUrl'=>$returnurl
				));
				Yii::app()->end();
			}
			else
			{	
				$msg = $model->errmsg;
				$error = CActiveForm::validate($model);				
				echo CJSON::encode(array(
				  'status'=>'error',
				  'msg'=>$msg
				));
				Yii::app()->end();
			}			
		}		
	}

	/**
	* Displays the Register Modal window - SignUp
	* Last Modified:27-Aug-14
	*/
	public function actionRegister()
	{	
		$model=new RegisterForm;
		// collect user input data
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			$valid=$model->validate();            
			if($valid)
			{
				$u=new Users;
				$ud=new UsersDetails;
				$ud->user_details_firstname=$model->firstname;
				$ud->user_details_lastname=$model->lastname;
				$ud->user_details_email=$model->email;
				$ud->user_details_password=md5($model->password);				
				if($ud->save())
				{
					$u->user_details_id=$ud->user_details_id;
					if($u->save())
					{
						$updateud=UsersDetails::model()->findByPk($ud->user_details_id);
						$updateud->user_id=$u->user_id;
						$updateud->save();
						$model->login();						
					   //do anything here
						$path=$this->createAbsoluteUrl('/registration/settings');
						echo CJSON::encode(array(
							  'status'=>'success',
							  'returnUrl'=>$path,
						));					 
					}					
				}
				Yii::app()->end();
			}			
			else{
				$error = CActiveForm::validate($model);
				//if($error!='[]')
					//echo $error;
				echo CJSON::encode(array(
					'status'=>'error',
					'msg'=>$error,
				));	
				Yii::app()->end();	
			}
		}
		// display the login form
		//$this->render('register',array('model'=>$model));
	}

	/**
	* Terms of service Page
	* Last Modified: 27-Aug-14
	*/
	public function actionTermsofservice()
	{
		$this->layout='front_layout';
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);		
		$this->render('termsofservice', array('hash_tags'=>$hash_tags));
	}
	
	/**
	 * This user define Ajax function to check Email exits in DB or Not
	 * Last Modified: 27-Aug-14
	*/
	public function actionEmailunique()
	{
		$email = $_GET['email'];
		$isexits = '0';
		$check=UsersDetails::model()->find("user_details_email='$email'");
		if(isset($check))				
			$isexits = '1'; //This email already used.
		echo $isexits;
		Yii::app()->end();
	}
	
	/**
	* Logs out the current user and redirect to homepage.
	*/
	public function actionLogout()
	{
		 if(Yii::app()->hybridAuth->getConnectedProviders()){
            Yii::app()->hybridAuth->logoutAllProviders();
        }
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}	
	
	/**
	 * This user define Ajax function to get nearby country in monaco
	 * Last Modified: 02-Sep-14
	*/
	public function actionGetnearbycountry(){
		
		$latitude = $_REQUEST['latitude'];
		$longitude = $_REQUEST['longitude'];
		$country =  $_REQUEST['country'];	
		$latlong = array("latitude" => $latitude, "longitude" => $longitude, "country" => $country);		
		$countries = Countries::model()->get_nearbycountries($latlong);
		echo $countries;
		Yii::app()->end();
		
	}
	/**
	 * This user define function is used to set up an authentication with instagram
	 * Last Modified: 04-Sep-14
	*/
	public function actionInstagramauth(){		
		$code = $_GET['code'];		
		$url = "https://api.instagram.com/oauth/access_token";
		$access_token_parameters = array(
			'client_id' => 'd1b24c4e53364af880b33c5561ce12f4',
			'client_secret' => '6eae2cbe86a24929beec86437bc58c7f',
			'grant_type' => 'authorization_code',
			'redirect_uri' => 'http://localhost/projects/posly_v2/posly/index.php/site/instagramauth',
			'code' => $code
		);
		$curl = curl_init($url); // we init curl by passing the url
		curl_setopt($curl,CURLOPT_POST,true); // to send a POST request
		curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters); // indicate the data to send
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // to stop cURL from verifying the peer's certificate.
		$result = curl_exec($curl); // to perform the curl session
		curl_close($curl); // to close the curl session		
		$data = json_decode($result,true);
		echo "<pre>";
			print_r($data);
		echo "</pre>";
		//echo $arr['access_token']; // display the access_token
		//echo $arr['user']['username']; // display the username		
		Yii::app()->end();
		
	}	
	
	/**
	This user define Ajax function is used to return the html for rendering of
	user's Activities List at Sidebar.
	Last Modified:20-Aug-14
	*/
	public function actionShowusersactivities()
	{	
		$criteria = new CDbCriteria();
		$criteria->limit=2;	
		$uid = Yii::app()->user->id; //logged in userId
		$activityArray = array(); //contains, all activities, Like,Dislikes,Become friends etc
		$str='';
		$limit = 10;
		if(!empty($uid))
		{
			// ** User Logged IN ***
			//Show Photo Likes activities of Me & friends of Me			
			$photolikes=LogPhotosHearts::model()->getActivityWhoLikes($limit,$uid);	
			if(count($photolikes)>0)
			{
				foreach($photolikes as $k=>$v)
				{	
					$uname = ($uid==$v['userid'])?'You':$v['username'];
					$owner_name = $v['ownername'];					
					$msg = ' Likes '.$owner_name.'&#39;s photo:';					
					$activityArray[$v['hdate']] = array('avatar'=>$v['useravatar'],'name'=>$uname,'message'=>$msg);
				}
			}
			unset($photolikes);
			//Now get List of Friends..ie who had recently become your friend		
			$criteria->condition = "t.user_id='".$uid."' AND t.status=1";			
			$friends=UsersFriends::model()->with('friend','user')->findAll($criteria);	
			if(count($friends)>0)
			{		
				foreach($friends as $k=>$v)
				{					
					$date1 = $v['user_friend_created_date'];
					$msg = ' and '.$v['friend']['user_details_firstname'].' '.$v['friend']['user_details_lastname'].' are now friends';
					$activityArray[$date1] = array('avatar'=>$v['friend']['user_details_avatar'],'name'=>'you','message'=>$msg);
				}
			}			
			unset($friends);
			//Now get List of Friend's friends..ie your friend who had add another friend			
			$friends=UsersFriends::model()->getActivityFriends($limit,$uid);	
			if(count($friends)>0)
			{		
				foreach($friends as $k=>$v)
				{	//where $[name] is your(loggedIn User) frnd , who also become frnd with $v['ffname']
					$date1 = $v['date']; 
					$msg = ' and '.$v['ffname'].' are now friends';
					$activityArray[$date1] = array('avatar'=>$v['avatar'],'name'=>$v['name'],'message'=>$msg);
				}
			}			
			unset($friends);
		}
		else
		{
			// ** User NOT Logged IN ***
			//Show general user Photo Likes activities , as no body has loggedIn					
			$photolikes=LogPhotosHearts::model()->getActivityWhoLikes($limit); 							
			if(count($photolikes)>0)
			{
				foreach($photolikes as $k=>$v){					
					$msg = ' Likes '.$v['ownername'].'&#39;s photo:';
					$activityArray[$v['hdate']] = array('avatar'=>$v['useravatar'],'name'=>$v['username'],'message'=>$msg);
				}
			}
			unset($photolikes);
			//Now get List of any user who had recently become friends
			$criteria->condition = "status=1";
			$friends=UsersFriends::model()->with('friend','user')->findAll($criteria);
			if(count($friends)>0)
			{		
				foreach($friends as $k=>$v)
				{	
					$user = $v['user']['user_details_firstname'].' '.$v['user']['user_details_lastname'];
					$date1 = $v['user_friend_created_date'];
					$msg = ' and '.$v['friend']['user_details_firstname'].' '.$v['friend']['user_details_lastname'].' are now friends';
					$activityArray[$date1] = array('avatar'=>$v['user']['user_details_avatar'],'name'=>$user,'message'=>$msg);
				}
			}			
			unset($friends);
		}		
		
		//Now Create the display Activity HTML		
		if(count($activityArray)>0)
		{
			arsort($activityArray);
			foreach($activityArray as $keys=>$values)
			{			
				$fromurl=strstr($values['avatar'], '://', true);
				if($fromurl=='http' || $fromurl=='https')
					$avatar = $values['avatar']; 
				else
				$avatar = Yii::app()->baseUrl.'/profiles/'.$values['avatar'];
				$str.='
				<li class="noti-area"> <img class="avatar img-responsive" alt="" src="'.$avatar.'" />
				<div class="message"> <span class="name">'.$values['name'].'</span> '.$values['message'].' </div>
				</li>					
				';
			}
		}
		unset($activityArray);
		if(empty($str)){
			//a Default Dummy status.
			$str='<li class="noti-area"> <img class="avatar img-responsive" alt="" src="'.Yii::app()->theme->baseUrl.'/img/avatar2.jpg" />
			<div class="message"> <span class="name">Chanh Ny</span> likes Chi Minh Anh photo. </div>
			</li>';
		}
		echo $str;
		/*echo CJSON::encode(array(
			  'status'=>'success',
			  'values'=>$html
		));*/
		Yii::app()->end();	
	}
}

?>
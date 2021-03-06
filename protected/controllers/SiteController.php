<?php
//** Last Modified On : 29-Sept-14

class SiteController extends Controller
{
	/**
	* Declares class-based actions.
	*/
	public $cartlimit = 2; //Display No of Card
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
				$allusersphotos = array();
				$country = Yii::app()->user->getState('usercountry');
				$criteria = new CDbCriteria();
				$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';
				$pageflag='';				
				if(isset($_GET['pg']) && $_GET['pg']=="newsfeed"){
					//NewFeed Page Only
					$criteria->condition = 'userDetails.user_unique_url = "poslyadmin" OR t.photos_share_count>0';
					$pageflag='newsfeed';
				} else{				
					if(!empty($country)){
						//Show Only User's Country
						$criteria->condition = 'userLocation.user_location_country="'.$country.'" AND userDetails.user_unique_url<>"poslyadmin"';			
					} else{
						$criteria->condition = 'userDetails.user_unique_url<>"poslyadmin"';					
					}				
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
				if(!empty($country))
					$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);
				else
					$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos,'pageflag'=>$pageflag));
			}
			if($_GET['act']=='viral')
			{
				$time=new CTimestamp;
				$value=$time->getDate();
				$end= $value[0];
				$start= $end-86400000;
				$allusersphotos = array();
				$country = Yii::app()->user->getState('usercountry');
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
				if(!empty($country)){
					//Show Only User's Country
					$criteria->condition = "userLocation.user_location_country='$country' AND userDetails.user_unique_url<>'poslyadmin'";					
					$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);
				} else{
					$criteria->condition = "userDetails.user_unique_url<>'poslyadmin'";
					$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
				}						
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));
				unset($criteria);
			}
			elseif($_GET['act']=='newmembers')
			{				
				$criteria = new CDbCriteria();				
				$criteria->group = 'userDetails.user_id';
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}
				$country = Yii::app()->user->getState('usercountry');
				if(!empty($country)){
					//Show Only User's Country
					$criteria->condition = 'userLocation.user_location_country="$country"';
				}else{
					$criteria->condition = 'userDetails.user_unique_url<>"poslyadmin"';
				}
				$criteria->order = 'userDetails.user_details_created_date DESC';								
				$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);		
				$this->renderPartial('somemore', array('photos'=>$allusersphotos));
				unset($criteria);
			}
			elseif($_GET['act']=='topmembers')
			{							
				$allusersphotos = array();
				$criteria = new CDbCriteria();				
				$criteria->select = 't.* , (SELECT COUNT(*) FROM log_photos_hearts b WHERE b.owner_id = t.user_id) AS totalcount';
				$criteria->group = 't.user_id';
				$criteria->order = 'totalcount DESC';	
				if($_GET['l']<6){
					$criteria->limit=$_GET['l']; //Total No of Records
					$criteria->offset=$_GET['l']-2; //Starts from..
				} else{
					$criteria->limit = $_GET['l']-2;
					$criteria->offset = $_GET['l'];
				}	
				$country = Yii::app()->user->getState('usercountry');
				if(!empty($country)){
					//Show Only User's Country
					$criteria->condition = "userLocation.user_location_country='$country' AND userDetails.user_unique_url<>'poslyadmin'";					
					$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);
				}
				else{
					//If Not, Show World Wide
					$criteria->condition = 'exists(select * from photos where user_id=t.user_id) AND userDetails.user_unique_url<>"poslyadmin"';			
					$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
				}		
				unset($criteria);		
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
				//To show Card wrt to selected HashTags..a Kind of Filter
				$photoidArray = array();
				$allusersphotos = '';
				$hid=Yii::app()->request->cookies['presentH']->value;
				$criteria = new CDbCriteria();
				$criteria->condition = "t.hashtags_id=$hid";		
				$photos=PhotosHashtags::model()->findAll($criteria);
				if(isset($photos) && count($photos)>0){
					foreach($photos as $sp)
					$photoidArray[]=$sp->photos_id;
				}
				unset($photos);
				unset($criteria);
				if(count($photoidArray)>0)
				{
					$criteria = new CDbCriteria();
					$criteria->addInCondition('t.photos_id',$photoidArray);
					$criteria->group = 't.user_id';
					if($_GET['l']<6){
						$criteria->limit=$_GET['l']; //Total No of Records
						$criteria->offset=$_GET['l']-2; //Starts from..
					} else{
						$criteria->limit = $_GET['l']-2;
						$criteria->offset = $_GET['l'];
					}				
					$allusersphotos=Photos::model()->with('user','user.userDetails')->findAll($criteria);
				}
				$this->renderPartial('somemore', array('photos'=>$allusersphotos,'pageflag'=>'hashtag','pageflagid'=>$photoidArray));				
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
		$allusersphotos = array();
		$country = Yii::app()->user->getState('usercountry');
		$criteria = new CDbCriteria();
		$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';
		$criteria->group = 't.user_id';
		$criteria->order = 'totalcount DESC';
		$criteria->limit=$this->cartlimit;
		if(!empty($country)){
			//Show Only User's Country
			$criteria->condition = "userLocation.user_location_country='$country' AND userDetails.user_unique_url<>'poslyadmin'";							
			$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);
		}
		else{
			//If Not, Show World Wide
			$criteria->condition = "userDetails.user_unique_url<>'poslyadmin'";	
			$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
		}		
		unset($criteria);
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit			
		$hash_tags = $this->actionHashtaglist($limit);	 // actionHashtaglist in Main Controller	
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
		$allusersphotos = array();
		$criteria = new CDbCriteria();
		$country = Yii::app()->user->getState('usercountry');		
		$criteria->group = 'user.user_id';			
		if(!empty($country)){
			//Show Only User's Country
			$criteria->condition = "userLocation.user_location_country='$country' AND userDetails.user_unique_url<>'poslyadmin'";			
			$criteria->order = 'userDetails.user_details_created_date DESC';
			$criteria->limit=$this->cartlimit;
			$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);
		} else{
			$criteria->condition = 'exists(select * from photos where user_id=t.user_id) AND userDetails.user_unique_url<>"poslyadmin"';
			$criteria->order = 'userDetails.user_details_created_date DESC';
			$criteria->limit=$this->cartlimit;
			$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);				
		}				
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit	
		$hash_tags = $this->actionHashtaglist($limit);		
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags,'menulink'=>'newmember'));		
	
	}
	
	/**
	* Top members
	* Change urlManager array in Main.php for proper redirect
	* Last Modified: 26-Sept-14
	*/
	public function actionTopmembers()
	{		
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery');		
		$allusersphotos = array();
		$criteria = new CDbCriteria();
		$criteria->select = 't.* , (SELECT COUNT(*) FROM log_photos_hearts b WHERE b.owner_id = t.user_id) AS totalcount';
		$criteria->group = 't.user_id';
		$criteria->order = 'totalcount DESC';
		$criteria->limit=$this->cartlimit;		
		$country = Yii::app()->user->getState('usercountry');
		if(!empty($country)){
			//Show Only User's Country
			$criteria->condition = "userLocation.user_location_country='$country' AND userDetails.user_unique_url<>'poslyadmin'";			
			$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);
		}		
		else{
			//If Not, Show World Wide
			$criteria->condition = 'exists(select * from photos where user_id=t.user_id) AND userDetails.user_unique_url<>"poslyadmin"';			
			$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
		}	
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit		
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
		$allusersphotos = array();
		$time=new CTimestamp;
		$value=$time->getDate();
		$end= $value[0];
		$start= $end-86400000;
		$country = Yii::app()->user->getState('usercountry');
		$criteria = new CDbCriteria();
		$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';
		$criteria->group = 't.user_id';
		$criteria->order = 'totalcount DESC';
		$criteria->limit=$this->cartlimit;
		if(!empty($country)){
			//Show Only User's Country
			$criteria->condition = "userLocation.user_location_country='$country' AND userDetails.user_unique_url<>'poslyadmin'";							
			$allusersphotos=Photos::model()->with('user', 'user.userDetails','user.userLocation')->findAll($criteria);
		} else{
			$criteria->condition = "userDetails.user_unique_url<>'poslyadmin'";
			$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
		}		
		unset($criteria);
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit		
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
		$criteria->limit=$this->cartlimit;		
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit		
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
		$criteria->limit=$this->cartlimit;		
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);		
		unset($criteria);				
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit		
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
		$con="exists(select * from photos where user_id=t.user_id) and userLocation.user_location_country LIKE '%$c%'";
		$con.=" AND userDetails.user_unique_url<>'poslyadmin'";
		$criteria->condition = $con;
		$criteria->limit=$this->cartlimit;
		$allusersphotos=Users::model()->with('photos','userDetails', 'userLocation')->findAll($criteria);  
		$this->render('country', array('photos'=>$allusersphotos));
	}
	
	/**
	* Display Card wrt to HashTag
	* When use selects any hashtag from trending tag list
	* Last Modified: 24-Sept-14
	*/
	public function actionHashtags($hid)
	{	
		$photoidArray = array();
		$allusersphotos = '';		
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		Yii::app()->request->cookies['presentH']=new CHttpCookie('presentH', $hid);		
		$criteria = new CDbCriteria();		
		$criteria->condition = "t.hashtags_id=$hid";		
		$photos=PhotosHashtags::model()->findAll($criteria);
		if(isset($photos) && count($photos)>0){
			foreach($photos as $sp)
			$photoidArray[]=$sp->photos_id;
		}
		unset($photos);		
		if(count($photoidArray)>0){		
			$criteria = new CDbCriteria();		
			$criteria->addInCondition('t.photos_id',$photoidArray);
			$criteria->group = 't.user_id';
			$criteria->limit=$this->cartlimit;
			$allusersphotos=Photos::model()->with('user','user.userDetails')->findAll($criteria);	
			unset($criteria);
		}		
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit			
		$hash_tags = $this->actionHashtaglist($limit);
		$this->layout='front_layout';
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags,'pageflag'=>'hashtag','pageflagid'=>$photoidArray));		
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
		} else{
			$this->redirect(Yii::app()->homeUrl);
		}
	}
	/**
	* Displays the resetpassword 
	* Last Modified:12-Sept-14
	*/
	public function actionResetpasswordajax(){
		$model=new ResetpasswordForm; //**models/ResetpasswordForm.php
		$returnurl = Yii::app()->user->returnUrl;		
		if(isset($_POST['ResetpasswordForm'])){
			$model->attributes =  $_POST['ResetpasswordForm'];
			$password = $model->attributes['password'];
			$user_detail_id = $model->attributes['user_detail_id'];
			$model->reset_password($user_detail_id,$password);
			echo CJSON::encode(array(
				'status'=>'success',
				'returnUrl'=>$returnurl
			));				
		}
		else{
			$this->redirect(Yii::app()->homeUrl);
		}		
		Yii::app()->end();
	}

	/**
	* Displays the resetpassword 
	* Last Modified:12-Sept-14
	*/
	public function actionResetpassword(){
		$model=new ResetpasswordForm; //**models/ForgetpasswordForm.php
		$returnurl = Yii::app()->user->returnUrl;
		$key = 'forget password posly';	
		//$token_request = urldecode($_REQUEST['token']);
		$token_request = $_REQUEST['token'];
		$decrypted_token = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($token_request), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		if($decrypted_token && !empty($decrypted_token) && (strpos($decrypted_token, 'user') !== false) && $decrypted_token != ''){
			$token_array = explode("user",$decrypted_token);
			//$user_detail_id = mysql_real_escape_string($token_array[1]);
			$user_detail_id = $token_array[1];
			$user_token = $model->findTokenByUserDetailId($user_detail_id);
			if(($user_token) && ($user_token == $decrypted_token))
			{			
				$this->layout='front_layout';
				$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit		
				$hash_tags = $this->actionHashtaglist($limit);		
				//Inside views/site/index.php ** widget are there to Include SubHeader, TopMenu & SideBar..
				$user = array('user_detail_id'=>$user_detail_id);
				$this->render('resetpassword', array('user'=>$user,'hash_tags'=>$hash_tags));
			}
			else{
				$this->redirect(Yii::app()->homeUrl);
			}			
		}
		else{
			//echo "wrong token";
			$this->redirect(Yii::app()->homeUrl);
		}
		Yii::app()->end();
	}
	
	/**
	* Displays the Forget password Modal window - By EmailId
	* Last Modified:10-Sept-14
	*/	
	public function actionForgetpassword(){
		
		$model=new ForgetpasswordForm; //**models/ForgetpasswordForm.php
		$returnurl = Yii::app()->user->returnUrl;		
		if(isset($_POST['ForgetpasswordForm'])){
			$model->attributes = $_POST['ForgetpasswordForm'];		
			$user=Users::model()->findByEmailId($model->attributes['email']);
			if($user){
				$chars = array_merge( range('a','z'),range(0,9),range('A','Z'));
				shuffle($chars);
				$token = implode(array_slice($chars, 0, 8));
				$path = $this->createAbsoluteUrl('/site/resetpassword');
				$user_id = $model->get_user_id($model->attributes['email']);			
				$token = $token."user".$user_id;
				$key = 'forget password posly';		
				 $encrypted_token = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $token, MCRYPT_MODE_CBC, md5(md5($key))));
				//echo "<br/>";
				//$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted_token), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
				//$user_token = urlencode($encrypted_token);
				$link = $path."?token=".$encrypted_token;				
				$model->reset_password_token($token,$model->attributes['email']);
				Yii::import('ext.yii-mail.YiiMailMessage');				
				$message = new YiiMailMessage;
				$message->setBody('Dear Member,

We got a request to reset your Posly password.

Please find the link showed below:
'.$link.'

If you ignore this message, your password would not be changed.

Sincerely, 
Posly Team


', 'text');
				$message->subject = 'Reset Your Password';
				$message->addTo($model->attributes['email']);
				$message->from = Yii::app()->params['adminEmail'];
				Yii::app()->mail->send($message);				
				
				echo CJSON::encode(array(
					'status'=>'success',
					'returnUrl'=>$returnurl
				));
			}
			else{
				$msg = 'Email Not Exists! Please SignUp';	
				echo CJSON::encode(array(
				  'status'=>'error',
				  'msg'=>$msg
				));
			}
		}
		else{
			$this->redirect(Yii::app()->homeUrl);
		}
		Yii::app()->end();
	}

	/**
	* Displays the Register Modal window - SignUp By EmailId
	* FB SignUp goes to HybridauthController..
	* Last Modified:09-Sept-14
	*/
	public function actionRegister()
	{	
		$model=new RegisterForm; //model/RegisterForm.php
		// collect user input data
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			$valid=$model->validate();            
			if($valid)
			{
				$time=new CTimestamp;
				$value=$time->getDate();				
				$u=new Users;
				$ud=new UsersDetails;
				$ud->user_details_firstname=$model->firstname;				
				$ud->user_details_email=$model->email;
				$ud->user_unique_url=$model->username;
				$ud->user_details_password=md5($model->password);
				$ud->user_details_avatar='noimage.jpg';
				$ud->user_details_created_date=$value[0];
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
	}

	/**
	* Terms of service Page
	* Last Modified: 27-Aug-14
	*/
	public function actionTermsofservice()
	{
		$this->layout='front_layout';
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit		
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
		$pk = Yii::app()->user->id;
		if(Yii::app()->hybridAuth->getConnectedProviders()){
         Yii::app()->hybridAuth->logoutAllProviders();
        }		
		//Update Login Status
		$attributes = array("user_online_flag"=>'0');
		$condition = 'user_id = :id';
		$params = array(':id'=>$pk);
		Users::model()->updateByPk($pk,$attributes,$condition,$params);		
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}	
	
	/**
	 * This user define Ajax function to get nearby country in monaco
	 * Last Modified: 02-Sep-14
	*/
	public function actionGetnearbycountry(){		
		$ip = $this->get_client_ip();
		if($ip){
			$countries = Countries::model()->get_current_nearbycountries($ip);
		}
		echo $countries;
		Yii::app()->end();		
	}
	/**
	 * Test Email
	 * Last Modified: 10-Sep-14
	*/
	public function actionGetmail()
	{
		Yii::import('ext.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		$message->setBody('Message content here with HTML', 'text');
		$message->subject = 'test mail from production ';
		$message->addTo('anand.aneesh@gmail.com');
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
		Yii::app()->end();		
	}	
	
	/**	
	* Call Back Function-- INSTAGRAM
	* This user define function is used to set up an authentication with instagram
	* After getting data from Instagram SignUp or SignIn the User
	* Last Modified: 10-Sep-14
	*/
	public function actionInstagramauth()
	{	
		if(isset($_REQUEST['error_reason']) || isset($_REQUEST['error'])){
			//$_REQUEST['error_reason']=="user_denied";
			$this->redirect(Yii::app()->homeUrl);
		}		
		$code = isset($_GET['code'])?$_GET['code']:'';
		$provider = "Instagram";
		$url = "https://api.instagram.com/oauth/access_token"; 
		$access_token_parameters = array(
			'client_id' => Yii::app()->params['instaClientId'],
			'client_secret' => Yii::app()->params['instaKey'],
			'grant_type' => 'authorization_code',
			'redirect_uri' => Yii::app()->params['instaredirecturl'],
			'code' => $code
		);
		//Curl Option should be SET in Server
		$curl = curl_init($url); // we init curl by passing the url
		curl_setopt($curl,CURLOPT_POST,true); // to send a POST request
		curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters); // indicate the data to send
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		// to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // to stop cURL from verifying the peer's certificate.
		$result = curl_exec($curl); // to perform the curl session
		curl_close($curl); // to close the curl session		
		$data = json_decode($result,true);
		if(isset($data['user']['username']))
		{
			//Instagram Had User Info
			$access_token = $data['access_token']; 
			$username = $data['user']['username'];
			$profilePicture = $data['user']['profile_picture'];
			$name = $data['user']['full_name'];
			$identifier = $data['user']['id'];
			//Validate User
			$user=Users::model()->checkSocialAuth($provider, $identifier);			
			if($user===false)
			{
				//New SignUp
				$user_socialmedia=new UsersSocialmedia;
				$user_socialmedia->user_socialmedia_provider=$provider;
				$user_socialmedia->user_socialmedia_identifier=$identifier;
				if($user_socialmedia->save())
				{
					$time=new CTimestamp;
					$value=$time->getDate();				
					$u=new Users;
					$ud=new UsersDetails;
					$ud->user_details_firstname=$name;
					$ud->user_details_lastname=NULL;
					$ud->user_details_email=NULL;
					$ud->user_unique_url=$username;
					$ud->user_details_password=NULL;
					$ud->user_details_avatar=$profilePicture;
					$ud->user_details_created_date=$value[0];
					if($ud->save())
					{
						$u->user_details_id=$ud->user_details_id;
						$u->user_socialmedia_id=$user_socialmedia->user_socialmedia_id;
						if($u->save())
						{
							$updateud=UsersDetails::model()->findByPk($ud->user_details_id);
							$updateud->user_id=$u->user_id;
							$updateud->save();
							//Now Login
							$url = Yii::app()->createUrl('/site/index');
							$identity = new UserIdentity($provider, $identifier); 
							$identity->setsocialdata($provider,$identifier);
							$identity->authenticate('media'); //Authenticate							
							switch($identity->errorCode)
							{
								case UserIdentity::ERROR_NONE:
								$duration=isset($this->rememberMe)? 3600*24*30 : 0; // 30 days
								Yii::app()->user->login($identity,$duration); //Login Session
								$url = Yii::app()->createUrl('/registration/settings');																
								break;
							}				
							$this->redirect($url);
							Yii::app()->end();													
						}					
					}
				}							
			} else{			
				//Already Registered
				$url = Yii::app()->createUrl('/site/index');
				$identity = new UserIdentity($provider, $identifier); 
				$identity->setsocialdata($provider,$identifier);
				$identity->authenticate('media'); //Authenticate							
				switch($identity->errorCode)
				{
					case UserIdentity::ERROR_NONE:
					$duration=isset($this->rememberMe)? 3600*24*30 : 0; // 30 days
					Yii::app()->user->login($identity,$duration); //Login Session
					$url = Yii::app()->createUrl('/registration/settings');																
					break;
				}				
				$this->redirect($url);
				Yii::app()->end();
			}
		} else{
			//Error Occur!!
			$this->layout='front_layout';
			$this->render('error', array('code'=>'','message'=>'User Profile Not Available In Instagram'));
		}		
		Yii::app()->end();		
	}	
	
	/**
	This user define Ajax function is used to return the html for rendering of
	user's Activities List at Sidebar as well as For Top-Header Notification.
	Last Modified:26-Sep-14
	*/
	public function actionShowusersactivities()
	{	
		$criteria = new CDbCriteria();
		$criteria->limit=6;	
		$uid = Yii::app()->user->id; //logged in userId
		$activityArray = array(); //contains, all activities, Like,Dislikes,Become friends etc
		$str='';
		$limit = 10;
		$flag = (isset($_GET['flag']))?$_GET['flag']:'';
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
					$src=Yii::app()->baseUrl.'/files/'.$v['owner_id'].'/thumbnail/'.$v['photos_name'];				
					$file_path = Yii::getPathOfAlias('webroot').'/files/'.$v['owner_id'].'/'.$v['photos_name'];										
					if(!file_exists($file_path)){
						$src=Yii::app()->theme->baseUrl.'/img/noimage.jpg';
					}
					$img='<img class="img-responsive thumbimg" alt="" src="'.$src.'" />';
					$activityArray[$v['hdate']] = array('avatar'=>$v['useravatar'],'name'=>$uname,'message'=>$msg,'image'=>$img);
					
					//Duplicate Testing	DUMMY Data .......
					$img='<img class="img-responsive thumbimg" alt="" src="'.Yii::app()->theme->baseUrl.'/img/avatar2.jpg" />';
					$activityArray['1410354280'] = array('avatar'=>$v['useravatar'],'name'=>$uname,'message'=>$msg,'image'=>$img);
					$activityArray['1410354380'] = array('avatar'=>$v['useravatar'],'name'=>$uname,'message'=>$msg,'image'=>$img);					
					//Duplicate Ends
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
					$activityArray[$date1] = array('avatar'=>$v['friend']['user_details_avatar'],'name'=>'you','message'=>$msg,'image'=>'');
				}
			}			
			unset($friends);
			//Now get List of Users..ie who had recently Send You Friends Request		
			$criteria->condition = "t.friend_id='".$uid."' AND t.status=0";			
			$friends=UsersFriends::model()->with('friend','user')->findAll($criteria);	
			if(count($friends)>0)
			{		
				foreach($friends as $k=>$v)
				{					
					$date1 = $v['user_friend_created_date'];
					$msg = ' Had Sent You a Friend Request';
					$avatar = $v['user']['user_details_avatar'];
					$activityArray[$date1] = array('avatar'=>$avatar,'name'=>$v['user']['user_details_firstname'],'message'=>$msg,'image'=>'');
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
					$activityArray[$date1] = array('avatar'=>$v['avatar'],'name'=>$v['name'],'message'=>$msg,'image'=>'');
				}
			}			
			unset($friends);
			//Get List of users who started to follow you..
			$followers=UsersFollow::model()->getActivityFollow($limit,$uid);
			if(count($followers)>0)
			{		
				foreach($followers as $k=>$v)
				{	
					$date1 = $v['date']; 
					$msg = ' is now your follower';
					$activityArray[$date1] = array('avatar'=>$v['avatar'],'name'=>$v['name'],'message'=>$msg,'image'=>'');
				}
			}	
			unset($followers);
			
			//Now get List of Extra Notification of Posly, only for Top-Header DUMMY Data .......
			if($flag=="header"){
				$msg = 'There is an event to be organised at bangalore, at 1-oct-14, for Fashion ..an fasion event';
				$activityArray['1410835502'] = array('avatar'=>'avatar1_small.jpg','name'=>'Posly','message'=>$msg,'image'=>''); 
				//*Duplicate Testing Data
			}
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
					$activityArray[$v['hdate']] = array('avatar'=>$v['useravatar'],'name'=>$v['username'],'message'=>$msg,'image'=>'');
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
					$avatar = $v['user']['user_details_avatar'];
					$activityArray[$date1] = array('avatar'=>$avatar,'name'=>$user,'message'=>$msg,'image'=>'');
				}
			}			
			unset($friends);
		}
		
		//Now Create the display Activity HTML		
		if(count($activityArray)>0)
		{
			krsort($activityArray); 
			//Sort activity Array By Keys -- SORT	
			$unread_notifycount=0;
			$user_notifyReaddate = (!empty($uid))?Yii::app()->user->getState("notify_readdate"):'0';			
			foreach($activityArray as $keys=>$values)
			{			
				$fromurl=strstr($values['avatar'], '://', true);
				if($fromurl=='http' || $fromurl=='https')
					$avatar = $values['avatar']; 
				else
				$avatar = Yii::app()->baseUrl.'/profiles/'.$values['avatar'];
				if($flag=="header")
				{
					//This is for Top-Header Notification Display
					$str.='
					<li> 
					<a href="#">
					<div class="main">
					<span class="photo">
					<img class="avatar-user-l img-responsive" src="'.$avatar.'" alt=""/>
					</span>					
					<div class="message"> 
						<span class="name">'.$values['name'].'</span> '.$values['message'].' 
						<div class="newtime">'.$this->get_msgtime($keys).'</div>
					</div>
					</div>
					</a> 
					</li>				
					';
				} else{
					//This for Side-Bar UserActivity/Notification Display
					$str.='
					<li class="noti-area"><img class="avatar img-responsive" alt="" src="'.$avatar.'" />
					<div class="message">
					<span class="notimsg"><span class="name">'.$values['name'].'</span> '.$values['message'].'</span>'.$values['image'].'					
					</div>
					</li>					
					';
				}
				//Now check For notify Cnt for LoggedIn user				
				if(!empty($uid))
				{  //Condition if notify Date in DB is Less then Keys(notifyTimedate), then its an Unread		
					if($user_notifyReaddate < $keys){
						$unread_notifycount++; 
					}
				}
			}
			if(!empty($uid)){
				$unread_notifycount = ($unread_notifycount==0)?'':$unread_notifycount;
				Yii::app()->user->setState('notify_count', $unread_notifycount);
			}
		}
		unset($activityArray);
		if(empty($str)){
			//a Default Dummy status.
			$str='<li class="noti-area"><img class="avatar img-responsive" alt="" src="'.Yii::app()->theme->baseUrl.'/img/avatar2.jpg" />
			<div class="message"> <span class="name">Chanh Ny</span> likes Chi Minh Anh photo. </div>
			</li>';
		}		
		echo $str;		
		Yii::app()->end();	
	}
	
	/**
	* This user define Ajax function, 
	* to get Unread Notification Count
	* Last Modified:16-Sep-14
	*/
	public function actionGetnotifycount()
	{
		echo CJSON::encode(array(
			  'status'=>'success',
			  'values'=>Yii::app()->user->getState("notify_count")
		));
		Yii::app()->end();
	}
	
	/**
	* This user define Ajax function, When User Clicks on Notification Icon 
	* to remove notify count from session, After User Reads It
	* Last Modified:16-Sep-14
	*/
	public function actionRemovenotifycount()
	{
		$time=new CTimestamp;
		$value=$time->getDate();
		$uid = Yii::app()->user->id;
		Users::model()->updateNotificationDate($uid,$value[0]);
		Yii::app()->user->setState("notify_readdate",$value[0]);
		Yii::app()->user->setState("notify_count",'');
		echo CJSON::encode(array(
			  'status'=>'success',
			  'values'=>''
		));
		Yii::app()->end();
	}

	/*$time1=new CTimestamp;
	$value1=$time1->getDate();
	echo strtotime('now').'--'.$value1[0]; 
	//O/p 1410935502--1410935502 (Same result)
	date('d-m-y',strtotime('now'));
	*/	
	
	/**
	*This is a seach functionality
	* to search Card by users or Tag name
	*Last Modified:17-Sep-14
	*/
	public function actionSearch()
	{
		$this->layout='front_layout';
		$searchname = $_POST['search'];
		//get Hashtag Ids wrt to searchname
		$searchname = addcslashes($searchname, '%_'); //escape LIKE's special characters
		$q = new CDbCriteria( array(
		'condition' => "hashtags_name LIKE :match",        
		'params' => array(':match' => "%$searchname%")  
		)); 
		$hashtags = Hashtags::model()->findAll( $q ); 
		$hashtagArray = array();
		if(isset($hashtags) && count($hashtags)>0){
			foreach($hashtags as $keys=>$values)
			$hashtagArray[] = $values->hashtags_id;
		} 
		unset($hashtags);
		unset($q);
		$photoidArray = array();
		if(count($hashtagArray)>0)
		{
			//Now from HashtagIds get Photo Ids			
			$criteria = new CDbCriteria();			
			$criteria->addInCondition("hashtags_id", $hashtagArray);		
			$hashtags=PhotosHashtags::model()->findAll($criteria);			
			if(isset($hashtags) && count($hashtags)>0){
				foreach($hashtags as $keys=>$values)
				$photoidArray[] = $values->photos_id;
			}
			unset($hashtags);
			unset($hashtagArray);
			$photoidArray = array_unique($photoidArray);
		}
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6;		
		$hash_tags = $this->actionHashtaglist($limit);
		//** Search For Posly Card wrt userId or HashTagId
		$allusersphotos=array();
		if(count($photoidArray)==0)
		{	
			$time=new CTimestamp; //Search By Name
			$value=$time->getDate();		
			$criteria = new CDbCriteria();			
			$criteria->addSearchCondition('userDetails.user_details_firstname', $searchname, true);			
			$criteria->limit=$this->cartlimit;
			$allusersphotos=Photos::model()->with('user','user.userDetails','photosHashtags')->findAll($criteria);	
			unset($criteria);							
		} else{			
			$time=new CTimestamp; //Search By HashTags
			$value=$time->getDate();		
			$criteria = new CDbCriteria();			
			//$criteria->addSearchCondition('userDetails.user_details_firstname', $searchname, true);
			$criteria->addInCondition("photos_id", $photoidArray);
			$criteria->limit=$this->cartlimit;
			$allusersphotos=Photos::model()->with('user','user.userDetails','photosHashtags')->findAll($criteria);	
			unset($criteria);			
		}
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags));
	}
	
//END
}

?>
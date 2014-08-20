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
				$criteria->group = 't.user_id';
				$criteria->condition = 'exists(select * from photos where user_id=t.user_id)';
				$criteria->order = 'userDetails.user_details_created_date DESC';
				$criteria->limit=$_GET['l'];
				$criteria->offset=$_GET['l']-2;
				$allusersphotos=Users::model()->with('photos', 'userDetails')->findAll($criteria);  
				$this->render('somemorenewmembers', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='topmembers')
			{
				$criteria = new CDbCriteria();
				$criteria->group = 't.user_id';
				$criteria->condition = 'exists(select * from photos where user_id=t.user_id)';
				$criteria->order = 'userDetails.user_rank_worldwide ASC';
				$criteria->limit=$_GET['l'];
				$criteria->offset=$_GET['l']-2;
				$allusersphotos=Users::model()->with('photos', 'userDetails')->findAll($criteria);  
				$this->render('somemorenewmembers', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='males')
			{
				$criteria = new CDbCriteria();
				$criteria->condition = 'exists(select * from photos where user_id=t.user_id) and userDetails.user_details_gender=1';
				$criteria->limit=$_GET['l'];
				$criteria->offset=$_GET['l']-2;
				$allusersphotos=Users::model()->with('photos','userDetails')->findAll($criteria);  
				$this->render('somemorenewmembers', array('photos'=>$allusersphotos));
			}
			elseif($_GET['act']=='females')
			{
				$criteria = new CDbCriteria();
				$criteria->condition = 'exists(select * from photos where user_id=t.user_id) and userDetails.user_details_gender=2';
				$criteria->limit=$_GET['l'];
				$criteria->offset=$_GET['l']-2;
				$allusersphotos=Users::model()->with('photos','userDetails')->findAll($criteria);  
				$this->render('somemorenewmembers', array('photos'=>$allusersphotos));
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
		$hash_tags = $this->actionHashtaglist(); //Get Hash Tags Listings for sidebar	
		
		//Inside views/site/index.php ** widget are there to Include SubHeader, TopMenu & SideBar..
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags));		
	}	
	
	/**
	 * Name: actionHashtaglist
	 * Is a User_Define function to show Hash Tag Listings, which are Viral
	*/
	public function actionHashtaglist()
	{
		$hash_tags = array();
		$limit = 6;
		$trend=LogHashtags::model()->getmyhashtags($limit);		
		if(isset($trend)){		
			foreach($trend as $tagg1=>$tagg)				
			$hash_tags[] = CHtml::link($tagg['hashtags_name'], array('site/hashtags', 'hid'=>$tagg['hashtags_id']));			
        }  
		return $hash_tags;
	}

	public function actionNewmembers()
	{
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();
		$criteria->group = 't.user_id';
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id)';
		$criteria->order = 'userDetails.user_details_created_date DESC';
		$criteria->limit=2;
		$allusersphotos=Users::model()->with('userDetails', 'photos')->findAll($criteria);  
		$this->render('newmembers', array('photos'=>$allusersphotos));
	}
	
	public function actionTopmembers()
	{
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();
		$criteria->group = 't.user_id';
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id)';
		$criteria->order = 'userDetails.user_rank_worldwide ASC';
		$criteria->limit=2;
		$allusersphotos=Users::model()->with('userDetails', 'photos')->findAll($criteria);  
		$this->render('topmembers', array('photos'=>$allusersphotos));
	}
	
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
	
	public function actionMales()
	{
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id) and userDetails.user_details_gender=1';
		$criteria->limit=2;
		$allusersphotos=Users::model()->with('photos','userDetails')->findAll($criteria);  
		$this->render('males', array('photos'=>$allusersphotos));
	}
	
	public function actionFemales()
	{
		$this->layout='front_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$criteria = new CDbCriteria();
		$criteria->condition = 'exists(select * from photos where user_id=t.user_id) and userDetails.user_details_gender=2';
		$criteria->limit=2;
		$allusersphotos=Users::model()->with('photos','userDetails')->findAll($criteria);  
		$this->render('males', array('photos'=>$allusersphotos));
	}
	
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
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
				 $model->attributes=$_POST['LoginForm'];
                    $valid=$model->validate();            
                    if($valid){
						$model->login();
                       //do anything here
                         echo CJSON::encode(array(
                              'status'=>'success',
                              'returnUrl'=>Yii::app()->user->returnUrl
                         ));
                        Yii::app()->end();
                        }
                        else{
							$msg = 'Error';
                            $error = CActiveForm::validate($model);
                            if($error!='[]'){
								$msg = CJSON::decode($error);
                               $msg = $msg['LoginForm_password'][0];
							}
							echo CJSON::encode(array(
                              'status'=>'error',
                              'msg'=>$msg
							));
                            Yii::app()->end();
                        }
			
			/*$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);*/
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Displays the register page
	 */
	public function actionRegister()
	{
		$model=new RegisterForm;

		// collect user input data
		if(isset($_POST['RegisterForm']))
		{
				 $model->attributes=$_POST['RegisterForm'];
                    $valid=$model->validate();            
                    if($valid){
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
                            if($error!='[]')
                                echo $error;
                            Yii::app()->end();
                        }
		}
		// display the login form
		$this->render('register',array('model'=>$model));
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
	
}

?>
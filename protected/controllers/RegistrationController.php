<?php

class RegistrationController extends Controller
{
   public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
 
    public function accessRules()
    {
        return array(
            array('allow',
            	'actions'=>array('index','geturlname', 'invite','thirdstep', 'secondstep', 'settings', 'fourthstep', 'slogan', 'addmagazines', 'deletemagazines','changephoto','getcity','dualfbsignup','validatepagename'),
                'users'=>array('@'),
            ),
            array('deny'),
        );
    }
	
	/* This called at Step-2#, Upload User Photo(Profile Picture)
	* LastModifed : 05-Sept-14
	*/
    public function actionChangephoto()
    {
		Yii::import("ext.EAjaxUpload.qqFileUploader"); 
        $folder=dirname(__FILE__).'/../../profiles/';// folder for uploaded files
        $allowedExtensions = array("jpg", "png", "gif", "jpeg");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 1 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        $fileName=$result['filename'];//GETTING FILE NAME
        $id=Yii::app()->user->id;
		$oldfile='';
		$user= UsersDetails::model()->find("user_id=$id");
		if(!isset($user))
		{
			$user=new UsersDetails;
			$user->user_id=$id;
			$user->user_details_avatar=$fileName;
			$user->save();
			echo $return;// it's array
		}
		else
		{
			$oldfile=$user->user_details_avatar;
			$user->user_details_avatar=$fileName;
			if($user->save())
			unlink($folder.''.$oldfile); 
			echo $return;// it's array
        }
        Yii::app()->end();
	}
	
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
		$this->render('firsttime', array('photos'=>$allusersphotos));	
	}
	
	/* This called when User First (1-st Step) Gets Registered (3-Step Process)
		Through Email, FB or Instagram
		LastModifed : 05-Sept-14
	*/
	public function actionSettings() 
	{
		$isStep1 = false;
		$stepflag = 'n';
		if(!Yii::app()->user->isGuest)
			$isStep1 = true;	
		if(isset($_REQUEST['stepflag']))			
			$stepflag = $_REQUEST['stepflag']; //to keep Step-Back flow		
		if(isset($_POST['firstname']))
			$stepflag = 'y';		
		//Registration Process Step-1#
		if($isStep1)
		{			
			$success = array();
			$id = Yii::app()->user->id;
			$users = Users::model()->find("user_id=$id");
			$errmsg = '';
			if($users->user_registration_steps>1)
			{
				//redirect to other steps, if user had already completed this Step
				$regsteps = $users->user_registration_steps;
				if($regsteps==2 && $stepflag=='n'){				
					$this->redirect(array('registration/secondstep'));
					Yii::app()->end();
				} else if($regsteps==3 && $stepflag=='n'){					
					$this->redirect(array('registration/thirdstep'));
					Yii::app()->end();
				} else if($regsteps==4 && $stepflag=='n'){					
					$this->redirect(array('registration/fourthstep'));
					Yii::app()->end();
				} else if($regsteps==5 && $stepflag=='n'){					
					$this->redirect(array('registration/fourthstep'));
					Yii::app()->end(); 				
				} else{
					//$this->redirect(Yii::app()->homeUrl);
				}				
			}			
			$model = Users::model()->with('userDetails', 'userNotification', 'userSocialPrivacy', 'userSecurity', 'userLocation')->findByPk($id);			
			//Validate POST data
			if(isset($_POST['firstname']) && !empty($_POST['firstname']) && $_POST['city']!='' && !empty($_POST['etnicity']) && !empty($_POST['email']) && !empty($_POST['gender']) && !empty($_POST['country']))
			{		
				//UsersDetails model values
				$success[] = true;
				$fn = trim($_POST['firstname']);
				$ln = isset($_POST['lastname'])?trim($_POST['lastname']):NULL;
				$email = trim($_POST['email']);
				$password = (isset($_POST['password']) && $_POST['password']!='0')?$_POST['password']:NULL;
				$gender = $_POST['gender'];
				$dob = trim($_POST['dob']);
				$search = isset($_POST['search'])?$_POST['search']:'';				
				$url = trim($_POST['url']);
				//UsersLanguage model values
				$language = trim($_POST['language']);			
				$country = trim($_POST['country']);
				$region = (trim($_POST['region'])=='0')?'':trim($_POST['region']);				
				$state = isset($_POST['state'])?trim($_POST['state']):NULL;
				$city = trim($_POST['city']);				
				$ethinicity = trim($_POST['etnicity']);
				$phone = (trim($_POST['phone'])=='')?'':trim($_POST['phone']);
				$address = (trim($_POST['address'])=='')?'':trim($_POST['address']);
				//UsersSecurity model values 
				$privacy = isset($_POST['messageme'])?$_POST['messageme']:'0';
				//UsersNotification model values
				$email_notify = isset($_POST['email_notify'])?$_POST['email_notify']:'0';
				$like_pic = isset($_POST['like_pic'])?$_POST['like_pic']:'0'; 
				$follow = isset($_POST['follow_you'])?$_POST['follow_you']:'0';
				$comment_pic = isset($_POST['comment_pic'])?$_POST['comment_pic']:'0';
				$sent_msg = isset($_POST['sent_msg'])?$_POST['sent_msg']:'0'; 
				$week_newsletter = isset($_POST['week_newsletter'])?$_POST['week_newsletter']:'0';
				$feature_announce = isset($_POST['featannounce'])?$_POST['featannounce']:'0';
				$week_inspiration = isset($_POST['week_inspiration'])?$_POST['week_inspiration']:'0';
				$invi_feed = isset($_POST['invi_feed'])?$_POST['invi_feed']:'0';
				$pic_of_week = isset($_POST['pic_of_week'])?$_POST['pic_of_week']:'0';
				$someone_fb = isset($_POST['someone_fb'])?$_POST['someone_fb']:'0';
				//UsersSocialPrivacy model values 
				$fb_like = isset($_POST['fb_like'])?$_POST['fb_like']:'0';
				$fb_upload = isset($_POST['fb_upload'])?$_POST['fb_upload']:'0';
				$fb_comment = isset($_POST['fb_comment'])?$_POST['fb_comment']:'0';
				$fb_favour = isset($_POST['fb_favour'])?$_POST['fb_favour']:'0';
			
				//userdetails saved in table : users_details				
				if(isset($model->userDetails)) 
				{		
					//Post::model()->updateByPk($pk,$attributes,$condition,$params);			
					$pk = $model->userDetails->user_details_id;
					$attributes = array(			
					'user_details_firstname'=>$fn, 'user_details_lastname'=>$ln, 'user_details_email'=>$email, 'user_details_dob'=>$dob, 'user_details_gender'=>$gender, 'searchprivacy'=>$search, 'user_unique_url'=>$url,'user_details_phone'=>$phone,'user_details_address'=>$address);
					if(!empty($password)){
						$aa = array('user_details_password'=>md5($password));
						$attributes = array_merge($attributes,$aa);						
					}
					$condition = 'user_details_id = :userdetailid';
					$params = array(':userdetailid'=>$pk);
					$row = UsersDetails::model()->updateByPk($pk,$attributes,$condition,$params);					
					$success[] = true;
					//Update User Table data..
					$pk = Yii::app()->user->id;
					$condition = 'user_id = :userid';
					$params = array(':userid'=>$pk);
					$attributes = array('user_language_id'=>$language,'user_ethnicity_id'=>$ethinicity);
					$row = Users::model()->updateByPk($pk,$attributes,$condition,$params);
				}
				else 
				{ 
					//if the row is not there add a new row in the table
					$userDetials = new UsersDetails;
					$userDetials->user_details_firstname = $fn;
					$userDetials->user_details_lastname = $ln;
					$userDetials->user_details_email = $email;					
					$userDetials->user_details_dob = $dob;
					$userDetials->user_details_gender = $gender;
					$userDetials->searchprivacy = $search;
					$userDetials->user_unique_url = $url;
					$userDetials->user_details_phone = $phone;
					$userDetials->user_details_address = $address;
					if(!empty($password))
						$userDetials->user_details_password = md5($password);
					if($userDetials->save()){
					$users->user_details_id = $userDetials->user_details_id;
					$users->save();
					$success[] = true;
					}
				}			
				//whocansee is saved in table : users_security
				if(isset($model->userSecurity))
				{
					$pk = $model->userSecurity->users_security_id;
					$attributes = array("whocansee"=>$privacy);
					$condition = 'users_security_id = :securityid';
					$params = array(':securityid'=>$pk);
					$row = UsersSecurity::model()->updateByPk($pk,$attributes,$condition,$params);
					$success[] = true;
				} 
				else 
				{
					$usersSecurity = new UsersSecurity;
					$usersSecurity->user_id = $id;	
					$usersSecurity->whocansee = $privacy;
					if($usersSecurity->save()){
					$users->user_security_id = $usersSecurity->users_security_id;
					$users->save();
					$success[] = true;
					}
				}				
				//EMAIL NOTIFICATIONS is saved in table : users_notification
				if(isset($model->userNotification)) 
				{
					$pk = $model->userNotification->user_notification_id;					
					$condition = 'user_notification_id = :notification_id';
					$params = array(':notification_id'=>$pk);					
					$row = UsersNotification::model()->updateByPk($pk, array(
					"user_notification_on"=>$email_notify, "user_like_pic"=>$like_pic, "user_follow_pic"=>$follow, "user_comment_pic"=>$comment_pic, "user_sent_msg"=>$sent_msg, "user_week_newsletter"=>$week_newsletter, "user_week_inspiration"=>$week_inspiration, "user_feature_announce"=>$feature_announce, "user_weekly_pic"=>$pic_of_week, "user_someone_fb"=>$someone_fb, "user_invitation_fb"=>$invi_feed),$condition,$params);
					$success[] = true;
				} 
				else 
				{
					$userNotify = new UsersNotification;
					$userNotify->user_notification_on = $email_notify;
					$userNotify->user_like_pic = $like_pic;
					$userNotify->user_follow_pic = $follow;
					$userNotify->user_comment_pic = $comment_pic;
					$userNotify->user_sent_msg = $sent_msg;
					$userNotify->user_week_newsletter = $week_newsletter;
					$userNotify->user_week_inspiration = $week_inspiration;
					$userNotify->user_feature_announce = $feature_announce;
					$userNotify->user_weekly_pic = $pic_of_week;
					$userNotify->user_someone_fb = $someone_fb;
					$userNotify->user_invitation_fb = $invi_feed;
					if($userNotify->save(false)){
					$users->user_notification_id = $userNotify->user_notification_id;
					$users->save();
					$success[] = true;
					}
				}
				// SOCIAL SHARING details is saved in table : user_social_privacy	
				if(isset($model->userSocialPrivacy)) 
				{
					$condition = 'id = :id';
					$params = array(':id'=>$model->userSocialPrivacy->id);
					$row = UserSocialPrivacy::model()->updateByPk($model->userSocialPrivacy->id, array(
					"type"=>"Facebook", "user_i_like"=>$fb_like, "user_i_upload"=>$fb_upload, "user_comment"=>$fb_comment, "user_albums_fav"=>$fb_favour),$condition,$params);
					$success[] = true;
				} 
				else 
				{					
					$usersSocialPrivacy = new UserSocialPrivacy;
					$usersSocialPrivacy->user_id = $id;
					$usersSocialPrivacy->type = 'Facebook';
					$usersSocialPrivacy->user_i_like = $fb_like;
					$usersSocialPrivacy->user_i_upload = $fb_upload;
					$usersSocialPrivacy->user_comment = $fb_comment;
					$usersSocialPrivacy->user_albums_fav = $fb_favour;
					if($usersSocialPrivacy->save()) {
					$users->user_social_privacy_id = $usersSocialPrivacy->id;
					$users->save();
					$success[] = true;
					}
				}			
				//user location details are saved in table : users_location
				if(isset($model->userLocation)) 
				{
					$pk = $model->userLocation->user_location_id;					
					$condition = 'user_location_id = :id';
					$params = array(':id'=>$pk);					
					$row = UsersLocation::model()->updateByPk($pk, array(
					"user_location_city"=>$city, "user_location_state"=>$state, "user_location_region"=>$region, "user_location_country"=>$country),$condition,$params);
					$success[] = true;
				} 
				else
				{
					$usersLocation = new UsersLocation;
					$usersLocation->user_location_city = $city;
					$usersLocation->user_location_state = $state;
					$usersLocation->user_location_region = $region;
					$usersLocation->user_location_country = $country;
					if($usersLocation->save()){
						$users->user_location_id = $usersLocation->user_location_id;
						if($users->save())
						$success[] = true;
					}
				}				
				if(in_array(false, $success)) {					
					$errmsg = "Error Occur! Unable to save the Record ";
				} else {					
					if($users->user_registration_steps<2){
					//Increment for next step
					$users->user_registration_steps = 2; 
					$users->save();
					}
					$this->redirect(array('registration/secondstep'));
					Yii::app()->end();
				}							
			} else{
				if(isset($_POST['firstname']))
				$errmsg = "Please Enter Mandatory Fields (name, email, dob, gender,ethinicity, country & city)";
			}			
			//Render the page
			$this->layout='account_settings_layout';
			$country = Countries::model()->getcountries();
			$ethnicity = UsersEthnicity::model()->findAll();
			$languages = UsersLanguage::model()->findAll();			
			$this->render('account-settings', array('model'=>$model, 'country'=>$country,'ethnicity'=>$ethnicity,'languages'=>$languages,'errmsg'=>$errmsg,'stepflag'=>$stepflag));
		}
		else {
			$this->redirect(Yii::app()->homeUrl);		
		}
	}
	
	/* This is (2nd Step) Update your Profile Hashtags & Profile Pic, 
		After User First time Gets Registered (3-Step Process) Through Email or FB		
		LastModifed : 26-Aug-14
	*/
	public function actionSecondstep()
	{
		$this->layout='account_settings_layout'; //secondstep_layout
		$id=Yii::app()->user->id;
		$users= Users::model()->with('userDetails')->findByPk($id);
		if($users->user_registration_steps<4){
			//Increment for next step
			$users->user_registration_steps = 3; 
			$users->save();
		}
		$this->render('secondstep', array('user'=>$users));
	}
	
	/* This is (3rd Step) Invite Friends, 
		After User First time Gets Registered (3-Step Process) Through Email or FB		
		LastModifed : 26-Aug-14
	*/
	public function actionThirdstep()
	{		
		$this->layout='account_settings_layout'; //steps_layout
		$id=Yii::app()->user->id;
		$c=Yii::app()->hybridAuth->getConnectedProviders();
		$socialUser=array();
		$FBUserArray = array();
		$FBfrndsInPosly = array();
		if(!empty($c))
		{	
			if(Yii::app()->hybridAuth->isAdapterUserConnected('Facebook')){				
				$socialUser = Yii::app()->hybridAuth->getAdapterUserContacts('Facebook');
				//Use Older version FB App to get Friends List..
			}					
		}		
		$user= Users::model()->with('userDetails')->findByPk($id);
		if($user->user_registration_steps<5){
			//Increment for next step
			$user->user_registration_steps = 4; 
			$user->save();
		}
		if(count($socialUser)>0)
		{	//Get the List of Friends who are in FB and also in Posly...
			foreach($socialUser as $keys=>$values){
				$FBUserArray[$values->identifier] = 
				array('identifier'=>$values->identifier,'profileURL'=>$values->profileURL,'photoURL'=>$values->photoURL,
				'displayName'=>$values->displayName); //Store all my friends Identifier
			}
			$criteria = array("select"=>"user_socialmedia_id,user_socialmedia_identifier");			
			$usersidentifier=UsersSocialmedia::model()->with('users')->findAll($criteria);
			foreach($usersidentifier as $k1=>$v1){				 
				//Check with socialmedia Table to find yr frnd in Fb also in Posly
				if(array_key_exists($v1->user_socialmedia_identifier,$FBUserArray)===true)
				$FBfrndsInPosly[$v1->users[0]->user_id]=$FBUserArray[$v1->user_socialmedia_identifier];
			}			
			unset($FBUserArray);
			unset($usersidentifier);
			unset($criteria);
		}		
		$this->render('thirdstep', array('list'=>$socialUser, 'user'=>$user,'fbfriends'=>$FBfrndsInPosly));
	}
	
	/* This is (4th Step) "getting Started", 
		After User First time Gets Registered (3-Step Process) Through Email or FB		
		LastModifed : 26-Aug-14
	*/
	public function actionFourthstep()
	{
		$this->layout='account_settings_layout'; //steps_layout
		$id=Yii::app()->user->id;
		$user= Users::model()->with('userDetails')->findByPk($id);
		$this->render('forthstep', array('user'=>$user));
	}	
	
	public function actionInvite()
	{
		/*if(isset($_POST['ids'])){
		if(Yii::app()->hybridAuth->isAdapterUserConnected('Facebook'))
		$socialUser = Yii::app()->hybridAuth->sendInvite('Facebook', $_POST['ids']);
		}
		echo $socialUser;
		Yii::app()->end();	
		*/
	}	
	
	public function actionGetUrlName() 
	{		
		if(isset($_POST['value'])) 
		{
			$id = Yii::app()->user->id;
			$val = $_POST['value'];
			//$user = UsersDetails::model()->findAll('user_unique_url LIKE :match and user_id=:id', array(':match' => "%$val%", ":id"=>$id));			
			//$user = UsersDetails::model()->find('user_unique_url LIKE :match', array(':match' => "%$val%"));
			$user = UsersDetails::model()->find("user_unique_url = '$val'");			 
		 	if(isset($user) && !empty($user)) {
				if($user->user_id==$id)
					echo false;
				else	
					echo true;
			} else {
				echo false;
			} 			
		}		 
	}	
	
	public function actionSlogan()
	{
		$model=new SloganForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='slogan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['SloganForm']))
		{
			$model->attributes=$_POST['SloganForm'];
			 
			if($model->validate())
			{
			if(!Yii::app()->user->isGuest)
			{
				$id=Yii::app()->user->id;
				$m=UsersDetails::model()->find("user_id=$id");
				$m->user_details_slogan=$model->slogan;
				if($m->save())
				echo 'ok';
				else
				echo 'error';
			}
			else
				echo 'error';
			Yii::app()->end();
			}
		}		
		$this->render('slogan', array('model'=>$model));		
	}	
	
	/* This is in Step-2# - my interests
		To add Hash Tag under Category "magazines"
		LastModifed : 05-Sept-14
	*/
	public function actionAddmagazines()
	{			
		if(isset($_POST['name']) && $_POST['name']!='' && $_POST['name']!=NULL)
		{
			$name = $_POST['name'];
			$tagcategory = $_POST['cat'];
			switch($tagcategory){
				case "magazine":
					$tagname = 'Magzine';
					break;
				case "designer":
					$tagname = 'Design';
					break;
				case "shops":
					$tagname = 'Shops';
					break;
				case "styles":
					$tagname = 'StyleIcons';
					break;
				default:
					$tagname = 'MyStyle';
			}
			$m_users_hashtags = new UsersHashtags;
			$m_loghash_tags = new LogHashtags;
			$timestamp = new CTimestamp;
			$value = $timestamp->getDate();
			$time = $value[0];			
			$category_name=HashtagsCategory::model()->find("hashtags_category_name='".$tagname."'");			
			if(!isset($category_name))
			{
				$category_name = new HashtagsCategory;
				$category_name->hashtags_category_name = $tagname;	
				$category_name->save(false);
			}			 
			$userId = Yii::app()->user->id; 
			$catname = $category_name->hashtags_category_name;			
			$tagfind = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->find("hashtags.hashtags_name='$name' and hashtags.hashtags_category_id='$category_name->hashtags_category_id' and t.user_id=$userId");			 
			if(!isset($tagfind))
			{
				$hastag = Hashtags::model()->with('hashtagsCategory')->find("t.hashtags_name='$name' and hashtagsCategory.hashtags_category_id='$category_name->hashtags_category_id'");
				if(isset($hastag)) {
					$hastag->hashtags_count += 1;
					$hastag->save(false);												
				} else {
					$hastag = new Hashtags;
					$hastag->hashtags_count = 1;
					$hastag->hashtags_name = $_POST['name'];
					$hastag->hashtags_category_id = $category_name->hashtags_category_id;
					$hastag->save(false);					
				}				
				$m_users_hashtags->hashtags_id = $hastag->hashtags_id;
				$m_users_hashtags->user_id = Yii::app()->user->id;
				$m_users_hashtags->save(false);				
				$m_loghash_tags->hashtags_id = $hastag->hashtags_id;
				$m_loghash_tags->log_hashtags_date = $time;
				$m_loghash_tags->save(false);				
				echo CJavaScript::jsonEncode($hastag);
				Yii::app()->end();
			}
			echo CJavaScript::jsonEncode(array('status'=>'false'));
		}
		Yii::app()->end();
	}	
	
	/* This is in Step-2# - my interests
		To Delete Hash Tags
		LastModifed : 05-Sept-14
	*/
	public function actionDeletemagazines()
	{
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];			 
			$uht = UsersHashtags::model()->findByAttributes(array('hashtags_id' => $id));
			if($uht->delete()) {
				$m = Hashtags::model()->findByPk($id);
				if($m->hashtags_count > 0) {
					$m->hashtags_count--;
					$m->save(false);	
				}				
				echo 'ok';
			} else {
				echo 'error';	
			}			 
		}
		Yii::app()->end();
	}	
	
	/**
	* This user define Common Ajax function, 
	* To get city,state,region data wrt to countryid or regionId
	* Last Modified: 03-Sept-14
	*/	
	public function actionGetcity()
	{		
		if(isset($_POST['pdata']))
		{
			$val = $_POST['pdata'];
			$sourcename = $_POST['pname'];
			$countryid = $_POST['cid'];
			$result = '';
			$str = '<option value="">-</option>';
			if($sourcename=='country'){
				//select region wrt country
				$notaval = "Regions Not available";
				$result = Countries::model()->getregions($val);				
			}
			/*else if($sourcename=='region'){
				//select state wrt region
				$notaval = "States Not available";
				$result = Countries::model()->getstates($val);
			} */
			else {
				//select city wrt region/state
				$notaval = "Cities Not available";
				$result = Countries::model()->getcities($val,$countryid);	}
			
			if(isset($result) && count($result))
			{
				//create the options
				foreach($result as $keys=>$values){
					$rvalue = ucwords(strtolower($values['id']));
					$str.='<option value="'.$rvalue.'" data-id="'.$rvalue.'" > '.$values['name'].'</option>';
				}
			} else{
				$str.= '<option value="0" data-id="">'.$notaval.'</option>';
			}
			echo CJSON::encode(array(
				'status'=>'success',
				'msg'=>$str,
			));	
			Yii::app()->end();			
		}
	}
	
	/**
	* This user define Common Ajax function, 
	* To validate username, check if it already exits
	* Last Modified: 12-Sept-14
	*/	
	public function actionValidatepagename()
	{		
		if(isset($_POST['idata']))
		{
			$pagename='';
			$sat = 'success';
			$uid = Yii::app()->user->id;
			$val = CJSON::decode($_POST['idata']);
			$pagename = $val[0];
			//check for duplicate page name
			$criteria = new CDbCriteria();
			$criteria->select = "user_unique_url";
			$criteria->condition = "user_unique_url='$pagename'";
			$userdetail=UsersDetails::model()->findAll($criteria);			
			if(isset($userdetail) && count($userdetail)>0)
				$sat = 'error';
			else
				$sat = 'success';
			//foreach($userdetail as $p)
			//$p->user_unique_url
			echo CJSON::encode(array(
				'status'=>$sat,
				'msg'=>$pagename,
			));	
			Yii::app()->end();			
		}
	}
	
//END
}
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
            	'actions'=>array('index','geturlname', 'invite','thirdstep', 'secondstep', 'settings', 'fourthstep', 'slogan', 'addmagazines', 'deletemagazines', 'adddesigners', 'deletedesigners', 'addshops', 'deleteshops',  'addstyles', 'deletestyles',  'addmystyles', 'deletemystyles', 'changephoto'),
                'users'=>array('@'),
            ),
            array('deny'),
        );
    }
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
	
	public function actionInvite()
	{
		if(isset($_POST['ids'])){
		if(Yii::app()->hybridAuth->isAdapterUserConnected('Facebook'))
		$socialUser = Yii::app()->hybridAuth->sendInvite('Facebook', $_POST['ids']);
		}
		echo $socialUser;
		Yii::app()->end();	
	}
	
    
	public function actionThirdstep()
	{
		$this->layout='steps_layout';
		$id=Yii::app()->user->id;
		$c=Yii::app()->hybridAuth->getConnectedProviders();
		if(!empty($c))
		{
			if(Yii::app()->hybridAuth->isAdapterUserConnected('Facebook'))
		$socialUser = Yii::app()->hybridAuth->getAdapterUserContacts('Facebook');
		$user= Users::model()->with('userDetails')->findByPk($id);
		$this->render('firststep', array('list'=>$socialUser, 'user'=>$user));			
		}
		else
		{
			$socialUser=array();
		$user= Users::model()->with('userDetails')->findByPk($id);
		$this->render('firststep', array('list'=>$socialUser, 'user'=>$user));	
		}

	}
	
	public function actionSecondstep()
	{
		$this->layout='secondstep_layout';
		$id=Yii::app()->user->id;
		$user= Users::model()->with('userDetails')->findByPk($id);
		$this->render('secondstep', array('user'=>$user));
	}
	
	
	public function actionGetUrlName() {
		
		if (isset($_POST['value'])) {
			$id = Yii::app()->user->id;
			$val = $_POST['value'];
			//$user = UsersDetails::model()->findAll('user_unique_url LIKE :match and user_id=:id', array(':match' => "%$val%", ":id"=>$id));
			
			//$user = UsersDetails::model()->find('user_unique_url LIKE :match', array(':match' => "%$val%"));
			$user = UsersDetails::model()->find("user_unique_url = '$val'");
			 
		 	if (isset($user) && !empty($user)) {
				if($user->user_id==$id)
					echo false;
				else	
					echo true;
			} else {
				echo false;
			}
 			
		}
		 
	}
	
	
	
	
	
		public function actionSettings() {
		if (!Yii::app()->user->isGuest) {
			
			$this->layout='account_settings_layout';
			$success = array();
			
			
			$id = Yii::app()->user->id;
			$users = Users::model()->find("user_id=$id");
			$country = Countries::model()->findAll();
			$model = Users::model()->with('userDetails', 'userNotification', 'userSocialPrivacy', 'userSecurity', 'userLanguage', 'userLocation', 'userEthnicity')->findByPk($id);
		
		
		
		 
		// print_r($model); die();
		 
			
		if(isset($_POST['firstname'], $_POST['city'],$_POST['ethinicity'],$_POST['url'], $_POST['search'], $_POST['email'],$_POST['gender'],$_POST['dob'],$_POST['language'], $_POST['country'], $_POST['region'], $_POST['state'] )) {
		 
			/* UsersDetails model values */
			$fn = trim($_POST['firstname']);
			$ln = trim($_POST['lastname']);
			$email = trim($_POST['email']);
			$gender = $_POST['gender'];
			$dob = trim($_POST['dob']);
			$search = $_POST['search'];
			$url = trim($_POST['url']);
			
			/* UsersLanguage model values */
			$language = trim($_POST['language']);
			
			
			/* UsersLocation model values */
			$country = trim($_POST['country']);
			$region = trim($_POST['region']);
			$state = trim($_POST['state']);
			$city = trim($_POST['city']);
			
			/* UsersEthinicity model values */
			$ethinicity = trim($_POST['ethinicity']);
			
			/* UsersSecurity model values */
			$privacy = $_POST['privacy'];
			
			
			/* UsersNotification model values */
			$email_notify = $_POST['email_notify'];
			$like_pic = $_POST['like_pic'];
			$follow = $_POST['follow'];
			$comment_pic = $_POST['comment_pic'];
			$sent_msg = $_POST['sent_msg'];
			$week_newsletter = $_POST['week_newsletter'];
			$feature_announce = $_POST['feature_announce'];
			$week_inspiration = $_POST['week_inspiration'];
			$invi_feed = $_POST['invi_feed'];
			$pic_of_week = $_POST['pic_of_week'];
			$someone_fb = $_POST['someone_fb'];
			
			/* UsersSocialPrivacy model values */
			$fb_like = $_POST['fb_like'];
			$fb_upload = $_POST['fb_upload'];
			$fb_comment = $_POST['fb_comment'];
			$fb_favour = $_POST['fb_favour'];
			
			
			 
			
		 
		 	 
			//userdetails saved in table : users_details
			// if row is already there update the row with the values
			if (isset($model->userDetails)) {
				
				$row = UsersDetails::model()->updateByPk($model->userDetails->user_details_id, array(
				"user_details_firstname"=>$fn, "user_details_lastname"=>$ln, "user_details_email"=>$email, "user_details_dob"=>$dob, "user_details_gender"=>$gender, "searchprivacy"=>$search, "user_unique_url"=>$url));
				if ($row) $success[] = true; else $success[] = false;

			} else { //if the row is not there add a new row in the table
				$userDetials = new UsersDetails;
				$userDetials->user_details_firstname = $fn;
				$userDetials->user_details_lastname = $ln;
				$userDetials->user_details_email = $email;
				$userDetials->user_details_dob = $dob;
				$userDetials->user_details_gender = $gender;
				$userDetials->searchprivacy = $search;
				$userDetials->user_unique_url = $url;
				if ($userDetials->save()) {
					$users->user_details_id = $userDetials->user_details_id;
					$users->save();
					$success[] = true;
				} else {
					$success[] = false;
				}
			}
			
			
			
			
			
			 
			
			
			
			//whocansee is saved in table : users_security
			if(isset($model->userSecurity)) {
				
				$row = UsersSecurity::model()->updateByPk($model->userSecurity->users_security_id, array(
				"whocansee"=>$privacy));
				 
				if ($row) {
					$success[] = true;	
				} else {
					$success[] = false;	
				
				}
				
			} else {
				$usersSecurity = new UsersSecurity;
				$usersSecurity->user_id = $id;	
				$usersSecurity->whocansee = $privacy;
				if ($usersSecurity->save()) {
					$users->user_security_id = $usersSecurity->users_security_id;
					$users->save();
					$success[] = true;
				} else {
					$success[] = false;
				}
			}
			 
			 
			
			 
			//EMAIL NOTIFICATIONS is saved in table : users_notification
			if(isset($model->userNotification)) {
				
$row = UsersNotification::model()->updateByPk($model->userNotification->user_notification_id, array(
				"user_notification_on"=>$email_notify, "user_like_pic"=>$like_pic, "user_follow_pic"=>$follow, "user_comment_pic"=>$comment_pic, "user_sent_msg"=>$sent_msg, "user_week_newsletter"=>$week_newsletter, "user_week_inspiration"=>$week_inspiration, "user_feature_announce"=>$feature_announce, "user_weekly_pic"=>$pic_of_week, "user_someone_fb"=>$someone_fb, "user_invitation_fb"=>$invi_feed));				
				
				 
				if ($row) {
					$success[] = true;
				} else {
					$success[] = false;
				}
				 
			} else {
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
				if ($userNotify->save(false)) {
					$users->user_notification_id = $userNotify->user_notification_id;
					$users->save();
					$success[] = true;
				} else {
					$success[] = false;	
				}
			}
			
			
			 
			
			// SOCIAL SHARING details is saved in table : user_social_privacy	
			if (isset($model->userSocialPrivacy)) {
				
	$row = UserSocialPrivacy::model()->updateByPk($model->userSocialPrivacy->id, array(
				"type"=>"Facebook", "user_i_like"=>$fb_like, "user_i_upload"=>$fb_upload, "user_comment"=>$fb_comment, "user_albums_fav"=>$fb_favour));					
				
				 
				if ($row) {
					$success[] = true;
				} else {
					$success[] = false;
					}
				
			} else {
				$usersSocialPrivacy = new UserSocialPrivacy;
				$usersSocialPrivacy->user_id = $id;
				$usersSocialPrivacy->type = 'Facebook';
				$usersSocialPrivacy->user_i_like = $fb_like;
				$usersSocialPrivacy->user_i_upload = $fb_upload;
				$usersSocialPrivacy->user_comment = $fb_comment;
				$usersSocialPrivacy->user_albums_fav = $fb_favour;
				if ($usersSocialPrivacy->save()) {
					$users->user_social_privacy_id = $usersSocialPrivacy->id;
					$users->save();
					$success[] = true;
				} else {
					$success[] = false;
				}
				
			}
			
			
			
			
			//user language in saved in table : users_language
			if (isset($model->userLanguage)) {
				
	$row = UsersLanguage::model()->updateByPk($model->userLanguage->users_language_id, array(
				"users_language_name"=>$language));			
				 
				if ($row) {
					$success[] = true;
				} else {
					$success[] = false;	
				}
			} else {
				 $userLanguage = new UsersLanguage;
				 $userLanguage->users_language_name = $language;
				 if ($userLanguage->save()) {
				 	$users->user_language_id = $userLanguage->users_language_id;
					if ($users->save()) {
						$success[] = true;
					} else {
						$success[] = false;	
					}
					$success[] = true;
				 } else {
					$success[] = false;	 
				 }
			}
			 
			//user location details are saved in table : users_location
			if (isset($model->userLocation)) {
	$row = UsersLocation::model()->updateByPk($model->userLocation->user_location_id, array(
				"user_location_city"=>$city, "user_location_state"=>$state, "user_location_region"=>$region, "user_location_country"=>$country));					
				
				 
				 if ($row) {
					$success[] = true;	 
				 } else {
					$success[] = false;	 
				 }
				   
			} else {
				 $usersLocation = new UsersLocation;
				 $usersLocation->user_location_city = $city;
				 $usersLocation->user_location_state = $state;
				 $usersLocation->user_location_region = $region;
				 $usersLocation->user_location_country = $country;
				 if ($usersLocation->save()) {
				 	$users->user_location_id = $usersLocation->user_location_id;
					if ($users->save()) {
												$success[] = true;
					} else{
												$success[] = false;
					}
											$success[] = true;
				 } else {
											$success[] = false;	 
				 }
			}
			 
			 
			 
			 
			//user ethinicity is saved in the table : users_ethnicity 
			if (isset($model->userEthnicity)) {
				
				$row = UsersEthnicity::model()->updateByPk($model->userEthnicity->users_ethnicity_id, array("users_ethnicity_name"=>$ethinicity));
				
				 
 				if ($row) {
				 							$success[] = true;
				} else {
											$success[] = false;	
				}
			} else {
				$usersEthinicity = new UsersEthnicity;
				 
				$usersEthinicity->users_ethnicity_name = $ethinicity;
				if ($usersEthinicity->save()) {
					$users->user_ethnicity_id = $usersEthinicity->users_ethnicity_id;
					if ($users->save()) {
												$success[] = true;
					} else {
												$success[] = false;	
					}
											$success[] = true;
				} else {
											$success[] =false;	
				}
				 
			} 
			 
			 if (in_array(false, $success)) {
					echo false; 
				} else {
				echo true;	
				}
			 //print_r($success);
			
			Yii::app()->end();
			
			
			
			return true;
			
		}  
					 
		 
			 
			$this->render('account-settings', array('model'=>$model, 'country'=>$country));
		
		} else {
			$this->redirect(Yii::app()->homeUrl);		
		}
	}
	
	
	
	
	
	
	public function actionFourthstep()
	{
		$this->layout='steps_layout';
		$id=Yii::app()->user->id;
		$user= Users::model()->with('userDetails')->findByPk($id);
		$this->render('thirdstep', array('user'=>$user));
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function actionAddmagazines()
	{
		if(isset($_POST['name']) && $_POST['name']!='' && $_POST['name']!=NULL)
		{
			$name = $_POST['name'];
			$m_users_hashtags = new UsersHashtags;
			$m_loghash_tags = new LogHashtags;
			$timestamp = new CTimestamp;
			$value = $timestamp->getDate();
			$time = $value[0];
			
			$category_name=HashtagsCategory::model()->find("hashtags_category_name='Magzine'");
			
			if(!isset($category_name))
			{
				$category_name = new HashtagsCategory;
				$category_name->hashtags_category_name = 'Magzine';	
				$category_name->save(false);
			}
			
			 
			$userId = Yii::app()->user->id; 
			$catname = $category_name->hashtags_category_name;
			
			$tagfind = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->find("hashtags.hashtags_name='$name' and hashtags.hashtags_category_id='$category_name->hashtags_category_id' and t.user_id=$userId");
			
			 
			 
			if (!isset($tagfind)) {
				$hastag = Hashtags::model()->with('hashtagsCategory')->find("t.hashtags_name='$name' and hashtagsCategory.hashtags_category_id='$category_name->hashtags_category_id'");
				if (isset($hastag)) {
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function actionDeletemagazines()
	{
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			 
			$uht = UsersHashtags::model()->findByAttributes(array('hashtags_id' => $id));
			if ($uht->delete()) {
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
	
	
	
	
	
	
	
	
	
	
	
	
	public function actionAdddesigners()
	{
		if(isset($_POST['name']) && $_POST['name']!='' && $_POST['name']!=NULL)
		{
			$name = $_POST['name'];
			$m_users_hashtags = new UsersHashtags;
			$m_loghash_tags = new LogHashtags;
			$timestamp = new CTimestamp;
			$value = $timestamp->getDate();
			$time = $value[0];
			
			$category_name=HashtagsCategory::model()->find("hashtags_category_name='Design'");
			
			if(!isset($category_name))
			{
				$category_name = new HashtagsCategory;
				$category_name->hashtags_category_name = 'Design';	
				$category_name->save(false);
			}
			
			 
			$userId = Yii::app()->user->id; 
			$catname = $category_name->hashtags_category_name;
			
			$tagfind = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->find("hashtags.hashtags_name='$name' and hashtags.hashtags_category_id='$category_name->hashtags_category_id' and t.user_id=$userId");
			
			 
			 
			if (!isset($tagfind)) {
				$hastag = Hashtags::model()->with('hashtagsCategory')->find("t.hashtags_name='$name' and hashtagsCategory.hashtags_category_id='$category_name->hashtags_category_id'");
				if (isset($hastag)) {
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
	
	
	
	public function actionDeletedesigners()
	{
		
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			 
			$uht = UsersHashtags::model()->findByAttributes(array('hashtags_id' => $id));
			if ($uht->delete()) {
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
	
	
	
	
	public function actionAddshops()
	{
		if(isset($_POST['name']) && $_POST['name']!='' && $_POST['name']!=NULL)
		{
			$name = $_POST['name'];
			$m_users_hashtags = new UsersHashtags;
			$m_loghash_tags = new LogHashtags;
			$timestamp = new CTimestamp;
			$value = $timestamp->getDate();
			$time = $value[0];
			
			$category_name=HashtagsCategory::model()->find("hashtags_category_name='Shops'");
			
			if(!isset($category_name))
			{
				$category_name = new HashtagsCategory;
				$category_name->hashtags_category_name = 'Shops';	
				$category_name->save(false);
			}
			
			 
			$userId = Yii::app()->user->id; 
			$catname = $category_name->hashtags_category_name;
			
			$tagfind = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->find("hashtags.hashtags_name='$name' and hashtags.hashtags_category_id='$category_name->hashtags_category_id' and t.user_id=$userId");
			
			 
			 
			if (!isset($tagfind)) {
				$hastag = Hashtags::model()->with('hashtagsCategory')->find("t.hashtags_name='$name' and hashtagsCategory.hashtags_category_id='$category_name->hashtags_category_id'");
				if (isset($hastag)) {
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
	
	
	
	
	
	public function actionDeleteshops()
	{
		if(isset($_POST['id']))
		{
			/*$m=InterestedShops::model()->findByPk($_POST['id']);
			if($m->delete())
			{
				echo 'ok';
			}
			else
			echo'error';*/
			
			$id = $_POST['id'];
			 
			$uht = UsersHashtags::model()->findByAttributes(array('hashtags_id' => $id));
			if ($uht->delete()) {
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function actionAddstyles()
	{
		if(isset($_POST['name']) && $_POST['name']!='' && $_POST['name']!=NULL)
		{
			 $name = $_POST['name'];
			$m_users_hashtags = new UsersHashtags;
			$m_loghash_tags = new LogHashtags;
			$timestamp = new CTimestamp;
			$value = $timestamp->getDate();
			$time = $value[0];
			
			$category_name=HashtagsCategory::model()->find("hashtags_category_name='StyleIcons'");
			
			if(!isset($category_name))
			{
				$category_name = new HashtagsCategory;
				$category_name->hashtags_category_name = 'StyleIcons';	
				$category_name->save(false);
			}
			
			 
			$userId = Yii::app()->user->id; 
			$catname = $category_name->hashtags_category_name;
			
			$tagfind = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->find("hashtags.hashtags_name='$name' and hashtags.hashtags_category_id='$category_name->hashtags_category_id' and t.user_id=$userId");
			
			 
			 
			if (!isset($tagfind)) {
				$hastag = Hashtags::model()->with('hashtagsCategory')->find("t.hashtags_name='$name' and hashtagsCategory.hashtags_category_id='$category_name->hashtags_category_id'");
				if (isset($hastag)) {
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
	
	
	
	public function actionDeletestyles()
	{
		if(isset($_POST['id']))
		{
			/*$m=InterestedStyleIcons::model()->findByPk($_POST['id']);
			if($m->delete())
			{
				echo 'ok';
			}
			else
			echo'error';*/
			
			$id = $_POST['id'];
			 
			$uht = UsersHashtags::model()->findByAttributes(array('hashtags_id' => $id));
			if ($uht->delete()) {
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
	
	
	
	
	
	
		public function actionAddmystyles()
	{
		if(isset($_POST['name']) && $_POST['name']!='' && $_POST['name']!=NULL)
		{
			  $name = $_POST['name'];
			$m_users_hashtags = new UsersHashtags;
			$m_loghash_tags = new LogHashtags;
			$timestamp = new CTimestamp;
			$value = $timestamp->getDate();
			$time = $value[0];
			
			$category_name=HashtagsCategory::model()->find("hashtags_category_name='MyStyle'");
			
			if(!isset($category_name))
			{
				$category_name = new HashtagsCategory;
				$category_name->hashtags_category_name = 'MyStyle';	
				$category_name->save(false);
			}
			
			 
			$userId = Yii::app()->user->id; 
			$catname = $category_name->hashtags_category_name;
			
			$tagfind = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->find("hashtags.hashtags_name='$name' and hashtags.hashtags_category_id='$category_name->hashtags_category_id' and t.user_id=$userId");
			
			 
			 
			if (!isset($tagfind)) {
				$hastag = Hashtags::model()->with('hashtagsCategory')->find("t.hashtags_name='$name' and hashtagsCategory.hashtags_category_id='$category_name->hashtags_category_id'");
				if (isset($hastag)) {
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
	
	public function actionDeletemystyles()
	{
		if(isset($_POST['id']))
		{
			 $id = $_POST['id'];
			 
			$uht = UsersHashtags::model()->findByAttributes(array('hashtags_id' => $id));
			if ($uht->delete()) {
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
}
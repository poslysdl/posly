<?php
class ProfileController extends Controller {
	
	public $user_guest = "guest";
	public $user_self = "self";
	public $user_logged_vistor = "logged_vistor";
	public $user_friend = "friend";
	public $lang = 'en';
	public $user_request_send = "request_send";
	public $user_request_receive = "request_receive";
	public $user_follow = "follow";
	public $user_following  = "following";
	public $current_user_id;
	public $current_profile_id;
	public $profile_hearts_count;
	public $profile_friends_count;
	public $profile_follower_count;
	public $profile_following_count;	
   public function filters() {
      return array( 'accessControl' ); // perform access control for CRUD operations
	}
 
	public function accessRules() {
        return array(
            array('allow',
            	'actions'=>array('index', 'addhearts', 'following', 'followers', 'about', 'albums', 'hearts', 'ranks','catwalk','friends','userAge','profilesettings','addfriend','removefriend','followfriend','followingfriend'),
                'users'=>array('*'),
            ),
            array('deny'),
        );
    }
	
	public function actionIndex($url) {
		$user_additional_info['follow'] = $this->user_follow;
		//Guest profile	 
		if(Yii::app()->user->isGuest) {
			$error = false;
			if(isset($url) && !empty($url)){
				$user_additional_info = array();	
				$profile_url = $url;
				Yii::app()->session['url'] = $profile_url;
				$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
				Yii::app()->session['user_id'] = $row['user_id'];				
				if (isset($row)) {
					$this->profile_hearts_count = Users::model()->get_profile_hearts_count($row['user_id']);
					$this->profile_friends_count = Users::model()->get_profile_friends_count($row['user_id']);
					$user_additional_info['profile_hearts_count'] = $this->profile_hearts_count;
					$user_additional_info['profile_friends_count'] = $this->profile_friends_count;
					$user_id = $row['user_id'];					
					$sec_row = UsersSecurity::model()->find("user_id=$user_id");
					$privacy = $sec_row['whocansee'];					
					if ($privacy == 1) {	
						$this->layout='profile_layout';	
						Yii::app()->clientScript->registerCoreScript('jquery'); 
						$userAge = Users::model()->getUserAge($row['user_id']);
						$age = ($userAge) ? $userAge : "";
						$user_additional_info['age'] = $userAge;
						$user_additional_info['current_user'] = $this->user_guest;
						$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));
					} else /* if privacy is 2 or 3 */ {
						$error = true;
					}
					
				} else {
					//if the user with that profile name is not there redirect or sent error message
					$error = true;
				}
				
			} else {
				//redirect to the return url or get some error message
				$error = true;
			}
			if($error)
				$this->redirect(Yii::app()->homeUrl);
			
		} 					
		else {
			//logged in user
			$error = false;
			$id = Yii::app()->user->id;
			$this->current_user_id = $id;
			if(isset($url) && !empty($url)) {
				$profile_url = $url;
				Yii::app()->session['url'] = $profile_url;
				$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
				Yii::app()->session['user_id'] = $row['user_id'];

				if(isset($row)) {
					$check_friend = UsersFriends::model()->check_friend($id,$row['user_id']);
					
					$check_follow = UsersFollow::model()->check_follow($id,$row['user_id']);
					if($check_follow){
						$user_additional_info['follow'] = $this->user_following;
					}					
					$user_id = $row['user_id'];
					$this->profile_hearts_count = Users::model()->get_profile_hearts_count($row['user_id']);
					$this->profile_friends_count = Users::model()->get_profile_friends_count($row['user_id']);
					$this->profile_follower_count = Users::model()->get_profile_follower_count($row['user_id']);
					$user_additional_info['profile_hearts_count'] = $this->profile_hearts_count;
					$user_additional_info['profile_friends_count'] = $this->profile_friends_count;
					$this->current_profile_id = $user_id;
					$userAge = Users::model()->getUserAge($row['user_id']);
					$age = ($userAge) ? $userAge : "";	
					//logged in user (own profile)
					if($id == $user_id) {						
						$this->layout='profile_layout';
						Yii::app()->clientScript->registerCoreScript('jquery');	
						$user_additional_info['age'] = $userAge;
						$user_additional_info['current_user'] = $this->user_self;
						$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));
					}
					//loggedin user friend profile
					else if($check_friend){
						$this->layout='profile_layout';
						Yii::app()->clientScript->registerCoreScript('jquery'); 
						$user_additional_info['age'] = $userAge;
						$user_additional_info['current_user'] = $this->user_friend;
						$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));
					}
					//logged in user (others profile)
					else {						
						$check_invitation = UsersFriends::model()->find_user_send_receive_request($id,$row['user_id'],$this->user_request_send,$this->user_request_receive );
						if($check_invitation){
							$user_additional_info['current_user'] = $check_invitation;
						}
						else{
							$user_additional_info['current_user'] = $this->user_logged_vistor;
						}
						//$sec_row = UsersSecurity::model()->find("user_id=$user_id");				
						//$privacy = $sec_row['whocansee'];
						$this->layout='profile_layout';
						Yii::app()->clientScript->registerCoreScript('jquery'); 
						$user_additional_info['age'] = $userAge;
						
						$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));
					}
				}
				else /* if the user is not there with that profile id */ {
					$error = true;
				}
			
			}
			else /* if the url is not set */{
				$error = true;
			}			
			if($error){
				$this->redirect(Yii::app()->homeUrl);
			}
		}		 
	}
	
	public function actionAbout() 
	{		   
		/*$url = Yii::app()->session['url'];		 
		if(isset($url)) {			 
		$user = Yii::app()->session['user_id'];		  
		$mag_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='Magzine' and t.user_id=$user");		
		$design_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='Design' and t.user_id=$user");
		$shops_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='Shops' and t.user_id=$user");
		$styles_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='StyleIcons' and t.user_id=$user");
		$mtstyle_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='MyStyle' and t.user_id=$user");			
		$this->renderPartial('about', array('mag_tags'=>$mag_tags, 'design_tags'=>$design_tags,
		'shops_tags'=>$shops_tags, 'styles_tags'=>$styles_tags, 'mtstyle_tags'=>$mtstyle_tags));			
		} else{			 
			 echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->homeUrl));
					// Yii::app()->end();
			//$this->redirect(Yii::app()->homeUrl);	
		} */		
		$this->renderPartial('about');
			
	}	  
	
	public function actionError() {
		$this->render('error');
	}
	
	public function actionAlbums() {
		$this->renderPartial('albums');
	}
	
	public function actionRanks() 
	{
	  /*$url = Yii::app()->session['url'];			 
		if (isset($url)) {
			$access_user_id = Yii::app()->session['user_id'];			 
			$criteria = new CDbCriteria();				 
			$criteria->condition = 't.user_id = '.$access_user_id;				 
			$hearts = Photos::model()->with('logPhotosCount')->findAll($criteria);
			$ranks = UsersDetails::model()->find("user_id=$access_user_id");				 
			$this->renderPartial('rankings',array('model'=>$hearts, 'ranks'=>$ranks)); 			 
		} else {
			//$this->redirect(Yii::app()->homeUrl);
			echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->homeUrl));
		} */		
		$this->renderPartial('rankings');	
		  
	}
	
	 
	public function actionHearts(){		 
		/*$url = Yii::app()->session['url'];		 
		if (isset($url)) {			 
			$access_user_id = Yii::app()->session['user_id'];			 
			$criteria = new CDbCriteria();
			$criteria->offset = 0;
			$criteria->limit = 2;
			$criteria->condition = 't.user_id ='.$access_user_id;			 
			$hearts = LogPhotosHearts::model()->with('user.userDetails','photos', 'photos.logPhotosComments', 'photos.logPhotosCount')->findAll($criteria);	
			if(isset($hearts) && !empty($hearts)){
				$this->renderPartial('hearts',array('model'=>$hearts));
			}
			else {
				 echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->createUrl('profile/error')));
			}		 
		} else {
			echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->homeUrl));
		}*/
		$this->renderPartial('hearts');		
	}

	public function actionFollowing(){
		$this->renderPartial('following');
	}

	public function actionFollowers(){
		$this->renderPartial('followers');
	}

	public function actionCatwalk(){
		$this->renderPartial('catwalk');
	}
	
	public function actionFriends(){
		$this->renderPartial('friends');
	}
	
	/**
	* Displays the settings page for user
	* Last Modified:17-Oct-14
	*/	
	public function actionProfilesettings(){
		$this->layout='profile_layout';
		$this->render('index');
	}
	
		/**
	* Request friend request to the user
	* Last Modified:19-Oct-14
	*/	
	public function actionAddfriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		//$countries = Countries::model()->get_current_nearbycountries($ip);		
		$response = UsersFriends::model()->send_friend_request($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();
	}
	
	public function actionRemovefriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		$response = UsersFriends::model()->delete_friend($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();
	}
	
	public function actionFollowfriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		$response = UsersFollow::model()->follow_friend($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();		
	}
	
	public function actionFollowingfriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		$response = UsersFollow::model()->following_friend($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();		
	}	
	

	public function actionAddHearts() {
		
		$url = Yii::app()->session['url'];
		
		if(isset($_GET['action'])) {
			
			$action = $_GET['action'];
			
			if ($action == "heart") {
				if (isset($url)) {				
					$access_user_id = Yii::app()->session['user_id'];				 
					 
					$criteria = new CDbCriteria();
					$criteria->offset = $_GET['limit']-2;
					$criteria->limit = 2;
					$criteria->condition = 't.user_id ='.$access_user_id;
					 
					$hearts = LogPhotosHearts::model()->with('user.userDetails','photos', 'photos.logPhotosComments', 'photos.logPhotosCount')->findAll($criteria);							
					if (isset($hearts) && !empty($hearts)) 
						$this->renderPartial('addhearts',array('model'=>$hearts));
		 
				}  
			}
		 
		}
	}
}
?>
	
	
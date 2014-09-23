<?php
class ProfileController extends Controller {
	
	public $user_additional_info;
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
	public $profile_location;
	public $profile_details;
	public $avatar;
	public $gender;
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
					$this->profile_follower_count = Users::model()->get_profile_follower_count($row['user_id']);					
					$this->profile_following_count = Users::model()->get_profile_following_count($row['user_id']);
					$this->profile_location = Users::model()->get_profile_location($row['user_id']); 
					
					$user_additional_info['profile_hearts_count'] = $this->profile_hearts_count;
					$user_additional_info['profile_friends_count'] = $this->profile_friends_count;
					$user_additional_info['profile_follower_count'] = $this->profile_follower_count;
					$user_additional_info['profile_following_count'] = $this->profile_following_count;					
					$user_additional_info['profile_location'] = $this->profile_location;
					$user_id = $row['user_id'];					
					$sec_row = UsersSecurity::model()->find("user_id=$user_id");
					$privacy = $sec_row['whocansee'];					
					if ($privacy == 1) {	
						$this->layout='profile_layout';	
						Yii::app()->clientScript->registerCoreScript('jquery'); 
						$userAge = Users::model()->getUserAge($row['user_id']);
						$this->profile_details = Users::model()->getUserInfo($row['user_id']);
						$user_additional_info['users_details'] = $this->profile_details;
						$age = ($userAge) ? $userAge : "";
						$user_additional_info['age'] = $userAge;
						$user_additional_info['current_user'] = $this->user_guest;
						$this->avatar = $this->profile_details['user_details_avatar'];
						$fromurl = strstr($this->avatar, '://', true);
						if($fromurl=='http' || $fromurl=='https')
							$user_additional_info['avatar'] = $this->avatar; 
						else
						$user_additional_info['avatar'] = Yii::app()->baseUrl.'/profiles/'.$this->avatar;
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
					$this->profile_following_count = Users::model()->get_profile_following_count($row['user_id']);
					$this->profile_location = Users::model()->get_profile_location($row['user_id']); 
					
					$user_additional_info['profile_hearts_count'] = $this->profile_hearts_count;
					$user_additional_info['profile_friends_count'] = $this->profile_friends_count;
					$user_additional_info['profile_follower_count'] = $this->profile_follower_count;
					$user_additional_info['profile_following_count'] = $this->profile_following_count;					
					$user_additional_info['profile_location'] = $this->profile_location;
					
					$this->profile_details = Users::model()->getUserInfo($row['user_id']);
					$user_additional_info['users_details'] = $this->profile_details;					
					$this->current_profile_id = $user_id;
					$userAge = Users::model()->getUserAge($row['user_id']);
					$age = ($userAge) ? $userAge : "";
					$user_additional_info['age'] = $userAge;
					$this->layout='profile_layout';
					Yii::app()->clientScript->registerCoreScript('jquery');						
					//logged in user (own profile)
					if($id == $user_id) {
						$user_additional_info['age'] = $userAge;
						$user_additional_info['current_user'] = $this->user_self;
						//$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));
					}
					//loggedin user friend profile
					else if($check_friend){
						$user_additional_info['age'] = $userAge;
						$user_additional_info['current_user'] = $this->user_friend;
						//$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));
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
						//$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));
					}
					$this->avatar = $this->profile_details['user_details_avatar'];
					$fromurl = strstr($this->avatar, '://', true);
					if($fromurl=='http' || $fromurl=='https')
						$user_additional_info['avatar'] = $this->avatar; 
					else
						$user_additional_info['avatar'] = Yii::app()->baseUrl.'/profiles/'.$this->avatar;
						
					$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));	
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
	
	public function actionAbout(){
		$profile_url = $_REQUEST['param'];
		$id = Yii::app()->user->id;
		$user_about_info = array();
		$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
		$this->profile_details = Users::model()->getUserInfo($row['user_id']);
		$user_additional_info['users_details'] = $this->profile_details;			
		if(Yii::app()->user->isGuest) {
			$user_additional_info['current_user'] = $this->user_guest;
		}		
		elseif($id == $row['user_id']){
			$user_additional_info['current_user'] = $this->user_self;
		}
		else{
			$user_additional_info['current_user'] = $this->user_logged_vistor;
		}
		$userAge = Users::model()->getUserAge($row['user_id']);
		$user_additional_info['age'] = $userAge;
		$this->avatar = $this->profile_details['user_details_avatar'];
		$fromurl = strstr($this->avatar, '://', true);
		if($fromurl=='http' || $fromurl=='https')
			$user_additional_info['avatar'] = $this->avatar; 
		else
		$user_additional_info['avatar'] = Yii::app()->baseUrl.'/profiles/'.$this->avatar;
		if($this->profile_details['user_details_gender'] == 1){
			$this->gender = "Male";			
		}
		else{
			$this->gender = "female";
		}
		$user_additional_info['avatar'] = $this->gender; 
		$this->renderPartial('about', array('user_info' => $user_additional_info));
			
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
	
	
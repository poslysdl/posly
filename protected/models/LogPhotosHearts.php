<?php

/**
 * This is the model class for table "log_photos_hearts".
 *
 * The followings are the available columns in table 'log_photos_hearts':
 * @property integer $log_photos_hearts_id
 * @property integer $photos_id
 * @property integer $user_id
 * @property integer $log_photos_hearts_date
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Photos $photos
 */
class LogPhotosHearts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_photos_hearts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('photos_id, user_id, owner_id, log_photos_hearts_date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_photos_hearts_id, photos_id, user_id, owner_id, log_photos_hearts_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
			'photos' => array(self::BELONGS_TO, 'Photos', 'photos_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_photos_hearts_id' => 'Log Photos Hearts',
			'photos_id' => 'Photos',
			'user_id' => 'User',
			'log_photos_hearts_date' => 'Log Photos Hearts Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('log_photos_hearts_id',$this->log_photos_hearts_id);
		$criteria->compare('photos_id',$this->photos_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('log_photos_hearts_date',$this->log_photos_hearts_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogPhotosHearts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Name: getmyhashtags
	 * User_Define Function, to get Latest Hash from Logs
	 * @param numeric $limit record limit.
	 * @return Array of Latest hash	 
	 */
	public function getpeopleWhoLikes($photo_id,$limit = 15)
	{
		$query = "SELECT h.photos_id as photos_id,h.user_id as user_id,u.user_details_firstname as firstname,
		u.user_details_lastname as lastname FROM log_photos_hearts h JOIN users_details u ON h.user_id=u.user_id 
		WHERE h.photos_id = :pid LIMIT 0,:limit ";		
		$command= Yii::app()->db->createCommand($query);
		$command->bindValue(':pid', $photo_id);
		$command->bindValue(':limit', $limit);		
		$rawData = $command->queryAll();		
		return $rawData;
	}
	
	/**
	 * Name: createLikeCountHtml
	 * User_Define Function, to get HTML for You,People & Other Like This
	 * Due to Some Techical difficulty we are created HTML here in Model
	 * which is used in multiple place in Cart through Ajax & direct page Render process..
	 * @param numeric photo id and total likecount
	 * @return string
	 * Last Modified: 27-Sept-14
	 */
	public function createLikeCountHtml($photo_id,$likescount)
	{
		$uid=Yii::app()->user->id;		
		$lcount = $likescount;
		$you = false;
		$peopleLike = array();
		$myfriendsArray = array();
		$person_likes = array();
		if(!empty($uid))
		{
			$peopleLike = $this->getpeopleWhoLikes($photo_id); //List of People Who Likes..
			//Get List of All yr Friends...
			$query = "SELECT user_id,friend_id FROM users_friends WHERE user_id = '$uid'";
			$query.=" OR friend_id='$uid' AND status='1'";
			$command= Yii::app()->db->createCommand($query);				
			$rawData = $command->queryAll();
			if(isset($rawData) && count($rawData)>0)
			{
				foreach($rawData as $keys=>$values){
					if($values['user_id']==$uid)
						$myfriendsArray[] = $values['friend_id'];
					else
						$myfriendsArray[] = $values['user_id'];
				}
			}
		}	
		if(count($peopleLike)>0)
		{		
			foreach($peopleLike as $keys=>$values)
			{
				if($values['user_id']==$uid){
					$you = true;
				} else{	
					//Get List of Users who Liked It
					$person_likes[] = array('userid'=>$values['user_id'],
					'fname'=>$values['firstname'],'lname'=>$values['lastname']);
				}
			}			
		}
		//Create HTML Now ..
		$str = '';
		$pp='';
		if($likescount==0){	
			//No Likes
			$str.='<i class="icon-heart"></i><span lphid="'.$photo_id.'">0 Likes</span>';		
		}
		elseif($likescount==1)
		{	//Only 1 - Person Likes It
			if(count($person_likes)>0)
			{
				$ppid = $person_likes[0]['userid'];
				if(array_search($ppid, $myfriendsArray)){
					$pp = $person_likes[0]['fname'].' '.$person_likes[0]['lname'];					
				} else{
					$pp='1';
				}
			} 
			else{ 
				$pp=''; 
			}			
			$firstname = ($you)?'You':$pp;			
			$str.='<i class="icon-heart"></i> <a href="#">'.$firstname.'</a> ';
			$str.='<span lphid="'.$photo_id.'"> like this</span>';
		} 
		else
		{	// Multiple People Likes it ....
			//$lcount = $lcount - 1;
			if(count($person_likes)>0)
			{
				foreach($person_likes as $k1=>$v1)
				{
					$ppid = $v1['userid'];				
					if(array_search($ppid, $myfriendsArray)===false){
						$pp='';
					} else{						
						$pp = $person_likes[0]['fname'].' '.$person_likes[0]['lname'];
						$lcount = $lcount - 1;
						break; //atleast one of yr frnd Like it
					}
				} 
			}		
			$str.='<i class="icon-heart"></i>';
			if($you)
				$str.='<a href="#">You</a>&nbsp;';
			if($pp!='' && $you===true)
				$str.=',<a href="#">'.$pp.'</a>'; // for , symbol
			if($pp!='' && $you===false)
				$str.='<a href="#">'.$pp.'</a>';
			if($str==''){
				$str.='<span lphid="'.$photo_id.'"> '.$lcount.' people like this</span>';
			} else{				
				$str.='<span lphid="'.$photo_id.'"> and '.$lcount.' others like this</span>';
			}
		}		
		return $str;
	}
	
	/**
	 * Name: getActivityWhoLikes
	 * User_Define Function, to get Latest information
	 * of user who had like, used mainly for Site Users Activity
	 * @param numeric $limit record limit.
	 * @return Array of records	
	 * Last Modified: 16-Sept-14
	 */
	public function getActivityWhoLikes($limit = 15,$uid = null)
	{	
		if(empty($uid))
		{	//user is not logged in so, show every one's Photo likes randomly
			$query = "SELECT p.photos_id,p.album_id,p.photos_name,pl.log_photos_hearts_date as hdate,pl.user_id as userid,
			u.user_details_firstname as username,u.user_details_avatar as useravatar,pl.owner_id,CONCAT(ow.user_details_firstname,' ',ow.user_details_lastname) as ownername, p.user_id as photouserid,p.photos_name as photoname 
			FROM log_photos_hearts pl JOIN photos p ON pl.photos_id=p.photos_id JOIN users_details u ON pl.user_id=u.user_id
			JOIN users_details ow ON pl.owner_id=ow.user_id ORDER BY pl.log_photos_hearts_date DESC LIMIT 0,".$limit;
		} else{
			//user is Logged in so show only hi/her friends like's and photo likes			
			$query="SELECT * FROM 
			(";
				//get list of users who had like your photos
				$query.= "SELECT p.photos_id,p.album_id,p.photos_name,pl.log_photos_hearts_date as hdate,pl.user_id as userid,
				u.user_details_firstname as username,u.user_details_avatar as useravatar,pl.owner_id,'your' as ownername,
				p.user_id as photouserid,p.photos_name as photoname 
				FROM log_photos_hearts pl JOIN photos p ON pl.photos_id=p.photos_id JOIN users_details u ON pl.user_id=u.user_id
				WHERE pl.owner_id=".$uid;
				$query.=" UNION ";
				//get list of users who Followed You likes some photos of others
				$query.= "SELECT p.photos_id,p.album_id,p.photos_name,pl.log_photos_hearts_date as hdate,pl.user_id as userid,
				u.user_details_firstname as username,u.user_details_avatar as useravatar,pl.owner_id,CONCAT(ow.user_details_firstname,' ',ow.user_details_lastname) as ownername, p.user_id as photouserid,p.photos_name as photoname 
				FROM log_photos_hearts pl JOIN photos p ON pl.photos_id=p.photos_id JOIN users_details u ON pl.user_id=u.user_id
				JOIN users_details ow ON pl.owner_id=ow.user_id JOIN users_follow fw ON pl.user_id=fw.follow_id 
				WHERE pl.owner_id<>".$uid." AND fw.user_id=".$uid;
				$query.=" UNION ";
				//get list of users who You Followed likes some photos of others
				$query.= "SELECT p.photos_id,p.album_id,p.photos_name,pl.log_photos_hearts_date as hdate,pl.user_id as userid,
				u.user_details_firstname as username,u.user_details_avatar as useravatar,pl.owner_id,
				CONCAT(ow.user_details_firstname,' ',ow.user_details_lastname) as ownername, p.user_id as photouserid,p.photos_name as photoname 
				FROM log_photos_hearts pl JOIN photos p ON pl.photos_id=p.photos_id JOIN users_details u ON pl.user_id=u.user_id
				JOIN users_details ow ON pl.owner_id=ow.user_id JOIN users_follow fw ON pl.user_id=fw.user_id 
				WHERE pl.owner_id<>".$uid." AND fw.follow_id=".$uid;
				$query.=" UNION ";
				//get list When You Like someone Else's Photo
				$query.= "SELECT p.photos_id,p.album_id,p.photos_name,pl.log_photos_hearts_date as hdate,pl.user_id as userid,
				u.user_details_firstname as username,u.user_details_avatar as useravatar,pl.owner_id,u.user_details_firstname as ownername,
				p.user_id as photouserid,p.photos_name as photoname 
				FROM log_photos_hearts pl JOIN photos p ON pl.photos_id=p.photos_id JOIN users_details u ON pl.owner_id=u.user_id
				WHERE pl.user_id=".$uid;
			$query.=") as a ORDER BY hdate DESC LIMIT 0,".$limit; 
		}
		//Execute The Query
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();		
		return $rawData;
	}
	
}

?>
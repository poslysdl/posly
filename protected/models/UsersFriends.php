<?php
/**
 * This is the model class for table "users_friends".
 *
 * The followings are the available columns in table 'users_friends':
 * @property integer $user_friend_id
 * @property integer $user_id
 * @property integer $friend_id
 * @property integer $status
 * @property integer $user_friend_created_date
 *
 * The followings are the available model relations:
 * @property Users $friend
 * @property Users $user
 */
class UsersFriends extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_friends';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, friend_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_friend_id, user_id, friend_id', 'safe', 'on'=>'search'),
		);		
		
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		//*array('friend_id'=>'user_id') , Means JOIN user_detais ON friend_id=user_details.user_id 
		return array(
			'friend' => array(self::BELONGS_TO, 'UsersDetails', array('friend_id'=>'user_id')),
			'user' => array(self::BELONGS_TO, 'UsersDetails', array('user_id'=>'user_id')),
		);		
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_friend_id' => 'User Follow',
			'user_id' => 'User',
			'friend_id' => 'Friend',
			'status' => 'User Friend Status',
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

		$criteria->compare('user_friend_id',$this->user_friend_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('friend_id',$this->friend_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersFollow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Name: getActivityFriends
	 * User_Define Function, to get list of friends of loggedIn user
	 * who had recently become frnds of Others
	 * @param numeric $limit record limit.
	 * @param numeric $uid userid.
	 * @return Array of records	 
	 */
	public function getActivityFriends($limit = 15,$uid = null)
	{
		if(!empty($uid))
		{
			$query ="SELECT CONCAT(ffu.user_details_firstname,' ',ffu.user_details_lastname) as ffname,ffu.user_details_avatar as ffavatar,";
			$query.=" CONCAT(fu.user_details_firstname,' ',fu.user_details_lastname) as name,fu.user_details_avatar as avatar,";
			$query.=" f.user_id,f.friend_id,f.user_friend_created_date as date ";
			$query.=" FROM users_friends f JOIN users_details fu ON f.user_id=fu.user_id JOIN users_details ffu ON f.friend_id=ffu.user_id";
			$query.=" JOIN(SELECT friend_id as uid FROM users_friends WHERE user_id='".$uid."' AND status='1') as myfrnds ON f.user_id=myfrnds.uid";
			$query.=" WHERE f.status='1' ORDER BY f.user_friend_created_date DESC";
			$command= Yii::app()->db->createCommand($query);		
			$rawData = $command->queryAll();		
			return $rawData;
		}	
	}
	

	/**
	 * Name: getOnlineFriends
	 * User_Define Function, to get list of friends of loggedIn user
	 * who are Online for Chating
	 * @param numeric $limit record limit.
	 * @param numeric $uid record limit.
	 * @return Array of records	 
	 */
	public function getOnlineFriends($uid,$limit=7)
	{
		if(!empty($uid))
		{
			$query="SELECT ud.user_id as userid,ud.user_details_firstname as username,udu.user_online_flag as useronline,";
			$query.=" udu.user_logged_device as userdevice,ud.user_details_avatar as useravatar";
			$query.=" ,fd.user_id as frndid,fd.user_details_firstname as frndname,udf.user_online_flag as frndonline,";
			$query.=" udf.user_logged_device as frnddevice,fd.user_details_avatar as frndavatar";
			$query.=" FROM users_friends uf LEFT JOIN users_details ud ON uf.user_id=ud.user_id";
			$query.=" LEFT JOIN users_details fd ON uf.friend_id=fd.user_id JOIN users udu ON ud.user_id=udu.user_id";
			$query.=" JOIN users udf ON fd.user_id=udf.user_id WHERE uf.user_id='".$uid."' OR uf.friend_id='".$uid."' AND uf.status='1'";
			$query.=" LIMIT 0 , $limit";
			$command= Yii::app()->db->createCommand($query);		
			$rawData = $command->queryAll();
			return $rawData;
		} else{
			return null;
		}
	}
	
  //for sending friend request
	public function send_friend_request($profile_current,$profile_other){
		$parameters = array(":profile_current"=>$profile_current,":profile_other"=>$profile_other);
		$query ="SELECT * FROM users_friends WHERE user_id = $profile_current AND friend_id = $profile_other";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		$rawCount = count($rawData);
		if($rawCount<1){
			$sql = "insert into users_friends (user_id,friend_id) values (:profile_current,:profile_other)";
				
			if(Yii::app()->db->createCommand($sql)->execute($parameters)){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
		Yii::app()->end();
	}	
	// check friend	
	public function check_friend($profile_current,$profile_other){
		$query ="SELECT * FROM users_friends WHERE (user_id = $profile_current AND friend_id = $profile_other AND status = 1)";
		$query .="OR (user_id = $profile_other AND friend_id = $profile_current AND status = 1)";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		$rawCount = count($rawData);
		if($rawCount>0){
			return true;
		}
		else{
			return false;
		}
		
	}
	

	
	public function find_user_send_receive_request($profile_current,$profile_other,$user_request_send,$user_request_receive ){
		//current user has send invitation
		$query_profile_current ="SELECT * FROM users_friends WHERE user_id = $profile_current AND friend_id = $profile_other AND status = 0";
		$command_profile_current = Yii::app()->db->createCommand($query_profile_current);		
		$rawData_profile_current = $command_profile_current->queryAll();
		$rawCount_profile_current = count($rawData_profile_current);
		//profile user has send invitation
		$query_profile_other ="SELECT * FROM users_friends WHERE user_id = $profile_other AND friend_id = $profile_current AND status = 0";
		$command_profile_other = Yii::app()->db->createCommand($query_profile_other);		
		$rawData_profile_other = $command_profile_other->queryAll();
		$rawCount_profile_other = count($rawData_profile_other);
		if($rawCount_profile_current>0){
			return $user_request_send;
		}
		elseif($rawCount_profile_other>0){
			return $user_request_receive;
		}
		else{
			return false;
		}
		
	}
	
	public function delete_friend($profile_current,$profile_other){
		$query_profile_current ="SELECT * FROM users_friends WHERE user_id = $profile_current AND friend_id = $profile_other";
		$command_profile_current = Yii::app()->db->createCommand($query_profile_current);		
		$rawData_profile_current = $command_profile_current->queryAll();
		$rawCount_profile_current = count($rawData_profile_current);
		//profile user has invited
		$query_profile_other ="SELECT * FROM users_friends WHERE user_id = $profile_other AND friend_id = $profile_current";
		$command_profile_other = Yii::app()->db->createCommand($query_profile_other);		
		$rawData_profile_other = $command_profile_other->queryAll();
		$rawCount_profile_other = count($rawData_profile_other);
		if($rawCount_profile_current>0){			
			$query="DELETE FROM users_friends WHERE user_id = $profile_current AND friend_id = $profile_other";
			$command= Yii::app()->db->createCommand($query);
			$command->execute();
			return true;
		}
		elseif($rawCount_profile_other>0){
			$query="DELETE FROM users_friends WHERE user_id = $profile_other AND friend_id = $profile_current";
			$command= Yii::app()->db->createCommand($query);
			$command->execute();
			return true;
		}
		else{
			return false;
		}	

	}
	
}

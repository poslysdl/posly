<?php

/**
 * This is the model class for table "users_follow".
 *
 * The followings are the available columns in table 'users_follow':
 * @property integer $user_follow_id
 * @property integer $user_id
 * @property integer $follow_id .. who follows the user_id
 * @property integer $user_follow_type
 *
 * The followings are the available model relations:
 * @property Users $follow
 * @property Users $user
 */
class UsersFollow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_follow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, follow_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_follow_id, user_id, follow_id, user_follow_type', 'safe', 'on'=>'search'),
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
			'follow' => array(self::BELONGS_TO, 'Users', 'follow_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_follow_id' => 'User Follow',
			'user_id' => 'User',
			'follow_id' => 'Follow',
			'user_follow_type' => 'User Follow Type',
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

		$criteria->compare('user_follow_id',$this->user_follow_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('follow_id',$this->follow_id);
		$criteria->compare('user_follow_type',$this->user_follow_type);

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
	 * Name: getActivityFollow
	 * User_Define Function, to get list of Users who followed You	 
	 * @param numeric $limit record limit.
	 * @param numeric $uid userid.
	 * @return Array of records	 
	 */
	public function getActivityFollow($limit = 15,$uid = null)
	{
		if(!empty($uid))
		{			
			$query="SELECT CONCAT(fu.user_details_firstname,' ',fu.user_details_lastname) as name,fu.user_details_avatar as avatar,";
			$query.="f.user_id,f.follow_id,f.user_follow_created_date as date FROM users_follow f JOIN users_details fu";				
			$query.=" ON f.follow_id=fu.user_id WHERE f.user_id='$uid' ORDER BY f.user_follow_id DESC";
			$command= Yii::app()->db->createCommand($query);		
			$rawData = $command->queryAll();		
			return $rawData;
		}	
	}	
	
	
	//for process follow request
	public function follow_friend($profile_current,$profile_other){
		$parameters = array(":profile_current"=>$profile_current,":profile_other"=>$profile_other);
		$query ="SELECT * FROM users_follow WHERE user_id = $profile_current AND follow_id = $profile_other";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		$rawCount = count($rawData);
		if($rawCount==0){
			$sql = "insert into users_follow (user_id,follow_id) values (:profile_current,:profile_other)";				
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
	
	// For removing follow request	
	public function following_friend($profile_current,$profile_other){
		$parameters = array(":profile_current"=>$profile_current,":profile_other"=>$profile_other);
		$query ="SELECT * FROM users_follow WHERE user_id = $profile_current AND follow_id = $profile_other";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		$rawCount = count($rawData);
		if($rawCount>0){
			$query="DELETE FROM users_follow WHERE user_id = $profile_current AND follow_id = $profile_other";
			$command= Yii::app()->db->createCommand($query);
			$command->execute();
			return true;			
		}
		else{
			return false;
		}
	}
	
	public function check_follow($profile_current,$profile_other){
		$query ="SELECT * FROM users_follow WHERE user_id = $profile_current AND follow_id = $profile_other";
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
	
}

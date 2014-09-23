<?php

/**
 * This is the model class for table "users_messages".
 *
 * The followings are the available columns in table 'users_messages':
 * @property integer $user_message_id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property varchar $status
 * @property integer $message_created_date
 *
 * The followings are the available model relations:
 * @property Users $follow
 * @property Users $user
 */
class UsersMessages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_user_id, to_user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_message_id,from_user_id, to_user_id, status ', 'safe', 'on'=>'search'),
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
			'messagereply' => array(self::HAS_MANY, 'UsersMessagesReply', 'user_message_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_message_id' => 'Message Id',
			'from_user_id' => 'By User',
			'to_user_id' => 'To User',
			'status' => 'Status',
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
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('to_user_id',$this->to_user_id);		
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
	* Name: getLatestmsg
	* User_Define Function, to get Latest Message read/unread for TopMenu
	* @param numeric $limit record limit.
	* @return Array of Latest hash
	* Last Modified: 15-Sept-14
	*/
	public function getLatestmsg($uid,$userdetailid,$limit=5)
	{		
		$query = "SELECT m.user_message_id,m.from_user_id,ud.user_details_avatar as from_avatar,ud.user_details_id as from_detailid,";
		$query.=" ud.user_details_firstname as from_uname,m.to_user_id,udd.user_details_avatar as to_avatar,udd.user_details_firstname as to_uname,";
		$query.=" udd.user_details_id as to_detailid,mrply.reply,mrply.user_details_id as reply_detailid,mrply.messages_reply_id,";
		$query.=" mrply.status as rplystatus,mrply.reply_attachment as attach,mrply.reply_created_date as replydate";
		$query.=" FROM users_messages m JOIN users_details ud ON m.from_user_id=ud.user_id JOIN users_details udd ON m.to_user_id=udd.user_id";
		$query.=" JOIN (SELECT messages_reply_id,user_message_id,user_details_id,reply,status,reply_attachment,reply_created_date";
		$query.=" FROM users_messages_reply ORDER BY messages_reply_id DESC) as mrply ON m.user_message_id=mrply.user_message_id"; 
		$query.=" WHERE m.from_user_id=:uid OR m.to_user_id=:uidd GROUP BY m.user_message_id ORDER BY mrply.messages_reply_id DESC";
		$query.=" LIMIT 0,:limit";
		$command= Yii::app()->db->createCommand($query);
		$command->bindValue(':limit', $limit);
		$command->bindValue(':uid', $uid);
		$command->bindValue(':uidd', $uid);
		$rawData = $command->queryAll();
		return $rawData;
	}
}

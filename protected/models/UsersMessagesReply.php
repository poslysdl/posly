<?php

/**
 * This is the model class for table "users_messages_reply".
 *
 * The followings are the available columns in table 'users_messages_reply':
 * @property integer $messages_reply_id
 * @property integer $user_message_id
 * @property integer $user_details_id
 * @property varchar $reply
 * @property integer $reply_created_date
 *
 * The followings are the available model relations:
 * @property UsersDetails $userdetail 
 */
class UsersMessagesReply extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_messages_reply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_message_id, user_id', 'numerical', 'integerOnly'=>true),			
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
			'usersdetails' => array(self::BELONGS_TO, 'UsersDetails', 'user_details_id'),
			'message' => array(self::BELONGS_TO, 'UsersMessages', 'user_message_id'),
		);
	}

	//Above userdetails* is used as with() Refernce in command UsersMessagesReply::model()->with('usersdetails*')->find();
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_message_id' => 'Message Id',
			'user_details_id' => 'User',
			'reply' => 'Reply',
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
		$criteria->compare('user_message_id',$this->user_message_id);
		$criteria->compare('user_details_id',$this->user_id);		
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
	
}

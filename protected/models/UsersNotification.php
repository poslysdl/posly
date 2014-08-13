<?php

/**
 * This is the model class for table "users_notification".
 *
 * The followings are the available columns in table 'users_notification':
 * @property integer $user_notification_id
 * @property integer $user_notification_on
 * @property integer $user_like_pic
 * @property integer $user_follow_pic
 * @property integer $user_comment_pic
 * @property integer $user_sent_msg
 * @property integer $user_week_newsletter
 * @property integer $user_week_inspiration
 * @property integer $user_feature_announce
 * @property integer $user_weekly_pic
 * @property integer $user_someone_fb
 * @property integer $user_invitation_fb
 */
class UsersNotification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_notification_on, user_like_pic, user_follow_pic, user_comment_pic, user_sent_msg, user_week_newsletter, user_week_inspiration, user_feature_announce, user_weekly_pic, user_someone_fb, user_invitation_fb', 'required'),
			array('user_notification_on, user_like_pic, user_follow_pic, user_comment_pic, user_sent_msg, user_week_newsletter, user_week_inspiration, user_feature_announce, user_weekly_pic, user_someone_fb, user_invitation_fb', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_notification_id, user_notification_on, user_like_pic, user_follow_pic, user_comment_pic, user_sent_msg, user_week_newsletter, user_week_inspiration, user_feature_announce, user_weekly_pic, user_someone_fb, user_invitation_fb', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'Users', 'user_notification_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_notification_id' => 'User Notification',
			'user_notification_on' => 'User Notification On',
			'user_like_pic' => 'User Like Pic',
			'user_follow_pic' => 'User Follow Pic',
			'user_comment_pic' => 'User Comment Pic',
			'user_sent_msg' => 'User Sent Msg',
			'user_week_newsletter' => 'User Week Newsletter',
			'user_week_inspiration' => 'User Week Inspiration',
			'user_feature_announce' => 'User Feature Announce',
			'user_weekly_pic' => 'User Weekly Pic',
			'user_someone_fb' => 'User Someone Fb',
			'user_invitation_fb' => 'User Invitation Fb',
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

		$criteria->compare('user_notification_id',$this->user_notification_id);
		$criteria->compare('user_notification_on',$this->user_notification_on);
		$criteria->compare('user_like_pic',$this->user_like_pic);
		$criteria->compare('user_follow_pic',$this->user_follow_pic);
		$criteria->compare('user_comment_pic',$this->user_comment_pic);
		$criteria->compare('user_sent_msg',$this->user_sent_msg);
		$criteria->compare('user_week_newsletter',$this->user_week_newsletter);
		$criteria->compare('user_week_inspiration',$this->user_week_inspiration);
		$criteria->compare('user_feature_announce',$this->user_feature_announce);
		$criteria->compare('user_weekly_pic',$this->user_weekly_pic);
		$criteria->compare('user_someone_fb',$this->user_someone_fb);
		$criteria->compare('user_invitation_fb',$this->user_invitation_fb);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersNotification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

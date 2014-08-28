<?php

/**
 * This is the model class for table "log_photos_comment".
 *
 * The followings are the available columns in table 'log_photos_comment':
 * @property integer $log_photos_comment_id
 * @property integer $photos_id
 * @property integer $user_id
 * @property string $log_photos_comment_description
 * @property integer $log_photos_comment_hide
 * @property integer $log_photos_comment_date
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Photos $photos
 */
class LogPhotosComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_photos_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('photos_id, user_id, owner_id, log_photos_comment_hide, log_photos_comment_date', 'numerical', 'integerOnly'=>true),
			array('log_photos_comment_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_photos_comment_id, photos_id, user_id, owner_id, log_photos_comment_description, log_photos_comment_hide, log_photos_comment_date', 'safe', 'on'=>'search'),
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
			'photos' => array(self::BELONGS_TO, 'Photos', 'photos_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_photos_comment_id' => 'Log Photos Comment',
			'photos_id' => 'Photos',
			'user_id' => 'User',
			'log_photos_comment_description' => 'Log Photos Comment Description',
			'log_photos_comment_hide' => 'Log Photos Comment Hide',
			'log_photos_comment_date' => 'Log Photos Comment Date',
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

		$criteria->compare('log_photos_comment_id',$this->log_photos_comment_id);
		$criteria->compare('photos_id',$this->photos_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('log_photos_comment_description',$this->log_photos_comment_description,true);
		$criteria->compare('log_photos_comment_hide',$this->log_photos_comment_hide);
		$criteria->compare('log_photos_comment_date',$this->log_photos_comment_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogPhotosComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

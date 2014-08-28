<?php

/**
 * This is the model class for table "log_photos_share".
 *
 * The followings are the available columns in table 'log_photos_share':
 * @property integer $log_photos_share_id
 * @property integer $log_photos_share_media_id
 * @property integer $user_id
 * @property integer $photos_id
 * @property integer $log_photos_share_date
 *
 * The followings are the available model relations:
 * @property Photos $photos
 * @property Users $user
 */
class LogPhotosShare extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_photos_share';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, owner_id, photos_id, log_photos_share_date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_photos_share_id, log_photos_share_media_id, user_id, owner_id, photos_id, log_photos_share_date', 'safe', 'on'=>'search'),
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
			'photos' => array(self::BELONGS_TO, 'Photos', 'photos_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_photos_share_id' => 'Log Photos Share',
			'log_photos_share_media_id' => 'Log Photos Share Media',
			'user_id' => 'User',
			'photos_id' => 'Photos',
			'log_photos_share_date' => 'Log Photos Share Date',
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

		$criteria->compare('log_photos_share_id',$this->log_photos_share_id);
		$criteria->compare('log_photos_share_media_id',$this->log_photos_share_media_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('photos_id',$this->photos_id);
		$criteria->compare('log_photos_share_date',$this->log_photos_share_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogPhotosShare the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

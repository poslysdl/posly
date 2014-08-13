<?php

/**
 * This is the model class for table "photos_hashtags".
 *
 * The followings are the available columns in table 'photos_hashtags':
 * @property integer $photos_hashtags_id
 * @property integer $hashtags_id
 * @property integer $photos_id
 *
 * The followings are the available model relations:
 * @property Photos $photos
 * @property Hashtags $hashtags
 */
class PhotosHashtags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'photos_hashtags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hashtags_id, photos_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('photos_hashtags_id, hashtags_id, photos_id', 'safe', 'on'=>'search'),
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
			'hashtags' => array(self::BELONGS_TO, 'Hashtags', 'hashtags_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'photos_hashtags_id' => 'Photos Hashtags',
			'hashtags_id' => 'Hashtags',
			'photos_id' => 'Photos',
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

		$criteria->compare('photos_hashtags_id',$this->photos_hashtags_id);
		$criteria->compare('hashtags_id',$this->hashtags_id);
		$criteria->compare('photos_id',$this->photos_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PhotosHashtags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

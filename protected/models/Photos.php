<?php

/**
 * This is the model class for table "photos".
 *
 * The followings are the available columns in table 'photos':
 * @property integer $photos_id
 * @property integer $album_id
 * @property string $photos_name
 * @property integer $photos_hearts_count
 * @property integer $photos_created_date
 *
 * The followings are the available model relations:
 * @property LogPhotosComment[] $logPhotosComments
 * @property LogPhotosHearts[] $logPhotosHearts
 * @property LogPhotosShare[] $logPhotosShares
 * @property Albums $album
 * @property PhotosHashtags[] $photosHashtags
 */
class Photos extends CActiveRecord
{
	public $totalcount;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'photos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('album_id, user_id, photos_hearts_count, photos_created_date', 'numerical', 'integerOnly'=>true),
			array('photos_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('photos_id, album_id, user_id, photos_name, photos_hearts_count, photos_created_date', 'safe', 'on'=>'search'),
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
			'logPhotosComments' => array(self::HAS_MANY, 'LogPhotosComment', 'photos_id'),
			'logPhotosHearts' => array(self::HAS_MANY, 'LogPhotosHearts', 'photos_id'),
			'logPhotosCount' => array(self::STAT, 'LogPhotosComment', 'photos_id'),
			'logPhotosShares' => array(self::HAS_MANY, 'LogPhotosShare', 'photos_id'),
			'album' => array(self::BELONGS_TO, 'Albums', 'album_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'photosHashtags' => array(self::HAS_MANY, 'PhotosHashtags', 'photos_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'photos_id' => 'Photos',
			'album_id' => 'Album',
			'photos_name' => 'Photos Name',
			'photos_hearts_count' => 'Photos Hearts Count',
			'photos_created_date' => 'Photos Created Date',
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

		$criteria->compare('photos_id',$this->photos_id);
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('photos_name',$this->photos_name,true);
		$criteria->compare('photos_hearts_count',$this->photos_hearts_count);
		$criteria->compare('photos_created_date',$this->photos_created_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Photos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
}

<?php

/**
 * This is the model class for table "log_hashtags".
 *
 * The followings are the available columns in table 'log_hashtags':
 * @property integer $log_hashtags_id
 * @property integer $hashtags_id
 * @property integer $log_hashtags_date
 *
 * The followings are the available model relations:
 * @property Hashtags $hashtags
 */
class LogHashtags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_hashtags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('log_hashtags_id, hashtags_id, log_hashtags_date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_hashtags_id, hashtags_id, log_hashtags_date', 'safe', 'on'=>'search'),
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
			'hashtags' => array(self::BELONGS_TO, 'Hashtags', 'hashtags_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_hashtags_id' => 'Log Hashtags',
			'hashtags_id' => 'Hashtags',
			'log_hashtags_date' => 'Log Hashtags Date',
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

		$criteria->compare('log_hashtags_id',$this->log_hashtags_id);
		$criteria->compare('hashtags_id',$this->hashtags_id);
		$criteria->compare('log_hashtags_date',$this->log_hashtags_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogHashtags the static model class
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
	public function getmyhashtags($limit = 7)
	{
		$query = "SELECT t.hashtags_id as hashtags_id,
		t.hashtags_name as hashtags_name,t.hashtags_category_id as hashtags_category_id
		FROM hashtags t JOIN log_hashtags l ON t.hashtags_id = l.hashtags_id WHERE
		t.hashtags_category_id is null ORDER BY l.log_hashtags_date DESC LIMIT 0,:limit ";		
		$command= Yii::app()->db->createCommand($query);
		$command->bindValue(':limit', $limit);		
		$rawData = $command->queryAll();
		
		return $rawData;
	}
	
}

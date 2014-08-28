<?php

/**
 * This is the model class for table "users_location".
 *
 * The followings are the available columns in table 'users_location':
 * @property integer $user_location_id
 * @property string $user_location_city
 * @property string $user_location_state
 * @property string $user_location_region
 * @property string $user_location_country
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class UsersLocation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_location_city, user_location_state, user_location_region, user_location_country', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_location_id, user_location_city, user_location_state, user_location_region, user_location_country', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'Users', 'user_location_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_location_id' => 'User Location',
			'user_location_city' => 'User Location City',
			'user_location_state' => 'User Location State',
			'user_location_region' => 'User Location Region',
			'user_location_country' => 'User Location Country',
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

		$criteria->compare('user_location_id',$this->user_location_id);
		$criteria->compare('user_location_city',$this->user_location_city,true);
		$criteria->compare('user_location_state',$this->user_location_state,true);
		$criteria->compare('user_location_region',$this->user_location_region,true);
		$criteria->compare('user_location_country',$this->user_location_country,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersLocation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

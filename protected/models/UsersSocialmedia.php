<?php

/**
 * This is the model class for table "users_socialmedia".
 *
 * The followings are the available columns in table 'users_socialmedia':
 * @property integer $user_socialmedia_id
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class UsersSocialmedia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_socialmedia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_socialmedia_id, user_socialmedia_provider, user_socialmedia_identifier', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'Users', 'user_socialmedia_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_socialmedia_id' => 'User Socialmedia',
			'user_socialmedia_provider' => 'User Socialmedia Provider',
			'user_socialmedia_identifier' => 'User Socialmedia Identifier',
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersSocialmedia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

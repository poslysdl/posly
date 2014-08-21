<?php

/**
 * This is the model class for table "users_details".
 *
 * The followings are the available columns in table 'users_details':
 * @property integer $user_details_id
 * @property string $user_details_firstname
 * @property string $user_details_lastname
 * @property string $user_details_email
 * @property string $user_details_password
 * @property integer $user_details_dob
 * @property string $user_gender
 * @property string $user_height
 * @property string $user_weight
 * @property string $user_specification
 * @property string $user_eye_color
 * @property string $user_hair_color
 * @property integer $user_rank_incity
 * @property integer $user_rank_instate
 * @property integer $user_rank_inregion
 * @property integer $user_rank_incountry
 * @property integer $user_rank_worldwide
 * @property integer $user_id
 * @property integer $user_details_created_date
 *
 * The followings are the available model relations:
 * @property Users[] $users
 * @property Users $user
 */
class UsersDetails extends CActiveRecord
{
	public $highestrank;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_rank_incity, user_rank_instate, user_rank_inregion, user_rank_incountry, user_rank_worldwide, user_id, user_details_created_date', 'numerical', 'integerOnly'=>true),
			array('user_details_firstname, user_details_lastname, user_details_email, user_details_password, user_details_avatar, user_details_slogan', 'length', 'max'=>255),
			array('user_details_gender', 'length', 'max'=>1),
			array('user_details_height, user_details_weight, user_details_specification, user_details_eye_color, user_details_hair_color', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_details_id, searchprivacy, user_unique_url, user_details_firstname, user_details_lastname, user_details_email, user_details_password, user_details_dob, user_details_slogan, user_details_avatar, user_details_gender, user_details_height, user_details_weight, user_details_specification, user_details_eye_color, user_details_hair_color, user_rank_incity, user_rank_instate, user_rank_inregion, user_rank_incountry, user_rank_worldwide, user_id, user_details_created_date', 'safe', 'on'=>'search'),
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
			//'users' => array(self::HAS_MANY, 'Users', 'user_details_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_details_id' => 'User Details',
			'user_details_firstname' => 'User Details Firstname',
			'user_details_lastname' => 'User Details Lastname',
			'user_details_email' => 'User Details Email',
			'user_details_dob' => 'User Details Dob',
			'user_details_gender' => 'User Gender',
			'user_details_height' => 'User Height',
			'user_details_weight' => 'User Weight',
			'user_details_slogan'=>'User Slogan',
			'user_details_specification' => 'User Specification',
			'user_details_eye_color' => 'User Eye Color',
			'user_details_hair_color' => 'User Hair Color',
			'user_rank_incity' => 'User Rank Incity',
			'user_rank_instate' => 'User Rank Instate',
			'user_rank_inregion' => 'User Rank Inregion',
			'user_rank_incountry' => 'User Rank Incountry',
			'user_rank_worldwide' => 'User Rank Worldwide',
			'user_unique_url' => 'Unique URL',
			'searchprivacy' => 'Search Privacy',
			'user_id' => 'User',
			'user_details_created_date' => 'User Details Created Date',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "users_security".
 *
 * The followings are the available columns in table 'users_security':
 * @property integer $users_security_id
 * @property integer $user_id
 * @property string $users_security_password
 * @property string $users_security_password_exp
 * @property string $users_security_secretq1
 * @property string $users_security_secretq1ans
 * @property string $users_security_secretq2
 * @property string $users_security_secretq2ans
 * @property integer $users_security_profile_active
 *
 * The followings are the available model relations:
 * @property Users[] $users
 * @property Users $user
 */
class UsersSecurity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_security';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, users_security_profile_active', 'numerical', 'integerOnly'=>true),
			array('users_security_password, users_security_password_exp, users_security_secretq1, users_security_secretq1ans, users_security_secretq2, users_security_secretq2ans', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('users_security_id, whocansee, user_id, users_security_password, users_security_password_exp, users_security_secretq1, users_security_secretq1ans, users_security_secretq2, users_security_secretq2ans, users_security_profile_active', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'Users', 'user_security_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'users_security_id' => 'Users Security',
			'user_id' => 'User',
			'whocansee' => 'Who Can See',
			'users_security_password' => 'Users Security Password',
			'users_security_password_exp' => 'Users Security Password Exp',
			'users_security_secretq1' => 'Users Security Secretq1',
			'users_security_secretq1ans' => 'Users Security Secretq1ans',
			'users_security_secretq2' => 'Users Security Secretq2',
			'users_security_secretq2ans' => 'Users Security Secretq2ans',
			'users_security_profile_active' => 'Users Security Profile Active',
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

		$criteria->compare('users_security_id',$this->users_security_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('users_security_password',$this->users_security_password,true);
		$criteria->compare('users_security_password_exp',$this->users_security_password_exp,true);
		$criteria->compare('users_security_secretq1',$this->users_security_secretq1,true);
		$criteria->compare('users_security_secretq1ans',$this->users_security_secretq1ans,true);
		$criteria->compare('users_security_secretq2',$this->users_security_secretq2,true);
		$criteria->compare('users_security_secretq2ans',$this->users_security_secretq2ans,true);
		$criteria->compare('users_security_profile_active',$this->users_security_profile_active);
		$criteria->compare('whocansee',$this->whocansee,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersSecurity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

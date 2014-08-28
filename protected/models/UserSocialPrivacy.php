<?php

/**
 * This is the model class for table "user_social_privacy".
 *
 * The followings are the available columns in table 'user_social_privacy':
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property integer $user_i_like
 * @property integer $user_i_upload
 * @property integer $user_comment
 * @property integer $user_albums_fav
 */
class UserSocialPrivacy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_social_privacy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, type, user_i_like, user_i_upload, user_comment, user_albums_fav', 'required'),
			array('user_id, user_i_like, user_i_upload, user_comment, user_albums_fav', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, type, user_i_like, user_i_upload, user_comment, user_albums_fav', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'type' => 'Type',
			'user_i_like' => 'User I Like',
			'user_i_upload' => 'User I Upload',
			'user_comment' => 'User Comment',
			'user_albums_fav' => 'User Albums Fav',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('user_i_like',$this->user_i_like);
		$criteria->compare('user_i_upload',$this->user_i_upload);
		$criteria->compare('user_comment',$this->user_comment);
		$criteria->compare('user_albums_fav',$this->user_albums_fav);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSocialPrivacy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

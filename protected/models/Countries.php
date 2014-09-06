<?php

/**
 * This is the model class for table "countries".
 *
 * The followings are the available columns in table 'countries':
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 */
class Countries extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'countries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_code', 'length', 'max'=>2),
			array('country_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, country_code, country_name', 'safe', 'on'=>'search'),
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
			'country_code' => 'Country Code',
			'country_name' => 'Country Name',
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
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('country_name',$this->country_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Countries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	* Name: get_nearbycountries
	* User_Define Function, to get Near by countries
	* @param  $latlong Array of latitude and longitude
	* @return Array of Near by countries
	*/
	public function get_nearbycountries($geoinfo){
		$latitude = $geoinfo['latitude'];
		$longitude = $geoinfo['longitude'];
		$country = strtolower($geoinfo['country']);
		$query = "SELECT LOWER(country) AS countryname, alpha_2_code,alpha_3_code,
		3956 * 2 * ASIN(SQRT( POWER(SIN((".$latitude." -
		abs( 
		dest.latitude)) * pi()/180 / 2),2) + COS(".$latitude." * pi()/180 ) * COS( 
		abs
		(dest.latitude) *  pi()/180) * POWER(SIN((".$longitude." - dest.longitude) *  pi()/180 / 2), 2) ))
		 
		as distance FROM countries_lat_long dest having distance < 10000 ORDER BY distance limit 7";		
		
		$command= Yii::app()->db->createCommand($query);
		//$command->bindValue(':limit', $limit);
		$rawData = $command->queryAll();
		foreach($rawData as $subKey => $subArray){
			if($subArray['countryname'] == $country){
				  unset($rawData[$subKey]);
			}
		}	
		$jsonData = json_encode($rawData);
		return $jsonData;
	}

	/**	
	* User_Define Function, to get Regions wrt country
	* @param  $countryid Integer
	* @return Array of regions
	* Last Modified: 03-Sept-14
	*/
	public function getregions($countryid){
		//$countryid = mysql_real_escape_string($countryid);
		$query ="SELECT * FROM regions WHERE country_id='".$countryid."'";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		return $rawData;
	}
	
	/**	
	* User_Define Function, to get states wrt region
	* @param  $regionid Integer
	* @return Array of state
	* Last Modified: 03-Sept-14
	*/
	public function getstates($regionid){
		//$regionid = mysql_real_escape_string($regionid);
		$query ="SELECT * FROM states WHERE region_id='".$regionid."'";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		return $rawData;
	}
	
	/**	
	* User_Define Function, to get Cities wrt Sates
	* @param  $stateid Integer
	* @return Array of Cities
	* Last Modified: 03-Sept-14
	*/
	public function getcities($stateid,$countryid){
		//$stateid = mysql_real_escape_string($stateid);
		if($stateid==0 || empty($stateid))
			$query ="SELECT * FROM city WHERE country_id='".$countryid."'";
		else
			$query ="SELECT * FROM city WHERE state_id='".$stateid."'";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		return $rawData;
	}
	
}

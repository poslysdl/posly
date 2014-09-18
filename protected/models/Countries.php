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
	public function get_current_nearbycountries($ip){
		//$ip = '122.166.211.149';
		$countries = array();
		$query_current = "SELECT *
						FROM countries_ip_lat_long
					WHERE INET_ATON('".$ip."')
						BETWEEN ip_from AND ip_to
					LIMIT 1";
		$command_current = Yii::app()->db->createCommand($query_current);
		//$command->bindValue(':limit', $limit);
		$raw_current_Data = $command_current->queryAll();
		foreach($raw_current_Data as $raw_current){
			$countries['current']['country_name']= $raw_current['country_name'];
			$countries['current']['country_code'] = $raw_current['country_code'];
			$countries['current']['region_name'] = $raw_current['region_name'];
			$countries['current']['city_name'] = $raw_current['city_name'];
			$countries['current']['latitude'] = $raw_current['latitude'];
			$countries['current']['longitude'] = $raw_current['longitude'];
			$countries['current']['zip_code'] = $raw_current['zip_code'];
			$countries['current']['time_zone'] = $raw_current['time_zone'];					
		}
		$latitude = $countries['current']['latitude'];
		$longitude = $countries['current']['longitude'];
		$current_country = strtolower($countries['current']['country_name']);		
		$query_nearby = "SELECT LOWER(country) AS countryname, alpha_2_code,alpha_3_code,
		3956 * 2 * ASIN(SQRT( POWER(SIN((".$latitude." -
		abs( 
		dest.latitude)) * pi()/180 / 2),2) + COS(".$latitude." * pi()/180 ) * COS( 
		abs
		(dest.latitude) *  pi()/180) * POWER(SIN((".$longitude." - dest.longitude) *  pi()/180 / 2), 2) ))		 
		as distance FROM countries_lat_long dest having distance < 10000 ORDER BY distance limit 7";	
		$command_nearby = Yii::app()->db->createCommand($query_nearby);
		//$command->bindValue(':limit', $limit);
		$countries['nearby'] = array();
		$raw_nearby_Data = $command_nearby->queryAll();
		foreach($raw_nearby_Data as $subKey => $subArray){
			if($subArray['countryname'] == $current_country){
				  unset($raw_nearby_Data[$subKey]);
			}
			else{
				$countries['nearby'][] = array("country_name" => $subArray['countryname'],"country_code" => $subArray['alpha_2_code']);
			}
			
		}		
		$jsonData = json_encode($countries);
		return $jsonData;		
	}
	
	/**	
	* User_Define Function, to get World countries	
	* @return Array of countries
	* Last Modified: 18-Sept-14
	*/
	public function getcountries(){
		$query ="SELECT distinct(country_code) as id,country_name FROM countries_ip_lat_long ORDER BY country_name";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();		
		return $rawData;
	}
	
	/**	
	* User_Define Function, to get Regions wrt country
	* @param  $countryid Integer
	* @return Array of regions
	* Last Modified: 18-Sept-14
	*/
	public function getregions($countryid){		
		$query ="SELECT distinct(region_name) as id,region_name as name FROM countries_ip_lat_long";
		$query.=" WHERE country_code='".$countryid."' AND region_name<>'-' ORDER BY region_name";
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
		$query ="SELECT * FROM states WHERE region_id='".$regionid."'";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		return $rawData;
	}
	
	/**	
	* User_Define Function, to get Cities wrt Sates
	* @param  $stateid Integer
	* @return Array of Cities
	* Last Modified: 18-Sept-14
	*/
	public function getcities($stateid,$countryid){
		$stateid = strtoupper($stateid);
		$query ="SELECT distinct(city_name) as id,city_name as name";
		$query.=" FROM countries_ip_lat_long WHERE region_name='".$stateid."' AND city_name<>'-' ORDER BY city_name";
		$command= Yii::app()->db->createCommand($query);		
		$rawData = $command->queryAll();
		return $rawData;
	}
	
}

<?php
/*
* photo likes counts actions
*/
class LikesController extends Controller
{
	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules., Only for Methods Called from Site
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('cincrease','cdecrease','getlikehtml'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/* This user define Ajax function 
	* is used to return the html for rendering of People who like it section at Cart
	* Add getlikehtml to accessRules function, so that Site can access it.
	* Last Modified:24-Sep-14
	*/
	public function actionGetlikehtml()
	{
		$photoid= $_POST['pid'];
		$totallike_count = $_POST['pdata'];		
		$html = LogPhotosHearts::model()->createLikeCountHtml($photoid,$totallike_count);
		echo $html;		
		Yii::app()->end();		
	}
	
	/* This user define Ajax function
	*  for increase the like count.
	*  Last Modified:24-Sep-14
	*/	
	public function actionCincrease()
	{
		$id= $_GET['id'];
		$uid=Yii::app()->user->id;
		$count=Photos::model()->findByPk($id);
		$count->photos_hearts_count+=1;
		$count->save();		
		$likes= new LogPhotosHearts;
		$likes->user_id= $uid;
		$likes->owner_id=$count->user_id;
		$likes->photos_id=$id;
		$time=new CTimestamp;
		$value=$time->getDate();
		$likes->log_photos_hearts_date=$value[0];
		$likes->save();	
		//$this->Updaterank('add',$count->user_id); //Update User Ranking		
		echo $count->photos_hearts_count;
		Yii::app()->end();
	}
	
	/* This user define Ajax function
	*  for decrease the like count.
	*  Last Modified:24-Sep-14
	*/
	public function actionCdecrease()
	{
		$id= $_GET['id'];
		$uid=Yii::app()->user->id;
		$count=Photos::model()->findByPk($id);
		if($count->photos_hearts_count>0)
		{
			$count->photos_hearts_count-=1;
			$count->save();
		}
		$dlike=LogPhotosHearts::model()->find("user_id=$uid and photos_id=$id");
		$dlike->delete();
		$this->Updaterank('sub',$count->user_id); //Rank
		echo $count->photos_hearts_count;		
		Yii::app()->end();
	}	
	
	/* This user define function is used to to increase
	* or decrease ranking fields city,regin,country wrt to Heart Like
	* Last Modified:24-Sep-14
	* As This Method is use within the Class, therefore No Action keyword & accessRule require
	*/
	public function Updaterank($flag,$uid)
	{		
		$users = Users::model()->getUserInfo($uid);
		$userdetailid = $users['user_details_id'];
		$maxrankArray = UsersDetails::model()->getMaxRank($uid,$userdetailid);
		if(!empty($userdetailid))
		{			
			$count=UsersDetails::model()->findByPk($userdetailid);						
			//set ranks
			$city=$count->user_rank_incity;
			$region=$count->user_rank_inregion;
			$country=$count->user_rank_incountry;
			$world=$count->user_rank_worldwide;
			$count->user_rank_incity=$this->GetNewrank($city,$flag,$maxrankArray['city']);
			$count->user_rank_inregion=$this->GetNewrank($region,$flag,$maxrankArray['region']);
			$count->user_rank_incountry=$this->GetNewrank($country,$flag,$maxrankArray['country']);
			$count->user_rank_worldwide=$this->GetNewrank($world,$flag,$maxrankArray['world']);	
			$count->save();
			unset($count);
			$this->RevisedOthersRank($city,$region,$country,$world,$uid,$userdetailid,$flag,$maxrankArray);
			unset($maxrankArray);
		}
	}
	
	/* This user define function used to calculate rank	
	* Last Modified:24-Sep-14
	* As This Method is use within the Class, therefore No Action keyword & accessRule require
	*/
	public function GetNewrank($value,$flag,$maxrank)
	{		
		if($flag=="add"){
			if($value==0){
				$value = $maxrank+1;
			} else{
				($maxrank<2)?1:$maxrank-1;			
			}
		} else{
			if($value==0){
				$value = 0;
			} else{
				($maxrank<2)?0:$maxrank+1;			
			}
		}
		return $value;
	}
	
	/* This user define function
	* used to Update other User Rank, whose Place This user has Acquire
	* Last Modified:24-Sep-14
	* As This Method is use within the Class, therefore No Action keyword & accessRule require
	*/
	public function RevisedOthersRank($prevcity,$prevregion,$prevcountry,$prevworld,$uid,$userdetailid,$flag,$maxrankArray)
	{	
		if($flag=="add")
		{	//Revised the other User Rank, Whose Rank This user Had Acquire
			$cityid = $maxrankArray['cityid'];
			if(!empty($cityid)){
				$thisUserNewRank = GetNewrank($prevcity,$flag,$maxrankArray['city']);
				UsersDetails::model()->updateOthersRank('city',$thisUserNewRank,$prevcity,$cityid,$userdetailid);
			}
			$regionid = $maxrankArray['regionid'];
			if(!empty($regionid)){
				$thisUserNewRank = GetNewrank($prevregion,$flag,$maxrankArray['region']);
				UsersDetails::model()->updateOthersRank('region',$thisUserNewRank,$prevregion,$regionid,$userdetailid);
			}
			$countryid = $maxrankArray['countryid'];
			if(!empty($countryid)){
				$thisUserNewRank = GetNewrank($prevcountry,$flag,$maxrankArray['country']);
				UsersDetails::model()->updateOthersRank('country',$thisUserNewRank,$prevcountry,$countryid,$userdetailid);
			}
			//World
			if($prevworld!=""){
				$thisUserNewRank = GetNewrank($prevworld,$flag,$maxrankArray['world']);
				UsersDetails::model()->updateOthersRank('world',$thisUserNewRank,$prevworld,'',$userdetailid);
			}
		}
		return null;
	}
	
//END	
}
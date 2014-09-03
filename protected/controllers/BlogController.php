<?php

class BlogController extends Controller
{
	public function actionIndex()
	{
		$this->layout='front_layout';
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = 9;
		$hash_tags = $this->actionHashtaglist($limit);			
		//Inside views/site/index.php ** widget are there to Include SubHeader, TopMenu & SideBar..
		$this->render('index', array('hash_tags'=>$hash_tags));		
	}
}

?>
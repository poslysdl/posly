<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$pageflag = (isset($pageflag))?$pageflag:'';
$pageflagid = (isset($pageflagid))?$pageflagid:'';
?> 

<div id="leftside">
<?php
	$k=$_GET['l']+1;
	if(isset($photos) && count($photos)>0)
	{
		$i=1;
		foreach($photos as $p)
		{
			if($i%2!=0)
			{
				$this->widget('application.components.Cart', array('cartinfo' => array('data'=>$p,'i'=>$i,'pageflag'=>$pageflag,'pageflagid'=>$pageflagid)));			
			}
			$i++;
			$k+=2;
		}
	} 
  
?>
</div>
<div id="rightside">
<?php
	$k=$_GET['l']+2;
	if(isset($photos) && count($photos)>0)
	{
		$i=1;
		foreach($photos as $p)
		{
			if($i%2==0)
			{	
				$this->widget('application.components.Cart', array('cartinfo' => array('data'=>$p,'i'=>$i,'pageflag'=>$pageflag,'pageflagid'=>$pageflagid)));
			}
			$i++;
			$k+=2;
		}
	} 
?>
</div>

<!-- Modal Box img-zoom ZOOM IMAGE, Get Zoom images of Images going to append while window scrolls ------->
<div id="zoomimagediv">
<?php
if(isset($photos) && count($photos)>0)
{	
	$i=1;
	foreach($photos as $p)
	{
		
		$this->widget('application.components.CartZoom', array('cartinfo' => array('data'=>$p,'i'=>$i,'pageflag'=>$pageflag,'pageflagid'=>$pageflagid))); //ZOOM Image Cart			
		$i++;
	}
}
?>
</div>
<!--Modal Box img-zoom END --> 


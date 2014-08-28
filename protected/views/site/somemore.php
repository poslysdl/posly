<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?> 

<div id="leftside">
<?php
	$k=$_GET['l']+1;
	if(isset($photos))
	{
		$i=1;
		foreach($photos as $p)
		{
			if($i%2!=0)
			{
				$this->widget('application.components.Cart', array('cartinfo' => array('data'=>$p,'i'=>$i)));			
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
	if(isset($photos))
	{
		$i=1;
		foreach($photos as $p)
		{
			if($i%2==0)
			{	
				$this->widget('application.components.Cart', array('cartinfo' => array('data'=>$p,'i'=>$i)));
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
if(isset($photos)) 
{	
	$i=1;
	foreach($photos as $p)
	{
		
		$this->widget('application.components.CartZoom', array('cartinfo' => array('data'=>$p,'i'=>$i))); //ZOOM Image Cart			
		$i++;
	}
}
?>
</div>
<!--Modal Box img-zoom END --> 


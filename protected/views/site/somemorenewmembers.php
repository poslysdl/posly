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
		$this->widget('application.components.Cart', array('cartinfo' => array('data'=>$p,'i'=>$i))); //Main Image CART Display Here		
	}
	$i++;
	$k+=2;
	}
} ?>

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
			$this->widget('application.components.Cart', array('cartinfo' => array('data'=>$p,'i'=>$i))); //Main Image CART Display Here			
		}
		$i++;
		$k+=2;
	}
 } ?>
</div>
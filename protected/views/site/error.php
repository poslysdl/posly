<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
//$this->breadcrumbs=array('Error',);
?>
<!-- BEGIN TOP NAVIGATION MENU -->
<?php $this->widget('application.components.TopNavigationMenu', array('navigationmenu' => array('menu'=>'data_tobe_render_in_menus'))); ?>
<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">
	<h2>Error: <?php echo $code; ?></h2>
	<div class="error">
	<?php echo CHtml::encode($message); ?>
	</div>
</div>
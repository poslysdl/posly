<?php
if(!isset($menulink))
	$menulink = 'viral';
?>

<!-- BEGIN TOP NAVIGATION MENU -->
	<?php $this->widget('application.components.TopNavigationMenu', array(
	'navigationmenu' => array('menu'=>'data_tobe_render_in_menus'))); ?>
<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER --> 

<!--SUB HEADER-->
<?php $this->widget('application.components.SubHeader', array(
'subheader' => array('data'=>array('menulink'=>$menulink)))); 
?>
<!--END SUB HEADER-->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container"> 
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
	<?php $this->widget('application.components.SidebarHome', array(
	'sidebar' => array('data'=>array('hash_tags'=>$hash_tags)))); ?>
	</div>
	<!-- END SIDEBAR --> 
	<!-- BEGIN PAGE -->
	<div class="page-content-wrapper">
	<div class="page-content">
	<div class="container sp">
	<div class="row ">
			<div style="text-align:center;margin-top:20px;font-weight:bold;color:blue;">Page Under Construction</div>
	</div>
	</div>
	<div class="clearfix"></div>

	<div id="country-list" class="modal fade modal-dialog country-list" tabindex="-1" aria-hidden="true">
	<?php $this->widget('application.components.AllCountries', array(
	'allcountries' => array('data'=>''))); ?> <!--Browse All Countries Modal POPUP Window -->
	</div> 
	</div>
	</div>
</div>
<!-- END CONTAINER --> 
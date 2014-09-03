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
	<div class="page-content11111">
		<div class="container sp">
		
		<div style="text-align:center;margin-top:20px;font-weight:bold;color:blue;">Page Under Construction</div>
		
		<div class="row ">
		<div class="col-md-6 col-sm-6">		
		</div>
		<div class="col-md-6 col-sm-6">		
		</div>
		</div>
		</div>
		<div class="clearfix"></div>		  
		<!--*-->       
		<!-- Modals-->		
		<!-- Modal Box img-zoom ZOOM IMAGE ------->
		<div id="share-pic" class="modal  modal-scroll share-image" tabindex="-1" data-replace="true">		
		</div>
		<!--Modal Box img-zoom END --> 		  
		<div id="country-list" class="modal fade modal-dialog country-list" tabindex="-1" aria-hidden="true">
			<?php $this->widget('application.components.AllCountries', array(
			'allcountries' => array('data'=>''))); ?> <!--Browse All Countries Modal POPUP Window -->
		</div>         
	</div>
</div>
  
  
	<!-- BEGIN QUICK SIDEBAR MENU MOBILE -->
	<div class="page-quick-sidebar-wrapper">
	<div class="page-sidebar-quick">
	<!-- BEGIN SIDEBAR MENU -->
	<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
	<li class="sidebar-search-wrapper">
	<form class="sidebar-search" action="extra_search.html" method="POST">
	<a href="javascript:;" class="remove">
	<i class="icon-close"></i>	</a>
	<div class="input-group">
	<input type="text" class="form-control" placeholder="search tag & user">
	<input type="button" class="submit" value="&#xe058;"/>
	</div>
	</form>
	<!-- END RESPONSIVE QUICK SEARCH FORM -->
	</li>
	<li  class="start ">
	<a href="javascript:;">
	<img class="avatar-user img-responsive" alt="" src="assets/img/avatar1.jpg" />
	<span class="name">Chanh Ny</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
	<li>
	<a href="#">
	My profile</a>
	</li>
	<li>
	<a href="#">
	setting</a>
	</li>
	<li>
	<a href="#">
	log out</a>
	</li>
	</ul>
	</li>
	<li>
	<a href="javascript:;">
	<span class="title">Catwalk</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
	<li>
	<a href="#">
	Top member</a>
	</li>
	<li>
	<a href="#">
	Going rival</a>
	</li>
	<li>
	<a href="#">
	New Member</a>
	</li>
	<li>
	<a href="#">
	Monaco</a>
	</li>
	</ul>
	</li>
	<li>
	<a href="#">
	<span class="title">news feed</span>
	</a>
	</li>
	<li class="last ">
	<a href="#">
	<span class="title">blog</span>
	</a>
	</li>
	</ul>
	<!-- END SIDEBAR MENU -->
	</div>
	</div>    
	<!-- END QUICK SIDEBAR MENU MOBILE -->
	
<!-- END PAGE --> 
</div>
<!-- END CONTAINER --> 

<?php
if(!isset($menulink)){
	$menulink = 'viral';
	if(Yii::app()->user->isGuest)
		$menulink = 'topmember';
}

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
	<div class="col-md-6 col-sm-6">
<!--Reset password Starts-->
	<form method="POST" action="#" id="resetpassword-form" onsubmit="return false;" data-url="<?php echo Yii::app()->createUrl('/site/resetpasswordajax');?>" class="reg-form">
	<h3 class="form-title">Reset Password</h3>
	<div class="form-group">
		<label for="ResetpasswordForm_password" class="control-label visible-ie8 visible-ie9 required">Password <span class="required">*</span></label>		
		<div class="input-icon"> <i class="icon-key"></i>
		<input type="password" id="ResetpasswordForm_password" name="ResetpasswordForm[password]" placeholder="Password" class="form-control placeholder-no-fix" >		
		</div>
		<div style="display:none" id="ResetpasswordForm_password_em_" class="errorMessage"></div>	
	</div>
	<div class="form-group">
		<label for="ResetpasswordForm_password" class="control-label visible-ie8 visible-ie9 required">Re-type Password <span class="required">*</span>
		</label>		
		<div class="input-icon"> <i class="icon-key"></i>
		<input type="password" id="ResetpasswordForm_retype_password" name="ResetpasswordForm_retype_password[retype_password]" placeholder="Re-type Password" class="form-control placeholder-no-fix">		
		</div>
		<div style="display:none" id="ResetpasswordForm_retype_password_em_" class="errorMessage"></div>
		<div class="errorMessage" id="lerrormsg" style="display:block;color:red;margin-top:3px;"></div>
		<input type="hidden" id="ResetpasswordForm_user_detail_id" name="ResetpasswordForm[user_detail_id]" value="<?php echo $user['user_detail_id'];?>" />
	</div>
	<div class="modal-div">
		<div class="divider"></div>
	</div>
	<div class="modal-footer">
		<input type="button" id="submit_resetpassword" value="SUBMIT" name="yt0" class="btn blue">          
	</div>
	</form>

<!--Reset password Ends-->
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

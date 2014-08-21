
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
'subheader' => array('data'=>'data_tobe_render_in_subHeaders'))); ?>
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
	<?php
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
		}
	}
	?>
	</div>
	<div class="col-md-6 col-sm-6"> 
	<?php
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
		}
	}
	?>
	</div>
	</div>
	</div>
	<div class="clearfix"></div>
      
    <!--*-->       
    <!-- Modals--> 
	
    <!-- Modal Box img-zoom ZOOM IMAGE ------->
    <div id="share-pic" class="modal  modal-scroll share-image" tabindex="-1" data-replace="true">
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
	
    <!--modal sign up-->
		<div class="modal fade modal-dialog modal-sign-up" id="sign-up" tabindex="-1" data-focus-on="input:first" aria-hidden="true">
		<div class="modal-content">
		<div class="modal-body"> 
		<!-- BEGIN LOGIN FORM -->
		<form class="reg-form" action="#" method="post">
		<h3 class="form-title">SIGN UP WITH EMAIL</h3>
		<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Your Name</label>
		<div class="input-icon"> <i class="icon-user"></i>
		<input class="form-control placeholder-no-fix" type="text" data-tabindex="1" placeholder="Your Name" name="fullname"/>
		</div>
		</div>
		<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Please choose a Username</label>
		<div class="input-icon"> <i class="icon-user"></i>
		<input class="form-control placeholder-no-fix" type="text" data-tabindex="2" placeholder="Your Name" name="fullname"/>
		</div>
		</div>
		<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Email</label>
		<div class="input-icon"> <i class="icon-envelope"></i>
		<input class="form-control placeholder-no-fix" type="text" placeholder="Email " name="Email"/>
		</div>
		</div>
		<div class="form-group endform"> 
		<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
		<label class="control-label visible-ie8 visible-ie9">Password</label>
		<div class="input-icon"> <i class="icon-key"></i>
		<input class="form-control placeholder-no-fix" type="text" placeholder="Password" name="password"/>
		</div>
		</div>
		</form>
		<!-- END LOGIN FORM --> 
		</div>
		<div class="modal-div">
		<div class="divider"></div>
		</div>
		<div class="modal-footer">
		<label> By creating an account, 
		you confirm that you have read and 
		agree with the <a href="#"> Terms of Service </a> </label>
		<button type="button" class="btn blue"  data-dismiss="modal">Sign Up</button>
		</div>
		</div>
		<!-- /.modal-content --> 
		<!-- /.modal-dialog --> 
		</div>
    <!--end modal sign up-->
      
	<div id="country-list" class="modal fade modal-dialog country-list" tabindex="-1" aria-hidden="true">
		<?php $this->widget('application.components.AllCountries', array(
		'allcountries' => array('data'=>''))); ?> <!--Browse All Countries Modal POPUP Window -->
	</div>
      
    <!-- /.modal share big images --> 
      
	<!-- Modal Box img-zoom -->
	 
    <!--end- Modal Box img-zoom --> 
      
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

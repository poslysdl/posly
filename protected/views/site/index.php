
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
      
    <!-- /.modal  sign in-->
		
    <!-- /.modal --> 
      
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
      
	<!-- long modals -->
		<div id="share-pic" class="modal  modal-scroll share-image" tabindex="-1" data-replace="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
		</div>
		<div class="modal-body">
		<div class="portlet box blue">
		<div class="portlet-title">
		<div class="caption"> <img src="assets/img/avatar1_small.jpg" alt="" class="avatar-user-l img-responsive">
		<div class="cap1"> <a class="username" href="#">Sugargirl</a><span class="user-locaion">Germany, Berlin</span> </div>
		</div>
		<div class="rank">
		<div class="share-ranks"> <a href="#" class="dropdown-toggle"  data-toggle="dropdown" data-close-others="true"><i class="icon-retweet"></i></a>
		<ul class="dropdown-menu share-pic">
		<li><span>Share now on</span></li>
		<li>
		<button type="button" class="btn faceS" >Facebook</button>
		</li>
		<li>
		<button type="button" class="btn twistS" >Twitter</button>
		</li>
		<li>
		<button type="button" class="btn vkS" >VK</button>
		</li>
		<li>
		<button type="button" class="btn pinter" >Pinterest</button>
		</li>
		<li>
		<button type="button" class="btn insta" >Instagram</button>
		</li>
		<li>
		<button type="button" class="btn googlep" >Google +</button>
		</li>
		<li class="endles">
		<button type="button" class="btn meoS" data-toggle="modal" href="#sign-up">Email</button>
		</li>
		</ul>
		</div>
		<h2> #6 Rank </h2>
		<span class="arrow"> </span> </div>
		</div>
		<div class="portlet-body">
		<div class="main-img-user">
		<div class="owl-carousel owl-carousel-chanhny3 view-first noscale">
		<div class="article-image" data-dot="<img class='img-responsive' src='assets/img/gallery/album2/b1s.jpg'>"><a class="hover-zomm"><img src="assets/img/gallery/album2/b1.jpg" class="lazyOwl img-responsive" alt=""></a>
		<div class="mask"> <a class="like" data-toggle="modal" href="#sign-in"><i class="icon-heart-empty"></i></a> </div>
		</div>
		<div class="article-image" data-dot="<img class='img-responsive' src='assets/img/gallery/album2/b2s.jpg'>"><a class="hover-zomm" ><img src="assets/img/gallery/album2/b2.jpg" class="lazyOwl img-responsive" alt=""></a>
		<div class="mask"> <a class="like" data-toggle="modal" href="#sign-in"><i class="icon-heart"></i></a> </div>
		</div>
		<div class="article-image" data-dot="<img class='img-responsive' src='assets/img/gallery/album2/b3s.jpg'>"><a class="hover-zomm" ><img src="assets/img/gallery/album2/b3.jpg" class="lazyOwl img-responsive" alt=""></a>
		<div class="mask"> <a class="like" data-toggle="modal" href="#sign-in"><i class="icon-heart-empty"></i></a> </div>
		</div>
		</div>
		</div>
		<div class="panel-title">
		<h3>Tagged with</h3>
		</div>
		<div class="main-tag">
		<div class="tagcloud"> <a href="#">Gucci</a> <a href="#">Louis Vuitton</a> <a href="#l">Love</a> <a href="#">MC</a> <a href="#">Prada  Maksita</a> <a href="#">D&amp;G</a></div>
		</div>
		</div>
		</div>

		<!--part2-->

		<div class="portlet box blue">
		<div class="portlet-body">
		<div class="main-name"> <i class="icon-heart"></i> <a href="#">Kamasumi Benzo</a> <span>& 95 others like this</span> </div>
		<div class="main-comment"  >
		<div class="scrollercm" style="height: 220px;" data-always-visible="1" data-rail-visible1="1">
		<ul class="CMn">
		<li class="in"> <img class="avatar img-responsive" alt="" src="assets/img/avatar1.jpg" />
		<div class="message"> <a href="#" class="name">Ny Nilson</a> <span class="datetime">@ Jul 25, 2012 11:09</span> <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span> </div>
		</li>
		<li class="in"> <img class="avatar img-responsive" alt="" src="assets/img/avatar2.jpg" />
		<div class="message"> <a href="#" class="name">Lisa Wong</a> <span class="datetime">@ Jul 25, 2012 11:09</span> <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span> </div>
		</li>
		<li class="in"> <img class="avatar img-responsive" alt="" src="assets/img/avatar1.jpg" />
		<div class="message"> <a href="#" class="name">Ny Nilson</a> <span class="datetime">@ Jul 25, 2012 11:09</span> <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span> </div>
		</li>
		<li class="in"> <img class="avatar img-responsive" alt="" src="assets/img/avatar3.jpg" />
		<div class="message"> <a href="#" class="name">Richard Doe</a> <span class="datetime">@ Jul 25, 2012 11:09</span> <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span> </div>
		</li>
		<li class="in"> <img class="avatar img-responsive" alt="" src="assets/img/avatar3.jpg" />
		<div class="message"> <a href="#" class="name">Richard Doe</a> <span class="datetime">@ Jul 25, 2012 11:09</span> <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span> </div>
		</li>
		</ul>
		</div>
		</div>
		<div class="comment-form"> <img src="assets/img/avatar1.jpg" alt="" class="avatar img-responsive">
		<div class="input-cont">
		<textarea data-reactid="" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;"></textarea>
		<!--coder use JS detect height of text to fix size when input like FB--> 

		</div>
		</div>
		</div>
		</div>

		<!--like-->
		<div class="row">
		<div class="col-md-12 more-loked">
		<h3> People who liked this also liked:</h3>
		</div>
		<div class="col-md-6 col-sm-6">
		<div class="portlet box blue">
		<div class="portlet-title">
		<div class="caption"> <img src="assets/img/avatar1_small.jpg" alt="" class="avatar-user-l img-responsive">
		<div class="cap1"> <a class="username" href="#">Sugargirl</a><span class="user-locaion">Germany, Berlin</span> </div>
		</div>
		<div class="rank">
		<h2> #1 Rank </h2>
		<span class="arrow"> </span> </div>
		</div>
		<div class="portlet-body loked">
		<div class="main-img-user">
		<div id="myCarousel" class="carousel image-carousel slide view-first">
		<div class="carousel-inner ">
		<div class="active item loked"><a  href="#" > <img src="assets/img/gallery/album2/b1.jpg" class="img-responsive" alt=""></a> </div>
		</div>
		<!-- Carousel nav --> 

		</div>
		</div>
		<form>
		<div class="main-tag loked">
		<div class="tagcloud"> <a href="#">Gucci</a> <a href="#">Louis Vuitton</a> <a href="#l">Love</a> <a href="#">MC</a> <a href="#">Prada  Maksita</a> <a href="#">D&amp;G</a></div>
		</div>
		<div class="main-name"> <i class="icon-heart"></i> <a href="#">Kamasumi Benzo</a> <span>& 95 others like this</span> </div>
		<div class="comment-form"> <img src="assets/img/avatar1.jpg" alt="" class="avatar img-responsive">
		<div class="input-cont">
		<textarea data-reactid="" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;"></textarea>
		<!--coder use JS detect height of text to fix size when input like FB--> 

		</div>
		</div>
		</form>
		</div>
		</div>
		</div>
		<div class="col-md-6 col-sm-6">
		<div class="portlet box blue">
		<div class="portlet-title">
		<div class="caption"> <img src="assets/img/avatar1_small.jpg" alt="" class="avatar-user-l img-responsive">
		<div class="cap1"> <a class="username" href="#">Sugargirl</a><span class="user-locaion">Germany, Berlin</span> </div>
		</div>
		<div class="rank">
		<h2> #1 Rank </h2>
		<span class="arrow"> </span> </div>
		</div>
		<div class="portlet-body loked">
		<div class="main-img-user">
		<div id="myCarousel" class="carousel image-carousel slide view-first">
		<div class="carousel-inner ">
		<div class="active item loked"><a href="#"> <img src="assets/img/gallery/avanta.jpg" class="img-responsive" alt=""></a> </div>
		</div>
		<!-- Carousel nav --> 

		</div>
		</div>
		<form>
		<div class="main-tag loked">
		<div class="tagcloud"> <a href="#">Gucci</a> <a href="#">Louis Vuitton</a> <a href="#l">Love</a> <a href="#">MC</a> <a href="#">Prada  Maksita</a> <a href="#">D&amp;G</a></div>
		</div>
		<div class="main-name"> <i class="icon-heart"></i> <a href="#">Kamasumi Benzo</a> <span>& 95 others like this</span> </div>
		<div class="comment-form"> <img src="assets/img/avatar1.jpg" alt="" class="avatar img-responsive">
		<div class="input-cont">
		<textarea data-reactid="" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;"></textarea>
		<!--coder use JS detect height of text to fix size when input like FB--> 

		</div>
		</div>
		</form>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>      
     <!--end- Modals --> 
      
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

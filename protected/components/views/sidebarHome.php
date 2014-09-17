<div id="right-slide" class="page-sidebar navbar-collapse collapse">      
<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu">
	<li class="panel-tag">
		<div>
		<div class="panel">
		<div class="panel-title">
		<h3>Trending Hashtags</h3>
		</div>
		<div class="side-tag">
		<div class="tagcloud"> 
		<?php
		$array = $this->sidebar; //By SDL developer
		if(isset($array['data']['hash_tags']) && count($array['data']['hash_tags'])>0){
			$trend = $array['data']['hash_tags'];
			if(!empty($trend)){
			foreach($trend as $tagg)
			echo $tagg;
			}
		}
		?>
		</div>
		</div>
		</div>
		</div>
	</li>
<?php
if(Yii::app()->user->isGuest)
{ ?>
	<li class="panel-search blogslider">	
	<div class="panel">
	<div class="panel-title">
	<h3>Posly Blog</h3>
	</div>
	<div class="side-tag">	
	<!-- Flexi SLider Banner --->
		<div class="flex-container">
		<div class="flexslider">
			<ul class="slides">
			<li>
			<a href="<?php echo Yii::app()->createUrl('blog/index', array('id' => '1' )); ?>">
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/item_img10.jpg" />
			</a>
			<h5>Hike - Social Apps</h5>
			<div class="flexcontent">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
			</li>
			<li>
			<a href="<?php echo Yii::app()->createUrl('blog/index', array('id' => '1' )); ?>">
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/image3.jpg" />
			</a>
			<h5>Hike - Shoes</h5>
			<div class="flexcontent">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
			</li>
			<li>
			<a href="<?php echo Yii::app()->createUrl('blog/index', array('id' => '1' )); ?>">
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/image2.jpg" />
			</a>
			<h5>Max - Face Cream</h5>
			<div class="flexcontent">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
			</li>
			<li>
			<a href="<?php echo Yii::app()->createUrl('blog/index', array('id' => '1' )); ?>">
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/masculina7.jpg" />
			</a>
			<h5>Jospe - Living</h5>
			<div class="flexcontent">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
			</li>
			</ul>
		</div>
		</div>	
	</div>
	</div>	
	</li>	
<?php } else{?>
	<li class="panel-infor">
		<div>
		<div class="panel">
		<div class="panel-title solo"> </div>
		<div class="scrollercm" style="height: 175px;" data-always-visible="0" data-rail-visible1="0">	
		<ul class="notifi-panel">
			<!-- Site User's Activity Feeds(** Notifications **) will be append through JS function showUsersActivities() -->
			<br><div class="loader"></div>
		</ul>
		</div>
		</div>
		</div>
	</li>
	<li class="panel-status">
		<div>
		<div class="panel">
		<div class="panel-title solo"> </div>
		<div class="scrollercm" style="height: 210px;" data-always-visible="0" data-rail-visible1="0">
		<ul class="feeds-chat">
			<li>
			<div class="col1"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
			<div class="message"> <span class="name">Ny Nilson</span> </div>
			</div>
			<div class="col2">
			<div class="status offline"> 5h<i class="icon-mobile-phone"></i> </div>
			</div>
			</li>
			<li>
			<div class="col1"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
			<div class="message"> <span class="name">Komino Za</span> </div>
			</div>
			<div class="col2">
			<div class="status online"> Web<i class="icon-globe"></i> </div>
			</div>
			</li>
			<li>
			<div class="col1"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
			<div class="message"> <span class="name">Wasabi Kizoto</span> </div>
			</div>
			<div class="col2">
			<div class="status online"> Mobile<i class="icon-mobile-phone"></i> </div>
			</div>
			</li>
			<li>
			<div class="col1"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
			<div class="message"> <span class="name">Ny Nilson</span> </div>
			</div>
			<div class="col2">
			<div class="status offline"> 5h<i class="icon-mobile-phone"></i> </div>
			</div>
			</li>
			<li>
			<div class="col1"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
			<div class="message"> <span class="name">Ny Nilson</span> </div>
			</div>
			<div class="col2">
			<div class="status offline"> 5h<i class="icon-mobile-phone"></i> </div>
			</div>
			</li>
			<li>
			<div class="col1"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
			<div class="message"> <span class="name">Ny Nilson</span> </div>
			</div>
			<div class="col2">
			<div class="status offline"> 5h<i class="icon-mobile-phone"></i> </div>
			</div>
			</li>
			<li>
			<div class="col1"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
			<div class="message"> <span class="name">Ny Nilson</span> </div>
			</div>
			<div class="col2">
			<div class="status offline"> 5h<i class="icon-mobile-phone"></i> </div>
			</div>
			</li>
		</ul>
		</div>
		</div>
		</div>
	</li>
	<li class="panel-search">
		<div class="panel-search-form">
		<div class="input-cont"> <i class="icon-search"></i>
		<input class="form-control" type="text" placeholder="Search..."/>
		</div>
		<div class="btn-cont"> 
		<a href="dfsd" class="btn icn-only one"> <i class="icon-cog"></i> </a> 
		<a href="sdfs" class="btn icn-only two"> <i class="icon-edit"></i> </a> 
		</div>
		</div>
	</li>
<?php } ?>
</ul>
<!-- END SIDEBAR MENU -->      
</div>
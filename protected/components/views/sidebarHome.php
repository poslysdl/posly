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
	<li class="panel-infor">
	<div>
	<div class="panel">
	<div class="panel-title solo"> </div>
	<div class="scrollercm" style="height: 275px;" data-always-visible="0" data-rail-visible1="0">
	<ul class="notifi-panel">
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name">Chanh Ny</span> likes Chi Minh Anh's photo. </div>
		</li>
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name"> Son Vu Truong</span> signed a player on Top Eleven Be a Football Manager.</div>
		</li>
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name"> AnhTuan Tran</span> likes Tin nhanh cap nhat 24h's status. </div>
		</li>
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name"> Haik Nguyen</span> received a peer recognition on ViewBug.</div>
		</li>
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name">Thoi Trang Nhoc Chanh</span> and Vpcp Nguyen Minh Sang are now friends. </div>
		</li>
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name"> Mosota</span> and Vpcp Nguyen Minh Sang are now friends.</div>
		</li>
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name"> AnyAreA.</span> shared AnyArena.com's album: B.BRAVO. </div>
		</li>
		<li class="noti-area"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" />
		<div class="message"> <span class="name"> Kamizi</span> shared AnyArena.com's album: B.BRAVO. </div>
		</li>
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
	<div class="btn-cont"> <a href="dfsd" class="btn icn-only one"> <i class="icon-cog"></i> </a> <a href="sdfs" class="btn icn-only two"> <i class="icon-edit"></i> </a> </div>
	</div>
	</li>
	</ul>
    <!-- END SIDEBAR MENU --> 
      
 </div>
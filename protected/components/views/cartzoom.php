<?php  
	/*
		This Widget Creates an Modal Zoom Image of main cart image on click
	*/
	$p = $this->cartinfo['data'];
	$i = $this->cartinfo['i'];
	$avatar = '';
	$userPhotos = array();
	$fromurl=strstr($p->user->userDetails->user_details_avatar, '://', true);
	if($fromurl=='http' || $fromurl=='https')
		$avatar = $p->user->userDetails->user_details_avatar; 
	else
		$avatar = Yii::app()->baseUrl.'/profiles/'.$p->user->userDetails->user_details_avatar;
	
	if(isset($p->user->userLocation->user_location_country) && isset($p->user->userLocation->user_location_city))
		$location = $p->user->userLocation->user_location_country.', '.$p->user->userLocation->user_location_city;
	elseif(isset($p->user->userLocation->user_location_country))
		$location = $p->user->userLocation->user_location_country;
	else
		$location = '';
	$uid = Yii::app()->user->id; //logged in userId
	$firsttime=true;
	$firstId=0;
	$likescount=0;
	$userPhotos=Photos::model()->findAll("user_id=$p->user_id"); 
	$loggedIn_UserAvatar = '';
	if(!empty($uid))
	{
		$CommentAvatar=UsersDetails::model()->find("user_id=".$uid);
		if(isset($CommentAvatar)) {
		$fromurl=strstr($CommentAvatar['user_details_avatar'], '://', true);
		if($fromurl=='http' || $fromurl=='https')
			$loggedIn_UserAvatar = $CommentAvatar->user_details_avatar; 
		else
			$loggedIn_UserAvatar = Yii::app()->baseUrl.'/profiles/'.$CommentAvatar['user_details_avatar'];		
		}
	}
	$cartuser_firstname = $p->user->userDetails->user_details_firstname;
	$cartuser_lastname = $p->user->userDetails->user_details_lastname;
	$cartuser_url = $p->user->userDetails->user_unique_url;
	$cart_userId = $p->user_id;
?>
<!-- ** The image comes as Modal PopUp with large size when click on Cart image ** -->

<div id="zoomimage<?php echo $cart_userId;?>" class="czoomimage" style="display:none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
	</div>	
	<div class="modal-body">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><!--Avatar & name,country here ZOOM (A) -->		
				<img src="<?php echo $avatar;?>" alt="" class="avatar-user-l img-responsive">			
				<div class="cap1"> 
				<?php echo CHtml::link($cartuser_firstname.' '.$cartuser_lastname, array('profile/index', 'url'=>$cartuser_url), array('class'=>'username')); ?>					
				<span class="user-locaion"><?php echo $location;?></span> 
				</div>
				</div>
				<div class="rank">
				<div class="share-ranks"> 
					<a href="#" class="dropdown-toggle"  data-toggle="dropdown" data-close-others="true"><i class="icon-retweet"></i></a>
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
				<h2> #<?php echo $p->user->userDetails->user_rank_worldwide; ?> Rank </h2> <!-- Rank ZOOM (B) -->
				<span class="arrow"></span> 
			</div>
			</div>
		
			<div class="portlet-body">
				<div class="main-img-user">
				<div class="owl-carousel owl-carousel-chanhny3 view-first noscale">							
				<?php			
				foreach($userPhotos as $sp)
				{
					$firsttime=true;	
					$firstId = $sp->photos_id;						
					$photo_src = Yii::app()->baseUrl.'/files/'.$sp->user_id.'/medium/'.$sp->photos_name;
					$photo_id = $sp->photos_id;				
					if(!empty($uid))
					$dlike = LogPhotosHearts::model()->find("user_id=$uid and photos_id=$photo_id"); 				
					?>
					<div class="article-image" data-dot="<img class='img-responsive' src='<?php echo $photo_src;?>' photo_id='<?php echo $photo_id;?>' onclick='showZoomcartComments(this);'>" dphoto_id='<?php echo $photo_id;?>'> 
					<!-- ***** above div data-dot image to be shown in carousel**** --> 
					<a class="hover-zomm" href="#share-pic"  data-toggle="modal" >
					<img src="<?php echo $photo_src;?>" data-src="<?php echo $photo_src;?>" class="lazyOwl img-responsive img-zoom"  alt="">
					</a>				
					<div class="mask"> 
					<?php  
					if(Yii::app()->user->isGuest)
					{
					$printt="<i class='icon-heart-empty'></i>";
					echo CHtml::link($printt, array('#loginModal'), array('class'=>'like checkmsg', 'data-toggle'=>"modal"));
					}
					else
					{	//if logged in user Like this photo, show heart							
					if(isset($dlike))
						$heartc = 'icon-heart';
					else
						$heartc = 'icon-heart-empty';
					?>
					<a class="like" href='#' data-url="<?php echo Yii::app()->createUrl('likes/cincrease', array('id' => $sp->photos_id )); ?>">
					<i class="<?php echo $heartc ;?>">
					</i>
					</a>
					<?php 
					} 
					?>					
					</div>				
					</div>		
				<?php
				}
				?>
				</div> 
				</div>	
				
				<div class="panel-title">
				<h3>Tagged with</h3>
				</div>
				<div class="main-tag">
					<?php
					$firstId = '';
					$firstphoto = true; //to track first image in Cart
					foreach($userPhotos as $sp)
					{										
						$photo_id = $sp->photos_id;
						$firstId = $sp->photos_id;
						$phototags = PhotosHashtags::model()->with('hashtags')->findAll("photos_id=$firstId");
						$displayClass = ($firstphoto)?'display:block':'display:none';
					?>
					<div class="tagcloud" id="zoomtag<?php echo $photo_id;?>" style="<?php echo $displayClass;?>" > 
					<?php			
					if(isset($phototags)){
					foreach($phototags as $tag)
						echo CHtml::link($tag->hashtags->hashtags_name, array('site/hashtags', 'hid'=>$tag->hashtags->hashtags_id));
					}				
					?>				
					</div>
					<?php 
					$firstphoto = false;
					} 
					?>
				</div>
			</div>
		</div> <!-- portlet box blue Ends -->
		
		<div class="portlet box blue">
		<div class="portlet-body">
		<?php
		$firstphoto = true; //to track first image in Cart
		foreach($userPhotos as $sp)
		{
			$firstId = $sp->photos_id;
			$likescount = $sp->photos_hearts_count;		
			$photo_id = $sp->photos_id;
			$displayClass = ($firstphoto)?'display:block':'display:none';
			$com=LogPhotosComment::model()->with('user.userDetails')->findAll("photos_id=$firstId");			
			$total_comments = count($com);
			$lcount = $likescount;
			$likehtml = '';
			if(!empty($uid))
				$likehtml = LogPhotosHearts::model()->createLikeCountHtml($photo_id,$likescount);
			
		?>
		<div class="zoomdivcomments" id="zoomcart-data<?php echo $firstId; ?>" style="<?php echo $displayClass;?>">		
			<div class="main-name">
			<?php
			if(Yii::app()->user->isGuest)
			{	//User Not Logged In
				$likess = ($likescount==0)?'0 Likes':$lcount.' people like this';
			?>
				<i class="icon-heart"></i> <span><?php echo $likess; ?></span>
			<?php 
			} 
			else{
				//if User Logged In, show Likes with name
				echo $likehtml;	//** You & 7 others like it
			} ?>
			</div>			
			<div class="main-comment" >
			<div class="scrollercm" style="height: 220px;" data-always-visible="1" data-rail-visible1="1">
				<ul class="CMn" id="zoomcart-data-comments<?php echo $firstId; ?>">
				<?php // List of Comments
					$commentsArray = array();
					if(isset($com))
					{					
						foreach($com as $c)
						{	//get all comments related to this pic into commentsArray.. 
							$fromurl=strstr($c->user->userDetails->user_details_avatar, '://', true);
							if($fromurl=='http' || $fromurl=='https')
								$useravatar = $c->user->userDetails->user_details_avatar; 
							else
								$useravatar = Yii::app()->baseUrl.'/profiles/'.$c->user->userDetails->user_details_avatar;
							$uname = $c->user->userDetails->user_details_firstname.' '.$c->user->userDetails->user_details_lastname;
							$commentDate = $this->get_time_ago($c->log_photos_comment_date); //Comment Date
							$commentDesc = $c->log_photos_comment_description;
							$commentsArray[] = array('useravatar'=>$useravatar,'uname'=>$uname,
							'commentDate'=>$commentDate,'commentDesc'=>$commentDesc);
						}
					}
					if(count($commentsArray)>0){
					$cnt = count($commentsArray);
					for($i=0;$i<$cnt-1;$i++){
					?>    
						<li class="in"> 
						<img class="avatar img-responsive" alt="" src="<?php echo $commentsArray[$i]['useravatar'];?>" />					
						<div class="message"> <a href="#" class="name"><?php echo $commentsArray[$i]['uname'];?></a> 
						<span class="datetime">@ <?php echo $commentsArray[$i]['commentDate'];?></span> 
						<span class="body"> <?php echo $commentsArray[$i]['commentDesc']; ?> </span> 
						</div>					
						</li>
					<?php 
					}
					}					
					?>
				</ul>
			</div>
			</div>			
			<div class="comment-form"> 
			<?php if(!empty($uid)){
				//** Comment Box, write your comments here, if user is Logged In
			?>
				<img src="assets/img/avatar1.jpg" alt="" class="avatar img-responsive">
				<div class="input-cont">
					<textarea data-reactid="" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;"></textarea>
				<!--coder use JS detect height of text to fix size when input like FB--> 
				</div>
			<?php } ?>
			</div>
		</div>		
		<?php 
		$firstphoto = false;
		}
		?>
		</div>
		</div>

	
		<!--Also like This-->
		<div class="row">
		<div class="col-md-12 more-loked">
		<h3> People who liked this also liked:</h3>
		</div>
		
		<div class="col-md-6 col-sm-6">
			<!--<div class="portlet box blue">
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

			<!--</div>
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

			<!--</div>
			</div>
			</form>
			</div>
			</div> -->
		</div>
		<div class="col-md-6 col-sm-6">
			<!--<div class="portlet box blue">
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

			<!--</div>
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

			<!--</div>
			</div>
			</form>
			</div>
			</div> -->
		</div>
		</div><!-- row ENDS -->
		
	</div> <!-- modal-body ENDS -->
</div> <!-- share-pic Ends--> 
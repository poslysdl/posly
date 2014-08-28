<?php  
	/*
		This Widget Creates an Single Cart container with main ,Carousel Images,
		comments, likes and Hearts...
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
<div class="portlet box blue boxshadown bRd">
	<div class="portlet-title">
	<div class="caption"> 
		<img src="<?php echo $avatar;?>" alt="" class="avatar-user-l img-responsive">
		<div class="cap1"> 
		<a class="username" href="#">
		<?php echo CHtml::link($cartuser_firstname.' '.$cartuser_lastname, array('profile/index', 'url'=>$cartuser_url), array('class'=>'username')); ?>
		</a>
		<span class="user-locaion"><?php echo $location;?></span> 
		</div>
	</div>
	<div class="rank">
		<div class="share-on"> 
			<a href="#" class="dropdown-toggle"  data-toggle="dropdown" data-close-others="true"><i class="icon-retweet"></i></a>
			<div class="dropdown-menu share-pic">
			<div><span>Share now on</span></div>
			<div>
			<button type="button" class="btn faceS" >Facebook</button>
			</div>
			<div>
			<button type="button" class="btn twistS" >Twitter</button>
			</div>
			<div>
			<button type="button" class="btn vkS" >VK</button>
			</div>
			<div>
			<button type="button" class="btn pinter" >Pinterest</button>
			</div>
			<div>
			<button type="button" class="btn insta" >Instagram</button>
			</div>
			<div>
			<button type="button" class="btn googlep" >Google +</button>
			</div>
			<div>
			<button type="button" class="btn meoS" data-toggle="modal" href="#sign-up">Email</button>
			</div>
			<div class="endles text"> <span><a href="#">Mark as spam</a></span> </div>
			</div>
		</div>
	<h2> #<?php echo $p->user->userDetails->user_rank_worldwide; ?> Rank </h2>
	<span class="arrow"> </span> 
	</div>
	</div>
	
	<div class="portlet-body">
		<div class="main-img-user">			
			<div class="owl-carousel owl-carousel-chanhny4 view-first noscale">
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
				<div class="article-image" data-dot="<img class='img-responsive' src='<?php echo $photo_src;?>' photo_id='<?php echo $photo_id;?>' onclick='showcartComments(this);'>"> 
				<!-- ***** above div data-dot image to be shown in carousel**** --> 
				<a class="hover-zomm" href="#share-pic"  data-toggle="modal" >
				<img src="<?php echo $photo_src;?>" data-src="<?php echo $photo_src;?>" class="lazyOwl img-responsive img-zoom"  alt="" data-userid="<?php echo $cart_userId;?>"  dphoto_id='<?php echo $photo_id;?>' >
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
		<?php
		$firstphoto = true; //to track first image in Cart
		foreach($userPhotos as $sp)
		{
			$firstId = $sp->photos_id;
			$likescount = $sp->photos_hearts_count;		
			$photo_id = $sp->photos_id;
			$displayClass = ($firstphoto)?'display:block':'display:none';
			$com=LogPhotosComment::model()->with('user.userDetails')->findAll("photos_id=$firstId");
			$phototags = PhotosHashtags::model()->with('hashtags')->findAll("photos_id=$firstId");
			$total_comments = count($com);
			$lcount = $likescount;
			$likehtml = '';
			if(!empty($uid))
				$likehtml = LogPhotosHearts::model()->createLikeCountHtml($photo_id,$likescount);
			
		?>
		<!--divcomments contains,total likes, comments,comment Post etc -->
		<div class="divcomments" id="cart-data<?php echo $firstId; ?>" style="<?php echo $displayClass;?>">
			<div class="main-tag">
				<div class="tagcloud" phid="<?php echo $firstId; ?>"> 
				<?php			
				if(isset($phototags)){
				foreach($phototags as $tag)
				echo CHtml::link($tag->hashtags->hashtags_name, array('site/hashtags', 'hid'=>$tag->hashtags->hashtags_id));
				}
				?>
				</div>
			</div>
			
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
			
			<div class="CMc">			
				<div class="main-commnet" id="cart-data-topcomments<?php echo $firstId; ?>">
					<div class="tools">
					<a href="javascript(void);" class="collapseed" data-src="<?php echo $total_comments;?>">
					<?php echo $total_comments;?> comments </a> <!--app.js Handle this --->
					</div>
					<div class="oCM">
					<div class="sort"> <a href="javascript(void);" class="dropdown-toggle" data-toggle="dropdown">Top comment</a>
					<ul class="dropdown-menu" role="menu" >
					<li> <a class="slect" href="#">Top comment </a> </li>
					<li> <a href="#">Recent activity</a> </li>
					</ul>
					</div>
					</div>
				</div>
				<div class="main-comment display-hide">
					<div class="scrollercm" style="height: 300px;" data-always-visible="1" data-rail-visible1="0">
					<ul class="CMn" id="cart-data-comments<?php echo $firstId; ?>">
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
					$cnt = 0;
					if(isset($commentsArray) && count($commentsArray)>0){	
					$cnt = count($commentsArray);
					if($cnt>1)
					{
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
					}					
					?>					
					</ul>
					</div>
				</div>
				<div class="main-comment2"> <!--Main Comments -->
					<div>
					<?php if(isset($cnt) && $cnt>1){  ?>
					<ul class="CMn" id="cart-data-maincomments<?php echo $firstId; ?>">
					<li class="in"> 
					<img class="avatar img-responsive" alt="" src="<?php echo $commentsArray[$cnt-1]['useravatar']; ?>" />
					<div class="message"> 
					<a href="#" class="name"><?php echo $commentsArray[$cnt-1]['uname']; ?></a> 
					<span class="datetime">@ <?php echo $commentsArray[$cnt-1]['commentDate']; ?></span> 
					<span class="body"> <?php echo $commentsArray[$cnt-1]['commentDesc']; ?></span> 
					</div>
					</li>
					</ul>
					<?php } ?>
					</div>
				</div>
				<form>
				<div class="comment-form"> 
					<?php if(!empty($uid)){ 
					//** Comment Box, write your comments here, if user is Logged In
					?>
					<img src="<?php echo $loggedIn_UserAvatar;?>" alt="" class="avatar img-responsive">
					<div class="input-cont">					
					<textarea data-reactid="" class="custom-comment-box" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;" photo_id="<?php echo $firstId; ?>" data-url="<?php echo Yii::app()->createUrl('comments/addcomment'); ?>" data-profileurl="<?php echo Yii::app()->baseUrl.'/profiles/'; ?>" data-zoomimg="0"></textarea>					
					<!--coder use JS detect height of text to fix size when input like FB--> 					
					</div>
					<?php } ?>
				</div>
				</form>
			</div> <!-- CMc Ends -->
		</div>
		<?php 
		$firstphoto = false;
		} 
		?>
				
	</div> <!--portlet-body Ends -->
</div> <!-- portlet box blue ENDS ---> 
<?php 
if(!empty($photos))
{
?>
	<div class="col-md-12 more-loked">
	<h3> People who liked this also liked:</h3>
	</div>
<?php
$i=1;
$loggedIn_UserAvatar = '';
$uid = Yii::app()->user->id; //logged in userId
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
foreach($photos as $p)
{
	$avatar = '';	
	$fromurl=strstr($p->userDetails->user_details_avatar, '://', true);
	if($fromurl=='http' || $fromurl=='https')
		$avatar = $p->userDetails->user_details_avatar; 
	else
		$avatar = Yii::app()->baseUrl.'/profiles/'.$p->userDetails->user_details_avatar;
	if(isset($p->userLocation->user_location_country) && isset($p->userLocation->user_location_city))
		$location = $p->userLocation->user_location_country.', '.$p->userLocation->user_location_city;
	elseif(isset($p->userLocation->user_location_country))
		$location = $p->userLocation->user_location_country;
	else
		$location = '';
	$cartuser_firstname = $p->userDetails->user_details_firstname;
	$cartuser_lastname = $p->userDetails->user_details_lastname;
	$cartuser_url = $p->userDetails->user_unique_url;
	$cart_userId = $p->user_id;
	foreach($p->photos as $newp)
	{
		$photoId=$newp->photos_id;
		$firstId = $newp->photos_id;
		$likescount = $newp->photos_hearts_count;		
		$imgsrc = Yii::app()->baseUrl.'/files/'.$p->user_id.'/medium/'.$newp->photos_name;
		$lcount = $likescount;
	}	
	if(!empty($uid))
		$likehtml = LogPhotosHearts::model()->createLikeCountHtml($photoId,$likescount); 
		
if($i%2!=0)
{	
?>
	<div class="col-md-6 col-sm-6">
		<div class="portlet box blue">
		<div class="portlet-title">
		<div class="caption"> <img src="<?php echo $avatar;?>" alt="" class="avatar-user-l img-responsive">
		<div class="cap1"> 
		<?php echo CHtml::link($cartuser_firstname.' '.$cartuser_lastname, 
		array('profile/index', 'url'=>$cartuser_url), array('class'=>'username')); ?>		
		<span class="user-locaion"><?php echo $location;?></span> 
		</div>
		</div>
		<div class="rank">
		<h2> #<?php echo $p->userDetails->user_rank_worldwide; ?> Rank </h2>
		<span class="arrow"> </span> </div>
		</div>
		<div class="portlet-body loked">
		<div class="main-img-user">
		<div id="myCarousel" class="carousel image-carousel slide view-first">
		<div class="carousel-inner ">
		<div class="active item loked">		
		<a href="#" style="cursor: default;"> 
		<img src="<?php echo $imgsrc;?>" class="img-responsive" alt="<?php echo $newp->photos_name; ?>">
		</a>		
		</div>
		</div>
		<!-- Carousel nav --> 
		</div>
		</div>		
		<div class="zoomdivcomments" id="zoomcart-data<?php echo $firstId; ?>">
			<form>
			<div class="main-tag loked">
			<div class="tagcloud"> 
			<?php 
			$t= PhotosHashtags::model()->with('hashtags')->findAll("photos_id=$photoId");
			if(isset($t))
			foreach($t as $tag)
			echo CHtml::link($tag->hashtags->hashtags_name, array('site/hashtags', 'hid'=>$tag->hashtags->hashtags_id));
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
			
			<div class="comment-form"> 
			<?php if(!empty($uid)){
				//** Comment Box, write your comments here, if user is Logged In
			?>
				<img src="<?php echo $loggedIn_UserAvatar;?>" alt="" class="avatar img-responsive">
				<div class="input-cont">					
				<textarea data-reactid="" class="custom-comment-box" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;" photo_id="<?php echo $firstId; ?>" data-url="<?php echo Yii::app()->createUrl('comments/addcomment'); ?>" data-profileurl="<?php echo Yii::app()->baseUrl.'/profiles/'; ?>" data-zoomimg="1"></textarea>					
					<!--coder use JS detect height of text to fix size when input like FB--> 		
				</div>
			<?php } ?>
			</div>		
			</form>
		</div>		
		</div>
		</div>
	</div>
<?php
} 
else{
?>
	<div class="col-md-6 col-sm-6">
		<div class="portlet box blue">
		<div class="portlet-title">
		<div class="caption"> <img src="<?php echo $avatar;?>" alt="" class="avatar-user-l img-responsive">
		<div class="cap1"> 
		<?php echo CHtml::link($cartuser_firstname.' '.$cartuser_lastname, 
		array('profile/index', 'url'=>$cartuser_url), array('class'=>'username')); ?>		
		<span class="user-locaion"><?php echo $location;?></span> 
		</div>
		</div>
		<div class="rank">
		<h2> #<?php echo $p->userDetails->user_rank_worldwide; ?> Rank </h2>
		<span class="arrow"> </span> </div>
		</div>
		<div class="portlet-body loked">
		<div class="main-img-user">
		<div id="myCarousel" class="carousel image-carousel slide view-first">
		<div class="carousel-inner ">
		<div class="active item loked">		
		<a href="#" style="cursor: default;"> 
		<img src="<?php echo $imgsrc;?>" class="img-responsive" alt="<?php echo $newp->photos_name; ?>">
		</a>		
		</div>
		</div>
		<!-- Carousel nav --> 
		</div>
		</div>		
		<div class="zoomdivcomments" id="zoomcart-data<?php echo $firstId; ?>">
			<form>
			<div class="main-tag loked">
			<div class="tagcloud"> 
			<?php 
			$t= PhotosHashtags::model()->with('hashtags')->findAll("photos_id=$photoId");
			if(isset($t))
			foreach($t as $tag)
			echo CHtml::link($tag->hashtags->hashtags_name, array('site/hashtags', 'hid'=>$tag->hashtags->hashtags_id));
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
			
			<div class="comment-form"> 
			<?php if(!empty($uid)){
				//** Comment Box, write your comments here, if user is Logged In
			?>
				<img src="<?php echo $loggedIn_UserAvatar;?>" alt="" class="avatar img-responsive">
				<div class="input-cont">					
				<textarea data-reactid="" class="custom-comment-box" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;" photo_id="<?php echo $firstId; ?>" data-url="<?php echo Yii::app()->createUrl('comments/addcomment'); ?>" data-profileurl="<?php echo Yii::app()->baseUrl.'/profiles/'; ?>" data-zoomimg="1"></textarea>					
					<!--coder use JS detect height of text to fix size when input like FB--> 		
				</div>
			<?php } ?>
			</div>		
			</form>
		</div>		
		</div>
		</div>
	</div>
<?php
}
$i++;
}
}
?>     
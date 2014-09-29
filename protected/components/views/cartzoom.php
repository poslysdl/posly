<?php  
/* This Widget Creates an Modal Zoom Image of main cart image on click
* used in Catwalk,Posly,goingViral,Topmembers...
* Last Modified: 23-Sep-14
*/
$p = $this->cartinfo['data'];
$i = $this->cartinfo['i'];
$pageflag = $this->cartinfo['pageflag'];
$pageflagid = $this->cartinfo['pageflagid'];
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
//***fetch Card Photos of respective user..and Slot 1,2,3 only
$criteria=new CDbCriteria;
if($pageflag=='newsfeed' && $p->user->userDetails->user_details_firstname!="posly"){
	$criteria->condition = "t.user_id='$p->user_id' AND t.photos_share_count<>0";
} 
elseif($pageflag=='hashtag' && count($pageflagid)>0){
	$criteria->condition = "t.user_id='$p->user_id'";
	$criteria->addInCondition('t.photos_id',$pageflagid);
} 
else{
	$criteria->condition = "t.user_id='$p->user_id' AND t.photos_slotno<>0";
}
$criteria->order = 't.photos_slotno';
$userPhotos=Photos::model()->findAll($criteria);
unset($criteria);
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
$likeConPath= urlencode(Yii::app()->createUrl("/comments/commentlike"));
$shareConPath= urlencode(Yii::app()->createUrl("/photo/sharepicposly"));
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
				<a href="<?php echo Yii::app()->createUrl('profile/index', array('url' => $cartuser_url )); ?>">
				<img src="<?php echo $avatar;?>" alt="" class="avatar-user-l img-responsive">
				</a>						
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
					<!--<li>
					<button type="button" class="btn twistS" >Twitter</button>
					</li>
					<li>
					<button type="button" class="btn vkS" >VK</button>
					</li>
					<li>
					<button type="button" class="btn pinter" >Pinterest</button>
					</li>-->
					<li>
					<button type="button" class="btn insta" >Instagram</button>
					</li>
					<!--<li>
					<button type="button" class="btn googlep" >Google +</button>
					</li>-->
					<li class="endles">
					<button type="button" class="btn meoS shareposly" data-id="24" data-url="<?php echo $shareConPath;?>" data-toggle="modal" href="#sign-up">Email</button>
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
					<div class="article-image" data-dot="<img class='img-responsive' src='<?php echo $photo_src;?>' photo_id='<?php echo $photo_id;?>' onclick='showZoomcartComments(this);' id='zoomowl<?php echo $photo_id;?>' >" dphoto_id='<?php echo $photo_id;?>' > 
					<!-- ***** above div data-dot image to be shown in carousel**** --> 
					<a class="hover-zomm" href="#share-pic"  data-toggle="modal" >
					<img src="<?php echo $photo_src;?>" data-src="<?php echo $photo_src;?>" class="lazyOwl img-responsive img-zoom" alt="">
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
			$commentYouLike = array();
			$firstId = $sp->photos_id;
			$likescount = $sp->photos_hearts_count;		
			$photo_id = $sp->photos_id;
			$displayClass = ($firstphoto)?'display:block':'display:none';
			$com=LogPhotosComment::model()->with('user.userDetails')->findAll("photos_id=$firstId");			
			$total_comments = count($com);
			$lcount = $likescount;
			$likehtml = '';
			if(!empty($uid)){
				$likehtml = LogPhotosHearts::model()->createLikeCountHtml($photo_id,$likescount);
				$commentYouLike = LogPhotosComment::model()->commentsYouLike($uid,$photo_id);
			}
			
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
							$commentDate = $this->get_commenttime($c->log_photos_comment_date); //Comment Date
							$commentDesc = $c->log_photos_comment_description;
							$commentsArray[] = array('useravatar'=>$useravatar,'uname'=>$uname,'id'=>$c->log_photos_comment_id,
							'commentDate'=>$commentDate,'commentDesc'=>$commentDesc,'commentcount'=> $c->likecount);
						}
					}
					if(count($commentsArray)>0){
					$cnt = count($commentsArray);
					for($i=0;$i<$cnt;$i++){
					$comment_id = $commentsArray[$i]['id'];
					$cdate = $commentsArray[$i]['commentDate'];
					$commentcnt =($commentsArray[$i]['commentcount']==0)?'':$commentsArray[$i]['commentcount'];				
					if(array_search($comment_id,$commentYouLike)===false)
						$like='Like';
					else
						$like='UnLike'; //already Like the comment
					$commentbyname = $commentsArray[$i]['uname'];
					$commentbyavatar = $commentsArray[$i]['useravatar'];
					$commentdesc = $commentsArray[$i]['commentDesc'];
					?>    
						<li class="in"> 
						<img class="avatar img-responsive" alt="" src="<?php echo $commentbyavatar;?>" />					
						<div class="message"> 
						<a href="#" class="name"><?php echo $commentbyname;?></a> 							
						<span class="body"> <?php echo $commentdesc; ?> </span>							
						<span class="likebox">
						<span class="datetime"><?php echo $cdate;?></span>
						<?php if(!empty($uid)){ ?>
						<span class="like">
						<a class="commentlike" data-id="<?php echo $comment_id;?>" data-url="<?php echo $likeConPath;?>"><?php echo $like;?></a>
						</span>
						<?php } ?>						
						<i class="icon-heart" style="color:#f30a7f;margin-right:0px;"></i>
						<span class="lcnt"><?php echo $commentcnt; ?></span>
						<span>							
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
				<img src="<?php echo $loggedIn_UserAvatar;?>" alt="" class="avatar img-responsive">
				<div class="input-cont">					
					<textarea data-reactid="" class="custom-comment-box" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;" photo_id="<?php echo $firstId; ?>" data-url="<?php echo Yii::app()->createUrl('comments/addcomment'); ?>" data-profileurl="<?php echo Yii::app()->baseUrl.'/profiles/'; ?>" data-zoomimg="1"></textarea>					
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
	
		<!--People Who Like This, Also like This-->		
		<div class="row" data-src="<?php echo Yii::app()->createUrl('/photo/wholiked'); ?>">
			
		</div><!-- row ENDS -->
		
	</div> <!-- modal-body ENDS -->
</div> <!-- share-pic Ends--> 
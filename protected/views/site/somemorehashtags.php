  <?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
 
<?php 
/*echo Yii::app()->user->isGuest;
echo Yii::app()->user->name;*/
function get_time_ago($time_stamp)
{
    $time_difference = strtotime('now') - $time_stamp;

    if ($time_difference >= 60 * 60 * 24 * 365.242199)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
         * This means that the time difference is 1 year or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
         * This means that the time difference is 1 month or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 7)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
         * This means that the time difference is 1 week or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');
    }
    elseif ($time_difference >= 60 * 60 * 24)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day
         * This means that the time difference is 1 day or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');
    }
    elseif ($time_difference >= 60 * 60)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour
         * This means that the time difference is 1 hour or more
         */
        return get_time_ago_string($time_stamp, 60 * 60, 'hour');
    }
    else
    {
        /*
         * 60 seconds/minute
         * This means that the time difference is a matter of minutes
         */
        return get_time_ago_string($time_stamp, 60, 'minute');
    }
}

function get_time_ago_string($time_stamp, $divisor, $time_unit)
{
    $time_difference = strtotime("now") - $time_stamp;
    $time_units      = floor($time_difference / $divisor);

    settype($time_units, 'string');

    if ($time_units === '0')
    {
        return 'less than 1 ' . $time_unit . ' ago';
    }
    elseif ($time_units === '1')
    {
        return '1 ' . $time_unit . ' ago';
    }
    else
    {
        /*
         * More than "1" $time_unit. This is the "plural" message.
         */
        // TODO: This pluralizes the time unit, which is done by adding "s" at the end; this will not work for i18n!
        return $time_units . ' ' . $time_unit . 's ago';
    }
}

?>
<div id="leftside">
           <?php
           $k=$_GET['l']+1;
  if(isset($photos))
  {
  	$i=1;
  	foreach($photos as $p)
  	{
  		if($alltags->photos)
			if($i%2!=0)
			{
			?>
			         <div class="portlet box blue boxshadown">
            <div class="portlet-title">
              <div class="caption"> <img src="<?php
                      		$fromurl=strstr($p->photos->user->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $p->photos->user->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$p->photos->user->userDetails->user_details_avatar; ?>" alt="" class="avatar-user-l img-responsive">
                <div class="cap1"><?php echo CHtml::link($p->photos->user->userDetails->user_details_firstname.' '.$p->photos->user->userDetails->user_details_lastname, array('profile/index', 'url'=>$p->photos->user->userDetails->user_unique_url), array('class'=>'username')); ?><span class="user-locaion"><?php if(isset($p->photos->user->userLocation->user_location_country) && isset($p->photos->user->userLocation->user_location_city))
                 echo $p->photos->user->userLocation->user_location_country.', '.$p->photos->user->userLocation->user_location_city;
                 elseif(isset($p->photos->user->userLocation->user_location_country))
                 echo $p->photos->user->userLocation->user_location_country; ?></span> </div>
              </div>
              <div class="rank">
                <h2> #<?php echo $p->photos->user->userDetails->user_rank_worldwide; ?> Rank </h2>
                <span class="arrow"> </span> </div>
            </div>
            <div class="portlet-body">
              <div class="main-img-user">
              <div id="myCarousel<?php echo $k; ?>" class="carousel image-carousel slide view-first">
                  <div class="carousel-inner ">
                  
                  <?php
                  $firsttime=true;
                  $firstId=0;
                  $likescount=0;
                  $id=$p->photos->user->user_id;
                  $userPhotos=Photos::model()->findAll("user_id=$id");
                  foreach($userPhotos as $sp)
                  {
                  	if($firsttime)
                  	{
                  		$firstId=$sp->photos_id;
                  		$likescount=$sp->photos_hearts_count;
                  	?>
                  	<div class="active item"><a class="hover-zomm" href="#share-pic"  data-toggle="modal" > <img onclick="change_image(this,$(this).attr('dphoto_id'))" src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $sp->user_id; ?>/medium/<?php echo $sp->photos_name; ?>" class="img-responsive img-zoom" alt="<?php echo $sp->photos_name; ?>" dphoto_id="<?php echo $sp->photos_id; ?>"></a>
                      <div class="mask">
                      
                      <?php  
                      if(Yii::app()->user->isGuest)
                      {
					  	$printt="<i class='icon-heart-empty'></i>";
					  	 echo CHtml::link($printt, array('#loginModal'), array('class'=>'like checkmsg', 'data-toggle'=>"modal"));
					  }
						else
						{
							?>
                      
                      <a class="like" href='#' data-url="<?php echo Yii::app()->createUrl('likes/cincrease', array('id' => $sp->photos_id )); ?>"><i class="
                      <?php
                      $uid=Yii::app()->user->id;
                      $dlike=LogPhotosHearts::model()->find("user_id=$uid and photos_id=$sp->photos_id");
                      if(isset($dlike))
                      echo 'icon-heart';
                      else
                      echo 'icon-heart-empty';
                      ?>"></i></a>
                      <?php } ?>
                      	
                      </div>
                    </div>
                    <?php $firsttime=false;
                     }
                    else
                    {
						?>
                    <div class="item"><a class="hover-zomm" href="#share-pic"  data-toggle="modal" > <img  onclick="change_image(this,$(this).attr('dphoto_id'))" src="" class="img-responsive img-zoom" alt="<?php echo $sp->photos_name; ?>" dphoto_id="<?php echo $sp->photos_id; ?>"></a>
                     <div class="mask">
                      
                      <?php  
                      if(Yii::app()->user->isGuest)
                      {
					  	$printt="<i class='icon-heart-empty'></i>";
					  echo CHtml::link($printt, array('#loginModal'), array('class'=>'like checkmsg', 'data-toggle'=>"modal"));
					  }
						else
						{
							?>
                      
                      <a class="like" href='#' data-url="<?php echo Yii::app()->createUrl('likes/cincrease', array('id' => $sp->photos_id )); ?>"><i class="
                      <?php
                      $uid=Yii::app()->user->id;
                      $dlike=LogPhotosHearts::model()->find("user_id=$uid and photos_id=$sp->photos_id");
                      if(isset($dlike))
                      echo 'icon-heart';
                      else
                      echo 'icon-heart-empty';
                      ?>"></i></a>
                      <?php } ?>
                      	
                      </div>
                    </div>
                  <?php  } 
                  } ?>
                  
                  </div>
                  <!-- Carousel nav -->
                  
                  <div class="carousel-indicators">
                 <ol class="bxslider">

                  <?php
                  $slidernum=0;
                  $firsttime=true;
                  foreach($userPhotos as $sp)
                  {
                  	if($firsttime)
                  	{

				?>
				                  <li data-target="#myCarousel<?php echo $k; ?>" data-slide-to="0" class="active"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $sp->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"></li>
				                  <?php 
				                  $firsttime=false; 
				                  }
				                  else
				                  {
								  	?>
                 <li data-target="#myCarousel<?php echo $k; ?>" data-slide-to="<?php echo $slidernum; ?>"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $sp->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"> </li>
                 <?php
                 }
                 $slidernum++;
                 } ?>
                  </ol>
                  </div>
                </div>
              </div>
              <form>
                <div class="main-tag">
                  <div class="tagcloud" phid="<?php echo $firstId; ?>"> 
                  <?php 
                  	$t= PhotosHashtags::model()->with('hashtags')->findAll("photos_id=$firstId");
                  if(isset($t))
                  foreach($t as $tag)
                  echo CHtml::link($tag->hashtags->hashtags_name, array('site/hashtags', 'hid'=>$tag->hashtags->hashtags_id));
                  ?>
                  </div>
                </div>
                <div class="main-name"> <i class="icon-heart"></i> <a href="#"></a> <span lphid="<?php echo $firstId; ?>"><?php echo $likescount; ?> liked this</span> </div>
                <div class="main-comment"  photo_id=<?php echo $firstId; ?>">
                 <div class="scrollercm" style="height: auto;  max-height: 225px;" data-always-visible="1" data-rail-visible1="1">
                    <ul class="chats" id="<?php  echo $firstId; ?>">
                    <?php
                    $com=LogPhotosComment::model()->with('user.userDetails')->findAll("photos_id=$firstId");
                if(isset($com))
                foreach($com as $c)
                {                    
                   ?>
                   <li class="in"> <img class="avatar img-responsive" alt="" src="<?php  
                      		$fromurl=strstr($c->user->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $c->user->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$c->user->userDetails->user_details_avatar; ?>" />
                        <div class="message"> <a href="#" class="name"><?php echo $c->user->userDetails->user_details_firstname.' '.$c->user->userDetails->user_details_lastname; ?></a> 
                        <span class="datetime">@ <?php 
                        	echo get_time_ago($c->log_photos_comment_date);
                        	
                        ?></span> 
                        <span class="body"><?php echo $c->log_photos_comment_description; ?></span> </div>
                      </li>
                   
                    <?php
                    }
                    ?>
                    </ul>
                    </div>
                </div>
                <div class="comment-form"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1.jpg" alt="" class="avatar img-responsive">
                <?php /* if(Yii::app()->user->isGuest)
                {
					?> <div class="avatar img-responsive"></div> <?php
				}
				else
				{
					?> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1.jpg" alt="" class="avatar img-responsive"> <?php
				} */
                ?>
                  <div class="input-cont">
                    <textarea data-reactid="" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;"  photo_id="<?php echo $firstId; ?>" class="custom-comment-box"></textarea>
                    <!--coder use JS detect height of text to fix size when input like FB--> 
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
          <?php
          		
          	}
          	$i++;
          	$k+=2;
	}
  } ?>
 </div>
 <div id="rightside">
          <?php
          $k=$_GET['l']+2;
  if(isset($photos))
  {
  	$i=1;
  	foreach($photos as $p)
  	{
			if($alltags->photos)
			if($i%2==0)
			{
			?>
          <div class="portlet box blue boxshadown">
            <div class="portlet-title">
              <div class="caption"> <img src="<?php
                      		$fromurl=strstr($p->photos->user->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $p->photos->user->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$p->photos->user->userDetails->user_details_avatar; ?>" alt="" class="avatar-user-l img-responsive">
                <div class="cap1"><?php echo CHtml::link($p->photos->user->userDetails->user_details_firstname.' '.$p->photos->user->userDetails->user_details_lastname, array('profile/index', 'url'=>$p->photos->user->userDetails->user_unique_url), array('class'=>'username')); ?><span class="user-locaion"><?php if(isset($p->photos->user->userLocation->user_location_country) && isset($p->photos->user->userLocation->user_location_city))
                 echo $p->photos->user->userLocation->user_location_country.', '.$p->photos->user->userLocation->user_location_city;
                 elseif(isset($p->photos->user->userLocation->user_location_country))
                 echo $p->photos->user->userLocation->user_location_country; ?></span> </div>
              </div>
              <div class="rank">
                <h2> #<?php echo $p->photos->user->userDetails->user_rank_worldwide; ?> Rank </h2>
                <span class="arrow"> </span> </div>
            </div>
            <div class="portlet-body">
              <div class="main-img-user">
               <div id="myCarousel<?php echo $k; ?>" class="carousel image-carousel slide view-first">
                  <div class="carousel-inner ">
                  
                  <?php
                  $firsttime=true;
                  $firstId=0;
                  $likescount=0;
                  $id=$p->photos->user->user_id;
                  $userPhotos=Photos::model()->findAll("user_id=$id");
                  foreach($userPhotos as $sp)
                  {
                  	if($firsttime)
                  	{
                  		$firstId=$sp->photos_id;
                  		$likescount=$sp->photos_hearts_count;
                  	?>
                  	<div class="active item"><a class="hover-zomm" href="#share-pic"  data-toggle="modal" > <img onclick="change_image(this,$(this).attr('dphoto_id'))" src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $sp->user_id; ?>/medium/<?php echo $sp->photos_name; ?>" class="img-responsive img-zoom" alt="<?php echo $sp->photos_name; ?>" dphoto_id="<?php echo $sp->photos_id; ?>"></a>
                      <div class="mask">
                      
                      <?php  
                      if(Yii::app()->user->isGuest)
                      {
					  	$printt="<i class='icon-heart-empty'></i>";
					  echo CHtml::link($printt, array('#loginModal'), array('class'=>'like checkmsg', 'data-toggle'=>"modal"));
					  }
						else
						{
							?>
                      
                      <a class="like" href='#' data-url="<?php echo Yii::app()->createUrl('likes/cincrease', array('id' => $sp->photos_id )); ?>"><i class="
                      <?php
                      $uid=Yii::app()->user->id;
                      $dlike=LogPhotosHearts::model()->find("user_id=$uid and photos_id=$sp->photos_id");
                      if(isset($dlike))
                      echo 'icon-heart';
                      else
                      echo 'icon-heart-empty';
                      ?>"></i></a>
                      <?php } ?>
                      	
                      </div>
                    </div>
                    <?php $firsttime=false;
                     }
                    else
                    {
						?>
                    <div class="item"><a class="hover-zomm" href="#share-pic"  data-toggle="modal" > <img  onclick="change_image(this,$(this).attr('dphoto_id'))" src="" class="img-responsive img-zoom" alt="<?php echo $sp->photos_name; ?>" dphoto_id="<?php echo $sp->photos_id; ?>"></a>
                      <div class="mask">
                      
                      <?php  
                      if(Yii::app()->user->isGuest)
                      {
					  	$printt="<i class='icon-heart-empty'></i>";
					  echo CHtml::link($printt, array('#loginModal'), array('class'=>'like checkmsg', 'data-toggle'=>"modal"));
					  }
						else
						{
							?>
                      
                      <a class="like" href='#' data-url="<?php echo Yii::app()->createUrl('likes/cincrease', array('id' => $sp->photos_id )); ?>"><i class="
                      <?php
                      $uid=Yii::app()->user->id;
                      $dlike=LogPhotosHearts::model()->find("user_id=$uid and photos_id=$sp->photos_id");
                      if(isset($dlike))
                      echo 'icon-heart';
                      else
                      echo 'icon-heart-empty';
                      ?>"></i></a>
                      <?php } ?>
                      	
                      </div>
                    </div>
                  <?php  } 
                  } ?>
                  
                  </div>
                  <!-- Carousel nav -->
                  
                  <div class="carousel-indicators">
                 <ol class="bxslider">

                  <?php
                  $slidernum=0;
                  $firsttime=true;
                  foreach($userPhotos as $sp)
                  {
                  	if($firsttime)
                  	{

				?>
				                  <li data-target="#myCarousel<?php echo $k; ?>" data-slide-to="0" class="active"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $sp->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"></li>
				                  <?php 
				                  $firsttime=false; 
				                  }
				                  else
				                  {
								  	?>
                 <li data-target="#myCarousel<?php echo $k; ?>" data-slide-to="<?php echo $slidernum; ?>"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $sp->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"> </li>
                 <?php
                 }
                 $slidernum++;
                 } ?>
                  </ol>
                  </div>
                </div>
              </div>
              <form>
                <div class="main-tag">
                  <div class="tagcloud" phid="<?php echo $firstId; ?>"> 
                   <?php 
                  	$t= PhotosHashtags::model()->with('hashtags')->findAll("photos_id=$firstId");
                  if(isset($t))
                  foreach($t as $tag)
                  echo CHtml::link($tag->hashtags->hashtags_name, array('site/hashtags', 'hid'=>$tag->hashtags->hashtags_id));
                  ?>
                 </div>
                </div>
                <div class="main-name"> <i class="icon-heart"></i> <a href="#"></a> <span lphid="<?php echo $firstId; ?>"><?php echo $likescount; ?> liked this</span> </div>
                <div class="main-comment"  photo_id=<?php echo $firstId; ?>">
                   <div class="scrollercm" style="height: auto;  max-height: 225px;" data-always-visible="1" data-rail-visible1="1">
                    <ul class="chats" id="<?php echo $firstId; ?>">
                     <?php
                    $com=LogPhotosComment::model()->with('user.userDetails')->findAll("photos_id=$firstId");
                if(isset($com))
                foreach($com as $c)
                {                    
                   ?>
                   <li class="in"> <img class="avatar img-responsive" alt="" src="<?php  
                      		$fromurl=strstr($c->user->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $c->user->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$c->user->userDetails->user_details_avatar; ?>" />
                        <div class="message"> <a href="#" class="name"><?php echo $c->user->userDetails->user_details_firstname.' '.$c->user->userDetails->user_details_lastname; ?></a> 
                        <span class="datetime">@ <?php 
                        	echo get_time_ago($c->log_photos_comment_date);
                        	
                        ?></span> 
                        <span class="body"><?php echo $c->log_photos_comment_description; ?></span> </div>
                      </li>
                   
                    <?php
                    }
                    ?>
                    </ul>
                  </div>
                </div>
                <div class="comment-form"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1.jpg" alt="" class="avatar img-responsive">
                  <div class="input-cont">
                    <textarea data-reactid="" value="Write a comment..." placeholder="Write a comment..." title="Write a comment..."  name="add_comment_text_text" id="js_17" aria-owns="js_23" aria-haspopup="true" aria-expanded="false" aria-label="Write a comment..." style="height: 40px;"  photo_id="<?php echo $firstId; ?>" class="custom-comment-box"></textarea>
                    <!--coder use JS detect height of text to fix size when input like FB--> 
                    
                  </div>
                </div>
              </form>
            </div>
          </div>

          <?php
          		
          	}
          	$i++;
          	$k+=2;
	}
  } ?>
</div>
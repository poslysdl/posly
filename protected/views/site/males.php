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
<script type="text/javascript" > 
function change_image(url, pid)
{
document.cookie="purl="+url.src;
document.cookie="pid="+pid;
}
</script>
  <!-- BEGIN SIDEBAR -->
 
 <div class="page-sidebar-wrapper">
    <div id="right-slide" class="page-sidebar navbar-collapse collapse">
      <div class="mosota">
        <div class="dropdown-menu-list scrollercm" style="height: 1200px;"> 
          
           <!-- BEGIN SIDEBAR MENU -->
          <ul class="page-sidebar-menu">
            <li>
              <div>
                <div class="panel">
                  <div class="panel-title">
                    <h3>Trending Hashtags</h3>
                  </div>
                  <div class="side-tag">
                    <div class="tagcloud"> 
                    <?php
                    $criteria2 = new CDbCriteria();
					$criteria2->limit = 7;
					$criteria2->condition="hashtags_category_id is null";
					$criteria2->order = 'hashtags_count DESC';
                    $trend=Hashtags::model()->findAll($criteria2);
                    if(isset($trend))
                    foreach($trend as $tagg)
                    	echo CHtml::link($tagg->hashtags_name, array('site/hashtags', 'hid'=>$tagg->hashtags_id));
                    ?>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="panel">
                <div class="panel-title" style="transition: 0s; -webkit-transition: 0s;">
                  <h3>2Pretty blog</h3>
                </div>
                <div class="footer-panel-content"> <img class="img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/item_img10.jpg">
                  <h5>Hike - Social Apps</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
              </div>
            </li>
            <li>
              <div>
                <div class="panel">
                  <div class="panel-title">
                    <h3>People You May Know</h3>
                  </div>
                  <div class="people">
                    <ul class="footer-soc">
                    <?php
                    if(Yii::app()->user->isGuest)
                    {
                    	$crt = new CDbCriteria();
                    	$crt->limit=5;
                    	$crt->order="userDetails.user_rank_worldwide ASC";
						$tusers=Users::model()->with('userDetails')->findAll($crt);
						if(isset($tusers))
						{
							foreach($tusers as $u)
							{
								?>
							<li><a class="avan" href="#"> <img src="<?php
                      		$fromurl=strstr($u->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $u->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$u->userDetails->user_details_avatar; ?>" alt="" class="avatar-user-m img-responsive"> <span class="username">
                            <?php echo $u->userDetails->user_details_firstname.' '.$u->userDetails->user_details_lastname; ?></span></a>
	                        <div class="addbut">
	                          <button  type="button" class="btn swhite checkmsg"  data-toggle="modal" href="#loginModal">Follow</button>
	                        </div>
	                      	</li>
								<?php
							}
						}
					}
					else
					{
						$uuid=Yii::app()->user->id;
						$crt = new CDbCriteria();
                    	$crt->limit=5;
                    	$crt->order="userDetails.user_rank_worldwide ASC";
                    	$crt->condition="NOT EXISTS (SELECT * FROM users_follow WHERE user_id =$uuid AND follow_id = t.user_id) and t.user_id <> $uuid";
						$tusers=Users::model()->with('userDetails')->findAll($crt);
						if(isset($tusers))
						{
							foreach($tusers as $u)
							{
								?>
							<li><a class="avan" href="#"> <img src="<?php
                      		$fromurl=strstr($u->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $u->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$u->userDetails->user_details_avatar; ?>" alt="" class="avatar-user-m img-responsive"> <span class="username">
                            <?php echo $u->userDetails->user_details_firstname.' '.$u->userDetails->user_details_lastname; ?></span></a>
	                        <div class="addbut">
	                          <button  type="button" class="btn swhite custom-follow" uid="<?php echo $u->user_id; ?>">Follow</button>
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
              </div>
            </li>
			<li style="height: 900px"></li>
          </ul>
          <!-- END SIDEBAR MENU --> 
        </div>
      </div>
    </div>
  </div>

  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="row ">
      <div class="col-md-6 col-sm-6"> 
          <!--odd boxes-->
           <?php
  if(isset($photos))
  {
  	$i=1;
  	foreach($photos as $p)
  	{
			if($i%2!=0)
			{
				$firstId=0;
				$likescount=0;
			?>
			         <div class="portlet box blue boxshadown">
            <div class="portlet-title">
              <div class="caption"> <img src="<?php
                      		$fromurl=strstr($p->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $p->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$p->userDetails->user_details_avatar; ?>" alt="" class="avatar-user-l img-responsive">
                <div class="cap1"> <?php echo CHtml::link($p->userDetails->user_details_firstname.' '.$p->userDetails->user_details_lastname, array('profile/index', 'url'=>$p->userDetails->user_unique_url), array('class'=>'username')); ?><span class="user-locaion"><?php if(isset($p->userLocation->user_location_country) && isset($p->userLocation->user_location_city))
                 echo $p->userLocation->user_location_country.', '.$p->userLocation->user_location_city;
                 elseif(isset($p->userLocation->user_location_country))
                 echo $p->userLocation->user_location_country; ?></span> </div>
              </div>
              <div class="rank">
                <h2> #<?php echo $p->userDetails->user_rank_worldwide; ?> Rank </h2>
                <span class="arrow"> </span> </div>
            </div>
            <div class="portlet-body">
              <div class="main-img-user">
               <div id="myCarousel<?php echo $i; ?>" class="carousel image-carousel slide view-first">
                  <div class="carousel-inner ">
                  <?php
                  $userPhotos=Photos::model()->findAll("user_id=$p->user_id");
                  $firsttime=true;
                  foreach($userPhotos as $sp)
                  {
                  if($firsttime==true)
                  {
                  	$firstId=$sp->photos_id;
                  	$likescount=$sp->photos_hearts_count;
                  ?>
                    <div class="active item"><a class="hover-zomm" href="#share-pic"  data-toggle="modal" > <img onclick="change_image(this,$(this).attr('dphoto_id'))" src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $p->user_id; ?>/medium/<?php echo $sp->photos_name; ?>" class="img-responsive img-zoom" alt="<?php echo $sp->photos_name; ?>" dphoto_id="<?php echo $sp->photos_id; ?>"></a>
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
                  <?php
                  $firsttime=false;
                   } 
                  else
                  { ?>
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
                  <?php } } ?>
                  
                  </div>
                  <!-- Carousel nav -->
                  <div class="carousel-indicators">
                  <ol class="bxslider">
                  <?php
                  $slidernum=0;
                  $firsttime=true;
                  foreach($userPhotos as $sp)
                  {
                  	if($firsttime==true)
                  	{
                  	?>
                    <li data-target="#myCarousel<?php echo $i; ?>" data-slide-to="<?php echo $slidernum; ?>" class="active"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $p->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"></li>
                    
                 <?php 
                 $firsttime=false;
                 }
                 else
                 { ?>
                 <li data-target="#myCarousel<?php echo $i; ?>" data-slide-to="<?php echo $slidernum; ?>"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $p->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"> </li>
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
	}
  } ?>
 

        </div>
        <div class="col-md-6 col-sm-6"> 
          <!--event boxes-->
          <?php
  if(isset($photos))
  {
  	$i=1;
  	foreach($photos as $p)
  	{
			if($i%2==0)
			{
				$firstId=0;
				$likescount=0;
			?>
          <div class="portlet box blue boxshadown">
            <div class="portlet-title">
              <div class="caption"> <img src="<?php
                      		$fromurl=strstr($p->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $p->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$p->userDetails->user_details_avatar; ?>" alt="" class="avatar-user-l img-responsive">
                <div class="cap1"><?php echo CHtml::link($p->userDetails->user_details_firstname.' '.$p->userDetails->user_details_lastname, array('profile/index', 'url'=>$p->userDetails->user_unique_url), array('class'=>'username')); ?><span class="user-locaion"><?php if(isset($p->userLocation->user_location_country) && isset($p->userLocation->user_location_city))
                 echo $p->userLocation->user_location_country.', '.$p->userLocation->user_location_city;
                 elseif(isset($p->userLocation->user_location_country))
                 echo $p->userLocation->user_location_country; ?></span> </div>
              </div>
              <div class="rank">
                <h2> #<?php echo $p->userDetails->user_rank_worldwide; ?> Rank </h2>
                <span class="arrow"> </span> </div>
            </div>
            <div class="portlet-body">
              <div class="main-img-user">
               <div id="myCarousel<?php echo $i; ?>" class="carousel image-carousel slide view-first">
                  <div class="carousel-inner ">
                  <?php
                  $userPhotos=Photos::model()->findAll("user_id=$p->user_id");
                  $firsttime=true;
                  foreach($userPhotos as $sp)
                  {
                  if($firsttime==true)
                  {
                  	$firstId=$sp->photos_id;
                  	$likescount=$sp->photos_hearts_count;
                  ?>
                    <div class="active item"><a class="hover-zomm" href="#share-pic"  data-toggle="modal" > <img onclick="change_image(this,$(this).attr('dphoto_id'))" src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $p->user_id; ?>/medium/<?php echo $sp->photos_name; ?>" class="img-responsive img-zoom" alt="<?php echo $sp->photos_name; ?>" dphoto_id="<?php echo $sp->photos_id; ?>"></a>
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
                  <?php
                  $firsttime=false;
                   } 
                  else
                  { ?>
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
                  <?php } } ?>
                  
                  </div>
                  <!-- Carousel nav -->
                  
                  <div class="carousel-indicators">
                  <ol class="bxslider">
                  <?php
                  $slidernum=0;
                  $firsttime=true;
                  foreach($userPhotos as $sp)
                  {
                  	if($firsttime==true)
                  	{
                  	?>
                    <li data-target="#myCarousel<?php echo $i; ?>" data-slide-to="<?php echo $slidernum; ?>" class="active"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $p->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"></li>
                    
                 <?php 
                 $firsttime=false;
                 }
                 else
                 { ?>
                 <li data-target="#myCarousel<?php echo $i; ?>" data-slide-to="<?php echo $slidernum; ?>"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $p->user_id; ?>/thumbnail/<?php echo $sp->photos_name; ?>" class="img-responsive img-load" photo_id="<?php echo $sp->photos_id; ?>"> </li>
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
	}
  } ?>
        </div>

      </div>
      <div class="clearfix"></div>
      

      <!--end modal sign up-->
      
     <div id="country-list" class="modal fade modal-dialog country-list" tabindex="-1" aria-hidden="true">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">More Countries</h4>
          </div>
          <div class="modal-body">
            <div class="tabbable tabbable-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1_1" data-toggle="tab">Europe (50)</a></li>
                <li><a href="#tab_1_2" data-toggle="tab">North America (23)</a></li>
                <li><a href="#tab_1_3" data-toggle="tab">South America (12)</a></li>
                <li><a href="#tab_1_4" data-toggle="tab">Asia (45)</a></li>
                <li><a href="#tab_1_5" data-toggle="tab">Oceania (14)</a></li>
              </ul>
              <div class="tab-content"> 
                
                <!--châu âu-->
                <div class="tab-pane active" id="tab_1_1">
                  <div class="row-fluid">
                    <div class="span3">
                      <h4>A</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Albania',array('site/country', 'c'=>'Albania')); ?></li>
                        <li><?php echo CHtml::link('Andorra',array('site/country', 'c'=>'Andorra')); ?></li>
                        <li><?php echo CHtml::link('Armenia',array('site/country', 'c'=>'Armenia')); ?></li>
                        <li><?php echo CHtml::link('Austria',array('site/country', 'c'=>'Austria')); ?></li>
                        <li><?php echo CHtml::link('Azerbaijan',array('site/country', 'c'=>'Azerbaijan')); ?></li>
                      </ul>
                      <h4>B</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Belarus',array('site/country', 'c'=>'Belarus')); ?></li>
                        <li><?php echo CHtml::link('Belgium',array('site/country', 'c'=>'Belgium')); ?></li>
                        <li><?php echo CHtml::link('Bosnia & Herzegovina',array('site/country', 'c'=>'Bosnia')); ?></li>
                        <li><?php echo CHtml::link('Bulgaria',array('site/country', 'c'=>'Bulgaria')); ?></li>
                      </ul>
                      <h4>C</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Croatia',array('site/country', 'c'=>'Croatia')); ?></li>
                        <li><?php echo CHtml::link('Cyprus',array('site/country', 'c'=>'Cyprus')); ?></li>
                        <li><?php echo CHtml::link('Czech Republic',array('site/country', 'c'=>'Czech')); ?></li>
                      </ul>
                      <h4>D</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Denmark',array('site/country', 'c'=>'Denmark')); ?></li>
                      </ul>
                      <h4>E</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Estonia',array('site/country', 'c'=>'Estonia')); ?></li>
                      </ul>
                    </div>
                    <!--2-->
                    <div class="span3">
                      <h4>F</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Finland',array('site/country', 'c'=>'Finland')); ?></li>
                        <li><?php echo CHtml::link('France',array('site/country', 'c'=>'France')); ?></li>
                      </ul>
                      <h4>G</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Georgia',array('site/country', 'c'=>'Georgia')); ?></li>
                        <li><?php echo CHtml::link('Germany',array('site/country', 'c'=>'Germany')); ?></li>
                        <li><?php echo CHtml::link('Greece',array('site/country', 'c'=>'Greece')); ?></li>
                      </ul>
                      <h4>H</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Hungary',array('site/country', 'c'=>'Hungary')); ?></li>
                      </ul>
                      <h4>I</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Iceland',array('site/country', 'c'=>'Iceland')); ?></li>
                        <li><?php echo CHtml::link('Ireland',array('site/country', 'c'=>'Ireland')); ?></li>
                        <li><?php echo CHtml::link('Italy',array('site/country', 'c'=>'Italy')); ?></li>
                      </ul>
                      <h4>K</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Kosovo',array('site/country', 'c'=>'Kosovo')); ?></li>
                      </ul>
                    </div>
                    
                    <!--3-->
                    <div class="span3">
                      <h4>L</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Latvia',array('site/country', 'c'=>'Latvia')); ?></li>
                        <li><?php echo CHtml::link('Liechtenstein',array('site/country', 'c'=>'Liechtenstein')); ?></li>
                        <li><?php echo CHtml::link('Lithuania',array('site/country', 'c'=>'Lithuania')); ?></li>
                        <li><?php echo CHtml::link('Luxembourg',array('site/country', 'c'=>'Luxembourg')); ?></li>
                      </ul>
                      <h4>M</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Macedonia',array('site/country', 'c'=>'Macedonia')); ?></li>
                        <li><?php echo CHtml::link('Malta',array('site/country', 'c'=>'Malta')); ?></li>
                        <li><?php echo CHtml::link('Moldova',array('site/country', 'c'=>'Moldova')); ?></li>
                        <li><?php echo CHtml::link('Monaco',array('site/country', 'c'=>'Monaco')); ?></li>
                        <li><?php echo CHtml::link('Montenegro',array('site/country', 'c'=>'Montenegro')); ?></li>
                      </ul>
                      <h4>N</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Netherlands',array('site/country', 'c'=>'Netherlands')); ?></li>
                        <li><?php echo CHtml::link('Norway',array('site/country', 'c'=>'Norway')); ?></li>
                      </ul>
                      <h4>P</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Poland',array('site/country', 'c'=>'Poland')); ?></li>
                        <li><?php echo CHtml::link('Portugal',array('site/country', 'c'=>'Portugal')); ?></li>
                      </ul>
                    </div>
                    <!--4-->
                    <div class="span3">
                      <h4>R</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Romania',array('site/country', 'c'=>'Romania')); ?></li>
                        <li><?php echo CHtml::link('Russia',array('site/country', 'c'=>'Russia')); ?></li>
                      </ul>
                      <h4>S</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('San Marino',array('site/country', 'c'=>'Marino')); ?></li>
                        <li><?php echo CHtml::link('Serbia',array('site/country', 'c'=>'Serbia')); ?></li>
                        <li><?php echo CHtml::link('Slovakia',array('site/country', 'c'=>'Slovakia')); ?></li>
                        <li><?php echo CHtml::link('Slovenia',array('site/country', 'c'=>'Slovenia')); ?></li>
                        <li><?php echo CHtml::link('Spain',array('site/country', 'c'=>'Spain')); ?></li>
                        <li><?php echo CHtml::link('Sweden',array('site/country', 'c'=>'Sweden')); ?></li>
                        <li><?php echo CHtml::link('Switzerland',array('site/country', 'c'=>'Switzerland')); ?></li>
                      </ul>
                      <h4>T</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Turkey',array('site/country', 'c'=>'Turkey')); ?></li>
                      </ul>
                      <h4>U</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Ukraine',array('site/country', 'c'=>'Ukraine')); ?></li>
                        <li><?php echo CHtml::link('United Kingdom',array('site/country', 'c'=>'Kingdom')); ?></li>
                      </ul>
                      <h4>V</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Vatican City (Holy See)',array('site/country', 'c'=>'Vatican')); ?></li>
                      </ul>
                    </div>
                    <!--end1--> 
                  </div>
                </div>
                
                <!--b?c m?-->
                <div class="tab-pane" id="tab_1_2">
                  <div class="row-fluid">
                    <div class="span3">
                      <h4>A</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Antigua & Barbuda',array('site/country', 'c'=>'Antigua')); ?></li>
                      </ul>
                      <h4>B</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Bahamas',array('site/country', 'c'=>'Bahamas')); ?></li>
                        <li><?php echo CHtml::link('Barbados',array('site/country', 'c'=>'Barbados')); ?></li>
                        <li><?php echo CHtml::link('Belize',array('site/country', 'c'=>'Belize')); ?></li>
                      </ul>
                      <h4>C</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Canada',array('site/country', 'c'=>'Canada')); ?></li>
                        <li><?php echo CHtml::link('Costa Rica',array('site/country', 'c'=>'Costa')); ?></li>
                        <li><?php echo CHtml::link('Cuba',array('site/country', 'c'=>'Cuba')); ?></li>
                      </ul>
                      <h4>D</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Dominica',array('site/country', 'c'=>'Dominica')); ?></li>
                        <li><?php echo CHtml::link('Dominican Republic',array('site/country', 'c'=>'Dominican')); ?></li>
                      </ul>
                    </div>
                    <!--2-->
                    <div class="span3">
                      <h4>E</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('El Salvador',array('site/country', 'c'=>'Salvador')); ?></li>
                      </ul>
                      <h4>G</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Grenada',array('site/country', 'c'=>'Grenada')); ?></li>
                        <li><?php echo CHtml::link('Guatemala',array('site/country', 'c'=>'Guatemala')); ?></li>
                      </ul>
                      <h4>H</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Haiti',array('site/country', 'c'=>'Haiti')); ?></li>
                        <li><?php echo CHtml::link('Honduras',array('site/country', 'c'=>'Honduras')); ?></li>
                      </ul>
                      <h4>J</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Jamaica',array('site/country', 'c'=>'Jamaica')); ?></li>
                      </ul>
                    </div>
                    
                    <!--3-->
                    <div class="span3">
                      <h4>M</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Mexico',array('site/country', 'c'=>'Mexico')); ?></li>
                      </ul>
                      <h4>N</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Nicaragua',array('site/country', 'c'=>'Nicaragua')); ?></li>
                      </ul>
                      <h4>P</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Panama',array('site/country', 'c'=>'Panama')); ?></li>
                      </ul>
                      <h4>S</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('St. Kitts & Nevis',array('site/country', 'c'=>'Kitts')); ?></li>
                        <li><?php echo CHtml::link('St. Lucia',array('site/country', 'c'=>'Lucia')); ?></li>
                        <li><?php echo CHtml::link('St. Vincent & The Grenadines',array('site/country', 'c'=>'Vincent')); ?></li>
                      </ul>
                    </div>
                    <!--4-->
                    <div class="span3">
                      <h4>T</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Trinidad & Tobago',array('site/country', 'c'=>'Trinidad')); ?></li>
                      </ul>
                      <h4>U</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('San Marino',array('site/country', 'c'=>'Marino')); ?></li>
                      </ul>
                      <h4>T</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Turkey',array('site/country', 'c'=>'Turkey')); ?></li>
                      </ul>
                      <h4>U</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('United States of America',array('site/country', 'c'=>'US')); ?></li>
                      </ul>
                    </div>
                    <!--end1--> 
                  </div>
                </div>
                
                <!--nam m?-->
                <div class="tab-pane" id="tab_1_3">
                  <div class="row-fluid">
                    <div class="span3">
                      <h4>A</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Argentina',array('site/country', 'c'=>'Argentina')); ?></li>
                      </ul>
                      <h4>B</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Bolivia',array('site/country', 'c'=>'Bolivia')); ?></li>
                        <li><?php echo CHtml::link('Brazil',array('site/country', 'c'=>'Brazil')); ?></li>
                      </ul>
                      <h4>C</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Chile',array('site/country', 'c'=>'Chile')); ?></li>
                        <li><?php echo CHtml::link('Colombia',array('site/country', 'c'=>'Colombia')); ?></li>
                      </ul>
                    </div>
                    <!--2-->
                    <div class="span3">
                      <h4>E</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Ecuador',array('site/country', 'c'=>'Ecuador')); ?></li>
                      </ul>
                      <h4>G</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Guyana',array('site/country', 'c'=>'Guyana')); ?></li>
                      </ul>
                      <h4>P</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Paraguay',array('site/country', 'c'=>'Paraguay')); ?></li>
                        <li><?php echo CHtml::link('Peru',array('site/country', 'c'=>'Peru')); ?></li>
                      </ul>
                    </div>
                    
                    <!--3-->
                    <div class="span3">
                      <h4>S</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Suriname',array('site/country', 'c'=>'Suriname')); ?></li>
                      </ul>
                      <h4>U</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Uruguay',array('site/country', 'c'=>'Uruguay')); ?></li>
                      </ul>
                      <h4>V</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Venezuela',array('site/country', 'c'=>'Venezuela')); ?></li>
                      </ul>
                    </div>
                    
                    <!--end1--> 
                  </div>
                </div>
                
                <!--châu á-->
                <div class="tab-pane" id="tab_1_4">
                  <div class="row-fluid">
                    <div class="span3">
                      <h4>A</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Afghanistan',array('site/country', 'c'=>'Afghanistan')); ?></li>
                      </ul>
                      <h4>B</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Bahrain',array('site/country', 'c'=>'Bahrain')); ?></li>
                        <li><?php echo CHtml::link('Bangladesh',array('site/country', 'c'=>'Bangladesh')); ?></li>
                        <li><?php echo CHtml::link('Bhutan',array('site/country', 'c'=>'Bhutan')); ?></li>
                        <li><?php echo CHtml::link('Brunei',array('site/country', 'c'=>'Brunei')); ?></li>
                      </ul>
                      <h4>C</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Cambodiaa',array('site/country', 'c'=>'Cambodiaa')); ?></li>
                        <li><?php echo CHtml::link('China',array('site/country', 'c'=>'China')); ?></li>
                      </ul>
                      <h4>E</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('East Timor',array('site/country', 'c'=>'Timor')); ?></li>
                      </ul>
                      <h4>I</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('India',array('site/country', 'c'=>'India')); ?></li>
                        <li><?php echo CHtml::link('Indonesia',array('site/country', 'c'=>'Indonesia')); ?></li>
                        <li><?php echo CHtml::link('Iran',array('site/country', 'c'=>'Iran')); ?></li>
                        <li><?php echo CHtml::link('Iraq',array('site/country', 'c'=>'Iraq')); ?></li>
                        <li><?php echo CHtml::link('Israel',array('site/country', 'c'=>'Israel')); ?></li>
                      </ul>
                    </div>
                    <!--2-->
                    <div class="span3">
                      <h4>J</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Japan',array('site/country', 'c'=>'Japan')); ?></li>
                        <li><?php echo CHtml::link('Jordan',array('site/country', 'c'=>'Jordan')); ?></li>
                      </ul>
                      <h4>K</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Kazakhstan',array('site/country', 'c'=>'Kazakhstan')); ?></li>
                        <li><?php echo CHtml::link('Korea North',array('site/country', 'c'=>'Korea')); ?></li>
                        <li><?php echo CHtml::link('Korea South',array('site/country', 'c'=>'Korea')); ?></li>
                        <li><?php echo CHtml::link('Kuwait',array('site/country', 'c'=>'Kuwait')); ?></li>
                        <li><?php echo CHtml::link('Kyrgyzstan',array('site/country', 'c'=>'Kyrgyzstan')); ?></li>
                      </ul>
                      <h4>L</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Laos',array('site/country', 'c'=>'Laos')); ?></li>
                        <li><?php echo CHtml::link('Lebanon',array('site/country', 'c'=>'Lebanon')); ?></li>
                      </ul>
                      <h4>M</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Malaysia',array('site/country', 'c'=>'Malaysia')); ?></li>
                        <li><?php echo CHtml::link('Maldives',array('site/country', 'c'=>'Maldives')); ?></li>
                        <li><?php echo CHtml::link('Mongolia',array('site/country', 'c'=>'Mongolia')); ?></li>
                        <li><?php echo CHtml::link('Myanmar (Burma)',array('site/country', 'c'=>'Myanmar')); ?></li>
                      </ul>
                    </div>
                    
                    <!--3-->
                    <div class="span3">
                      <h4>N</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Nepal',array('site/country', 'c'=>'Nepal')); ?></li>
                        <li><?php echo CHtml::link('Norway',array('site/country', 'c'=>'Norway')); ?></li>
                      </ul>
                      <h4>O</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Oman',array('site/country', 'c'=>'Oman')); ?></li>
                      </ul>
                      <h4>P</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Pakistan',array('site/country', 'c'=>'Pakistan')); ?></li>
                        <li><?php echo CHtml::link('Philippines',array('site/country', 'c'=>'Philippines')); ?></li>
                      </ul>
                      <h4>Q</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Qatar',array('site/country', 'c'=>'Qatar')); ?></li>
                      </ul>
                      <h4>R</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Russia',array('site/country', 'c'=>'Russia')); ?></li>
                      </ul>
                      <h4>S</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Saudi Arabia',array('site/country', 'c'=>'Saudi')); ?></li>
                        <li><?php echo CHtml::link('Singapore',array('site/country', 'c'=>'Singapore')); ?></li>
                        <li><?php echo CHtml::link('Sri Lanka',array('site/country', 'c'=>'Lanka')); ?></li>
                        <li><?php echo CHtml::link('Syria',array('site/country', 'c'=>'Syria')); ?></li>
                      </ul>
                    </div>
                    
                    <!--4-->
                    <div class="span3">
                      <h4>T</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Taiwan',array('site/country', 'c'=>'Taiwan')); ?></li>
                        <li><?php echo CHtml::link('Tajikistan',array('site/country', 'c'=>'Tajikistan')); ?></li>
                        <li><?php echo CHtml::link('Thailand',array('site/country', 'c'=>'Thailand')); ?></li>
                        <li><?php echo CHtml::link('Turkey',array('site/country', 'c'=>'Turkey')); ?></li>
                        <li><?php echo CHtml::link('Turkmenistan',array('site/country', 'c'=>'Turkmenistan')); ?></li>
                      </ul>
                      <h4>U</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('United Arab Emirates',array('site/country', 'c'=>'Arab')); ?></li>
                        <li><?php echo CHtml::link('Uzbekistan',array('site/country', 'c'=>'Uzbekistan')); ?></li>
                      </ul>
                      <h4>V</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Vietnam',array('site/country', 'c'=>'Vietnam')); ?></li>
                      </ul>
                      <h4>Y</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Yemen',array('site/country', 'c'=>'Yemen')); ?></li>
                      </ul>
                    </div>
                    <!--end1--> 
                  </div>
                </div>
                
                <!--châu d?i duong-->
                <div class="tab-pane" id="tab_1_5">
                  <div class="row-fluid">
                    <div class="span3">
                      <h4>A</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Australia',array('site/country', 'c'=>'Australia')); ?></li>
                      </ul>
                      <h4>F</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Fiji',array('site/country', 'c'=>'Fiji')); ?></li>
                      </ul>
                      <h4>K</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Kiribati',array('site/country', 'c'=>'Kiribati')); ?></li>
                      </ul>
                      <h4>M</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Marshall Islands',array('site/country', 'c'=>'Marshall')); ?></li>
                        <li><?php echo CHtml::link('Micronesia',array('site/country', 'c'=>'Micronesia')); ?></li>
                      </ul>
                    </div>
                    <!--2-->
                    <div class="span3">
                      <h4>S</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Samoa',array('site/country', 'c'=>'Samoa')); ?></li>
                        <li><?php echo CHtml::link('Solomon Islands',array('site/country', 'c'=>'Solomon')); ?></li>
                      </ul>
                      <h4>N</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Nauru',array('site/country', 'c'=>'Nauru')); ?></li>
                        <li><?php echo CHtml::link('New Zealand',array('site/country', 'c'=>'Zealand')); ?></li>
                      </ul>
                      <h4>P</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Palau',array('site/country', 'c'=>'Palau')); ?></li>
                        <li><?php echo CHtml::link('Papua New Guinea',array('site/country', 'c'=>'Papua')); ?></li>
                      </ul>
                    </div>
                    <!--3-->
                    <div class="span3">
                      <h4>T</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Tonga',array('site/country', 'c'=>'Tonga')); ?></li>
                        <li><?php echo CHtml::link('Tuvalu',array('site/country', 'c'=>'Tuvalu')); ?></li>
                      </ul>
                      <h4>V</h4>
                      <ul class="unstyled">
                        <li><?php echo CHtml::link('Vanuatu',array('site/country', 'c'=>'Vanuatu')); ?></li>
                      </ul>
                    </div>
                    <!--end1--> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- /.modal share big images --> 
      
      <!-- long modals -->
      <div id="share-pic" class="modal  modal-scroll share-image" tabindex="-1" data-replace="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
        </div>
        <div class="modal-body" id="modalbody">
        
               <!--this popup page -->
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption dynamic-caption"> 
              </div>
                                                  
              <div class="rank dynamic-rank">
              <div class="share-ranks">
              <a href="#" class="dropdown-toggle"  data-toggle="dropdown" data-close-others="true"><i class="icon-retweet"></i></a>
               <ul class="dropdown-menu share-pic">
                                      <li><span>Share now on</span></li>
                                      <li>
                                      <?php /*echo CHtml::ajaxLink('Facebook', array('/photo/share'),  array(
                                      'success'=>'function(data){alert(data);}'), array('class'=>'btn faceS custom-face'));*/ ?> 
                                        <button type="button" class="btn faceS" onclick='postToFeed(); return false;' >Facebook</button>
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
                <h2></h2>
                <span class="arrow"> </span> </div>
            </div>
            <div class="portlet-body">
              <div class="main-img-user">
                <div id="myCarousel4pop" class="carousel image-carousel slide view-first">
                  <div class="carousel-inner dynamic-carousel-inner">
                  </div>
                  <!-- Carousel nav -->
                  
                  <ol class="carousel-indicators dynamic-bxslider dynamic-carousel-indicators">
                 </ol>
                </div>
              </div>
             
             	<div class="panel-title">
                    <h3>Tagged with</h3>
                  </div>
                <div class="main-tag dynamic-main-tag">
                </div>
                
                
             
            </div>
            
          
            
          </div>
          
          <!--part2-->
          
          <div class="portlet box blue">
          
            <div class="portlet-body">
            <div class="main-name dynamic-main-name"></div>
            
                <div class="main-comment dynamic-main-comment" >
                </div>
                <div class="comment-form dynamic-comment-form">
                </div>
            </div>
            
          </div>
 
          
        </div>
        
      </div>
      
      <!--end- Modals --> 
      
    </div>
  </div>
  <!-- END PAGE --> 



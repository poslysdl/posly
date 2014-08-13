<div class="row">
<?php 
  if(!empty($photos))
  { 
  ?>
          <div class="col-md-12 more-loked">
          <h3> People who liked this liked:</h3>
          </div>
                 <?php

  	foreach($photos as $p)
  	{
			?>

          <div class="col-md-6 col-sm-6">
          <div class="portlet box blue">
          
          <div class="portlet-title">
              <div class="caption"> <img src="<?php
                      		$fromurl=strstr($p->userDetails->user_details_avatar, '://', true);
                            if($fromurl=='http' || $fromurl=='https')
                            echo $p->userDetails->user_details_avatar; 
                            else
                            echo Yii::app()->baseUrl.'/profiles/'.$p->userDetails->user_details_avatar; ?>" alt="" class="avatar-user-l img-responsive">
                <div class="cap1"> <a class="username" href="#"><?php echo $p->userDetails->user_details_firstname.' '.$p->userDetails->user_details_lastname; ?></a><span class="user-locaion"><?php if(isset($p->userLocation->user_location_country) && isset($p->userLocation->user_location_city))
                 echo $p->userLocation->user_location_country.', '.$p->userLocation->user_location_city;
                 elseif(isset($p->userLocation->user_location_country))
                 echo $p->userLocation->user_location_country; ?></span> </div>
              </div>
              <div class="rank">
                <h2> #<?php echo $p->userDetails->user_rank_worldwide; ?> Rank </h2>
                <span class="arrow"> </span> </div>
            </div>
            <div class="portlet-body loked">
            
              <div class="main-img-user">
              <div class="carousel image-carousel slide view-first">
                  <div class="carousel-inner ">
                  <?php
                   foreach($p->photos as $newp)
                  {
                  	$photoId=$newp->photos_id;
                  	$heartsCount=$newp->photos_hearts_count;
				  	?>     <div class="active item loked"><a class="hover-zomm" href="#"  data-toggle="modal" style="cursor: default;"> <img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $p->user_id; ?>/medium/<?php echo $newp->photos_name; ?>" class="img-responsive" alt="<?php echo $newp->photos_name; ?>"></a>
                    </div>
                    <?php } ?>
	                </div>
                 </div>
              </div>
            
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
                <div class="main-name"> <i class="icon-heart"></i> <span><?php echo $heartsCount; ?> liked this</span> </div>
                
                <div class="comment-form"> <img class="avatar img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1.jpg">
                  <div class="input-cont">
                    <textarea style="height: 40px;" aria-label="Write a comment..." aria-expanded="false" aria-haspopup="true" aria-owns="js_23" id="js_17" name="add_comment_text_text" title="Write a comment..." placeholder="Write a comment..." value="Write a comment..." data-reactid="" photo_id="<?php echo $photoId; ?>" class="custom-comment-box"></textarea>
                    <!--coder use JS detect height of text to fix size when input like FB--> 
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
          </div>
          <?php } } ?>
          </div>
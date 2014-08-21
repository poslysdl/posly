    
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="usepic"> <img class="img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/avanta2.jpg"> </div>
                  </div>
                  <div class="col-md-6 tag">
                    <div class="button-head">
                      <button class="btn white follow" type="button"><i class="icon-edit"></i>Change</button>
                    </div>
                    <h3>Magazines I like</h3>
                    <div class="tagcloud"> 
                    
                    <?php if (!empty($mag_tags) && isset($mag_tags)) 
                    {
						foreach ($mag_tags as $m) { ?>
							  <a href="#"><?php echo $m->hashtags->hashtags_name; ?></a>
					<?php	}
					} else { ?>
						 <i>No tags found. </i>
					<?php }
                    ?>
                    
                     
                    
                    
                    </div>
                    <div class="divider"></div>
                    <h3>Designers & Brands I love the most</h3>
                    <div class="tagcloud"> 
                    
                    <?php if (!empty($design_tags) && isset($design_tags)) 
                    {
						foreach ($design_tags as $m) { ?>
							  <a href="#"><?php echo $m->hashtags->hashtags_name; ?></a>
					<?php	}
					} else { ?>
						 <i>No tags found. </i>
					<?php }
                    ?>
                    
                    </div>
                    <div class="divider"></div>
                    <h3>Shops I like to go for shopping</h3>
                    <div class="tagcloud">
                    
                     <?php if (!empty($shops_tags) && isset($shops_tags)) 
                    {
						foreach ($shops_tags as $m) { ?>
							  <a href="#"><?php echo $m->hashtags->hashtags_name; ?></a>
					<?php	}
					} else { ?>
						 <i>No tags found. </i>
					<?php }
                    ?>
                     
                     
                     </div>
                    <div class="divider"></div>
                    <h3>I love the style of</h3>
                    <div class="tagcloud"> 
                    
                    <?php if (!empty($styles_tags) && isset($styles_tags)) 
                    {
						foreach ($styles_tags as $m) { ?>
							  <a href="#"><?php echo $m->hashtags->hashtags_name; ?></a>
					<?php	}
					} else { ?>
						 <i>No tags found. </i>
					<?php }
                    ?>
                    	
                    	
                    </div>
                    <div class="divider"></div>
                    <h3>My style</h3>
                    <div class="tagcloud"> 
                    
                    
                    <?php if (!empty($mtstyle_tags) && isset($mtstyle_tags)) 
                    {
						foreach ($mtstyle_tags as $m) {  ?>
							  <a href="#"><?php echo $m->hashtags->hashtags_name; ?></a>
					<?php	}
					} else { ?>
						 <i>No tags found. </i>
					<?php }
                    ?>
                    
                    
                    </div>
                  </div>
                </div>
              </div>
           
            
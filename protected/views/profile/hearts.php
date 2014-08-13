
     
            <?php /*foreach ($model as $m) {
            	
            	echo $m->photos->photos_name;
     			echo $m->photos->logPhotosCount;
     			echo $m->user->userDetails->user_details_email;
     			print_r($m);
            	print_r($m->user->userDetails->user_details_email);
            	} 
            	
            	//print_r($model);
            	*/ //print_r($model); die();?>
   <div class="portlet-body single-image">
                <div class="row">
                  <div class="pro-image"> 
                    <!--blank image--> 
                    
                    <!--end--> 
                    
                    <!--image new-->
                    <div class="col-md-12 col-sm-12 image-single">
                      <ul class="grid" id="grid-heart">
                        
                      <?php foreach ($model as $m) {  ?>
                        
                        
                        <li>
                          <div class="white-bg-album box blue boxshadown">
                            <div class="portlet-body si-img view-first">
                              <div class="mask-top">
                               
                                <div class="col-lg-12 mask-topb"> <a href="#"><i class="icon-user"></i></a> <a href="#"><i class="icon-plus-sign"></i></a> <a href="#"><i class="icon-envelope"></i></a><a href="#" class="dropdown-toggle"  data-toggle="dropdown" data-close-others="true"><i class="icon-retweet"></i></a>
                                  <div class="dropdown-menu share-pic full-12">
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
                                    <div class="endles">
     <button type="button" class="btn meoS" data-toggle="modal" href="#sign-up">Email</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="main-img-user "> <a class="hover-zomm" data-toggle="modal" href="#block-user">
<img src="<?php echo Yii::app()->baseUrl; ?>/files/<?php echo $m->owner_id; ?>/medium/<?php echo $m->photos->photos_name; ?>"></a>
                                <div class="mask"> <a href="#long" data-toggle="modal" class="like"><i class="icon-heart"></i></a> </div>
                                <div class="bot-icon">
                                
                                
                                  <div class="col-lg-4"><i class="icon-heart"></i>
                                  
                                  <span><?php echo $m->photos->photos_hearts_count ?></span>
                                  
                                  </div>
                                  <div class="col-lg-4"> <i class="icon-comments"></i>
                                  
                                  
                                  <span><?php echo $m->photos->logPhotosCount; ?></span>
                                  
                                  </div>
                                  <div class="col-lg-4">
                                  
                                  <span>#<?php echo $m->user->userDetails->user_rank_worldwide; ?> Rank</span>
                                  
                                  
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      
                    
                      <?php } ?>  
                        
                        
                      </ul>
                    </div>
                    <!--end--> 
                    
                  </div>
                </div>
              </div>
              
          
			
			
	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
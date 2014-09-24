<?php
$users_follower_even = $user_info['users_follower_even'];
$users_follower_odd = $user_info['users_follower_odd'];
//echo "<pre>";
//    print_r($user_info);
//echo "</pre>";    
?>
<div class="portlet-body follow">
   <div class="row">
      <!--      first column-->         
      <div class="col-md-6">
         <?php
         if(count($users_follower_even)>0){
            foreach ($users_follower_even as $users_even){
         ?>
         <div class="following boxshadown white-bgf bRd">         
            <div class="title">
               <div class="caption"> <img src="<?php echo $users_even['avatar']; ?>" alt="" class="avatar-user-l img-responsive">
                  <div class="cap1"> <a class="username" href="#"><?php echo $users_even['user_details_firstname']; ?> <?php echo $users_even['user_details_lastname']; ?></a><span class="user-locaion">#1 Rank - <?php echo $users_even['followerCount']; ?>                  
                  <?php
                  if($users_even['followerCount']>1){
                  ?>
                     Followers
                  <?php
                  }
                  else{
                  ?>
                     Follower
                  <?php
                  }
                  ?>       
                  - from <?php echo $users_even['user_location_country']; ?>, <?php echo $users_even['user_location_city']; ?></span> </div>
               </div>               
               <div class="Fl">
                  <button type="button" class="btn cyan active">Unfollow</button>
               </div>
            </div>            
            <div class="bd">
               <ul class="list-inline fL-images">
                  <li class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                     <a href="#">
                        <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/blog/2.jpg" alt="">
                     </a>
                  </li>
               </ul>
            </div>      
         </div>
         <?php }} ?>
      </div>      
      <!--      second column-->      
      <div class="col-md-6">
         <?php
         if(count($users_follower_odd)>0){
            foreach ($users_follower_odd as $users_odd){
         ?>         
         <div class="following boxshadown white-bgf bRd">         
            <div class="title">
               <div class="caption"> <img src="<?php echo $users_odd['avatar']; ?>" alt="" class="avatar-user-l img-responsive">
                  <div class="cap1"> <a class="username" href="#"><?php echo $users_odd['user_details_firstname']; ?> <?php echo $users_odd['user_details_lastname']; ?></a><span class="user-locaion">#1 Rank - <?php echo $users_odd['followerCount']; ?>
                  <?php
                  if($users_odd['followerCount']>1){
                  ?>
                     Followers
                  <?php
                  }
                  else{
                  ?>
                     Follower
                  <?php
                  }
                  ?>  
                  - from <?php echo $users_odd['user_location_country']; ?>, <?php echo $users_odd['user_location_city']; ?></span> </div>
               </div>         
               <div class="Fl">
                  <button type="button" class="btn cyan active">Unfollow</button>
               </div>
            </div>         
            <div class="bd">
               <ul class="list-inline fL-images">
                  <li class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                     <a href="#">
                        <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/blog/2.jpg" alt="">
                     </a>
                  </li>
               </ul>
            </div>  
         </div>
         <?php }} ?>
      </div>
   </div>
</div>  
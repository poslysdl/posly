<?php
//echo "<pre>";
//    print_r($user_info);
//echo "</pre>";    
?>
<div class="portlet-body about">
<div class="row">
<div class="col-md-6">
<div class="about-me boxshadown white-bgf bRd">
<h3>About me</h3>
<p><?php echo $user_info['users_details']['user_details_slogan'];?> </p>
<h3> Visit My</h3>
<div class="social"><a target="_blank" href="#"><i class="icon-facebook-sign"></i></a><a target="_blank" href="#"><i class="icon-twitter-sign"></i></a><a target="_blank" href="#"><i class="icon-instagram"></i></a><a target="_blank" href="#"><i class="icon-pinterest-sign"></i></a><a target="_blank" href="#"><i class="icon-vk"></i></a><a target="_blank" href="#"><i class="icon-home"></i></a></div>
<?php if($user_info['current_user'] == $this->user_self) { ?>
<div class="foot-edit"> <span> <a href="#"> <i class="icon-edit m-icon-gray"></i>Edit </a> &nbsp; </span> </div>
<?php } ?>
</div>
<div class="basic-info boxshadown white-bgf bRd">
<h3>Basic Information </h3>
<div class="bang_mi">
<table>
<tbody>
<tr>
<td class="ksv">GENDER</td>
<td><?php echo $user_info['gender'];?></td>
</tr>
<tr>
<td class="ksv">AGE</td>
<td><?php echo $user_info['age'];?> years</td>
</tr>
<tr>
<td class="ksv">Phone</td>
<td><div><?php echo $user_info['users_details']['user_details_phone'];?></div></td>
</tr>
<tr>
<td class="ksv">Email</td>
<td><?php echo $user_info['users_details']['user_details_email'];?></td>
</tr>
<tr>
<td class="ksv">Address</td>
<td><div>
<div class="Bwtxt"><?php echo $user_info['users_details']['user_details_address'];?></div>
</div></td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
</tbody>
</table>
</div>
<?php if($user_info['current_user'] == $this->user_self) { ?>
    <div class="foot-edit"> <span> <a href="#"> <i class="icon-edit m-icon-gray"></i>Edit </a> &nbsp; </span> </div>
<?php } ?>
</div>
</div>
<div class="col-md-6">
<div class="tag boxshadown white-bgf bRd">
<h3>Magazines I like</h3>
<div class="tagcloud">
    <?php
    if($user_info['user_magzine_hashtag']){
        foreach($user_info['user_magzine_hashtag'] as $hash_name){?>

    <a href="#"><?php echo $hash_name; ?></a>
    
    <?php }}?>
</div>

<div class="divider"></div>
<h3>Designers & Brands I love the most</h3>
<div class="tagcloud">
    <?php
    if($user_info['user_design_hashtag']){  
        foreach($user_info['user_design_hashtag'] as $hash_name){?>
    <a href="#"><?php echo $hash_name; ?></a>    
    <?php }}?>
</div>
<div class="divider"></div>
<h3>Shops I like to go for shopping</h3>
<div class="tagcloud">
    <?php
    if($user_info['user_shops_hashtag']){     
        foreach($user_info['user_shops_hashtag'] as $hash_name){?>
    <a href="#"><?php echo $hash_name; ?></a>    
    <?php }}?>
</div>
<div class="divider"></div>
<h3>I love the style of</h3>
<div class="tagcloud">
    <?php
    if($user_info['user_styleIcons_hashtag']){    
    foreach($user_info['user_styleIcons_hashtag'] as $hash_name){?>
    <a href="#"><?php echo $hash_name; ?></a>    
    <?php }}?>
</div>
<div class="divider"></div>
<h3>My style</h3>
<div class="tagcloud">
    <?php
    if($user_info['user_myStyle_hashtag']){
    foreach($user_info['user_myStyle_hashtag'] as $hash_name){?>
    <a href="#"><?php echo $hash_name; ?></a>    
    <?php }}?>
</div>

<?php if($user_info['current_user'] == $this->user_self) { ?>
    <div class="foot-edit"> <span> <a href="#"> <i class="icon-edit m-icon-gray"></i>Edit </a> &nbsp; </span> </div>
<?php } ?>
</div>
</div>
</div>
</div>
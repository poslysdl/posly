<div class="portlet-body">
                <div class="row">
                  <div class="col-md-8">
                  <div class="tab-raking portlet-body boxshadown white-bgf ">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Published</th>
											<th>IMAGE</th>
											<th>Likes</th>
											<th class="hidden-480">Comments</th>
											<th>Shares</th>
										</tr>
									</thead>
									<tbody>
									
									
		<?php foreach ($model as $m){ 	
		$unix_timestamp = $m->photos_created_date;
		   
		   $date = date( "d/m/Y", $unix_timestamp);?>
		<tr>
											<td><?php echo $date; ?></td>
											<td><a href="#" class="avan"> <img class="avatar-user-m img-responsive" alt="" src="<?php echo Yii::app()->baseUrl . "/files/" . $m->user_id . "/thumbnail/" . $m->photos_name; ?>"> <span class="username">Contest Pic 1</span></a></td>
											<td><div class="con-name"> <i class="icon-heart"></i> 
											
											
											<span><?php echo $m->photos_hearts_count;?></span> </div></td>
											<td class="hidden-480"><?php echo $m->logPhotosCount;?></td>
											<td>48</td>
										</tr>
		<?php } ?>
									
									
										 
									</tbody>
								</table>
							</div>
                  </div>
                  <div class="col-md-4">
                 	<div class="tabbable-custom boxshadown rak-tab">
								<ul class="nav nav-tabs ">
									<li class="">
										<a href="#tab_5_1" data-toggle="tab"><i class="icon-earth"></i></a>
									</li>
									<li class="">
										<a href="#tab_5_2" data-toggle="tab"><i class="icon-flag-icon-fly"></i></a>
									</li>
									<li class="active">
										<a href="#tab_5_3" data-toggle="tab"><i class="icon-map-marker"></i></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane" id="tab_5_1">
										<h3>Global</h3>
                                        <div class="number-rak"><?php echo $ranks->user_rank_worldwide; ?></div>
									</div>
									<div class="tab-pane" id="tab_5_2">
										<p>
											Howdy, where's design this content?.
										</p>
										
										
									</div>
									<div class="tab-pane active" id="tab_5_3">
										<p>
											Howdy, where's design this content?
										</p>
										
										
									</div>
								</div>
							</div>
                  </div>
                </div>
              </div>
             
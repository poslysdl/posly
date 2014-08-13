<!--modal add image-->
<div id="add-image-index" class="modal modal-scroll fade modal-add-image">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">Add an image</h4>
	</div>
	<div class="modal-body">
		<div class="row"> 
			<div class="col-md-12"><div id="error-status"></div></div>
		</div>
		<form id="uploadfiles" action="<?php echo Yii::app()->createUrl('/photo/upload'); ?>" method="POST" enctype="multipart/form-data">
			<input  type="hidden" name="imgx1" id="imgx1"/>
			<input  type="hidden" name="imgy1" id="imgy1"/>
			<input  type="hidden" name="imgx2" id="imgx2"/>
			<input  type="hidden" name="imgy2" id="imgy2"/>
			<input  type="hidden" name="imgheight" id="imgheight"/>
			<input  type="hidden" name="imgwidth" id="imgwidth"/>
			<?php
				$imgsrc = '';
				$u=Users::model()->with('userDetails')->findByPk(Yii::app()->user->id);
				$fromurl=strstr($u->userDetails->user_details_avatar, '://', true);
				if($fromurl=='http' || $fromurl=='https')
				$imgsrc = $u->userDetails->user_details_avatar; 
				else
				$imgsrc = Yii::app()->baseUrl.'/profiles/'.$u->userDetails->user_details_avatar;
			?>
			<div class="portlet-body edit">
			<div class="row">
				<div class="col-md-8">
				<div class="usepic boxshadown">	<!--Image Gets Display Here -->			
					<div class="main-img-user">
						<img class="img-responsive display-image" alt="" src="<?php echo $imgsrc;?>">
						<!-- div with class 'cropper-container' gets append here -->
						<div class="mask">
						<span class="btn white fileinput-button"><span>Upload an Image</span> 
						<input type="file" name="files[]" onchange="readURL(this);" id="fileupload"/></span>
						</div>					
					</div>
				</div>
				</div>
				<div class="col-md-4 tag">
				<div class="form-group">
				<div class="checkbox-list">
				<label>
				<input type="checkbox" name="changeProfile">
				select as profile picture</label>
				</div>
				</div>
				<h3>hashtags</h3>
				<div class="divider"></div>
				<div class="form-group">
				<div class="nopaddleft nopaddright">
					<div class="input-group">
					<input  type="hidden" id="all-tags" name="alltags"/>
					<input name="tags" type="text" id="hash-tags" class="form-control text-italic">
					<span class="input-group-btn">
					<button class="btn green flat" type="button" id="hash-tags-submit"><i class="icon-plus-sign"></i></button>
					</span> </div>
					<div class="tagcloud getTags"></div><!-- <a href="#" class="novato"><i class="icon-remove-sign"></i>Gucci</a>-->
				</div>
				</div>
				</div>
			</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 tag">
					<div class="modal-footer">
					<!-- <button type="button" class="btn cyan" id="addnewalbum" >New Album</button>-->
					<button type="submit" class="btn cyan" id="formsubmit">Save</button>
					<button type="button" class="btn cyan"  data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 tag">
				<div class="progress">
				<div class="bar"></div>
				<div class="percent">0%</div>
				</div>
				<div id="status" class="upload-status"></div>
				</div>
			</div>
		<!--part2-->
		</form>
	</div>
</div>
<!--end modal add image-->    
     

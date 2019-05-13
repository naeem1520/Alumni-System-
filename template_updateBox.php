<div  id="updateBoxBlock" data-step="1" data-intro="You can upload status." >
<div class="panel panel-default share borderRound" id="updateGrid">
<div class="panel-heading panel-heading-gray title borderRoundTop">
<span class="boxName">What's Up</span> <span class="sessionName"></span>? 
</div>
<div class="panel-body ">
<textarea name="status" class="form-control share-text placeUpdate" id="statusText" rows="1" placeholder="Write your status..."></textarea>
</div>
<div class="panel-footer share-buttons borderRoundBottom">
<a href="javascript:void(0);" class="updateControl" id="photo"  original-title="Upload Image"><span class="commonPhotos">Photos</span></a>
<a href="javascript:void(0);" class="updateControl"  id="webcamButton" title="Webcam Snap"><span class="boxWebcam">Webcam</span></a>
<a href="javascript:void(0);" class="updateControl"  id="geo" title="Geo Location"><span class="boxLocation">Location</span></a> 

<span class="pull-right">
<!--
<input type="submit" value=" Update " id="updateButton" class="update_button wallbutton update_box">
-->
<span id="updateButton" class="update_button wallbutton update_box"><i class="fa fa-paper-plane"></i> <span class="buttonUpdate">Update</span></span>
</span>


</div>
<div class="padding10 blockControl displaynone" id="photoContainer">

<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo API_BASE_URL ?>api/feedImageUpload">
	<div id="preview" class="marginbottom10">
	</div>
	<div id="imageloadstatus" class="displaynone marginbottom10">
	<img src="<?php echo BASE_URL; ?>wall_icons/ajaxloader.gif" class="icon"> Uploading please wait ....
	</div>
	<div id="imageloadbutton">
	<span id="addphoto">Add Photos:</span> <input type="file" name="photos[]" id="photoimg" multiple="true">
	</div>
	<input type="hidden" id="uploadvalues">
	<input type="hidden" id="upload_uid"  value="<?php echo $sessionUid;?>" name="update_uid">
	<input type="hidden" id="upload_token"   value="<?php echo $sessionToken;?>" name="update_token">
	<input type="hidden" id="group_id" value="<?php echo $groupID; ?>" name="group_id">
</form>

</div>


<div class=" blockControl displaynone" id="geoContainer">
<input type='hidden' id='latitude' value=''/><input type='hidden' id='longitude' value=''/>
<div id="geoContainerDiv"></div>
</div>


<div class="padding10 blockControl displaynone" id="webcamContainer">
<div>
<div id="webcam">
</div>
<div id="webcam_preview"></div>
</div>
<div id='webcam_status' style="clear:both" ></div>
<div id='webcam_takesnap'>
<input type="button" value=" Take Snap " id="takeSnap" class="camclick  wallbutton"/>
<input type="hidden" id="webcam_count" />
</div>
</div>

</div>
</div>
<?php 
$messages=1;
?>
<div id="content">
<div class="container-fluid">
<?php 
include 'template_successError.php';
?>
<div class="media messages-container">
<div class="messages-list pull-left height500"  rel="1" id="cList"  data-scrollable  >
<div class="panel panel-default "  id="cListScroll">
<ul class="list-group" id="conversationsList">
<!-- Conversation List -->
</ul>
</div>
</div>

<div class="media-body">
<div id="conversationHead" class="msgConversation">No conversation selected.</div>
<div id="conversationReplies" rel="0" class="height500" data-scrollable>

<!-- Converstion Replies-->
<?php if(empty($_GET['message_username'])) { ?>
<div class="noDataMessage"></div>
<?php } ?>

</div>


<?php if(!empty($_GET['message_username'])) { ?>


<div  id="conversationBox" >
<div >
<div class="panel panel-default noPadding">
<div >
<textarea name="status" class="form-control share-text" rows="2" placeholder="Send your message..." id="conversationReply"></textarea></div>
<div class="panel-footer share-buttons">
<a href="javascript:void(0);" class="updateControl" id="photo"  original-title="Upload Image"><span class="commonPhotos">Photos</span></a>
<a href="javascript:void(0);" class="updateControl"  id="geo" title="Geo Location"><span class="boxLocation">Location</span></a> 
<span class="pull-right">
<span id="conversationReplyButton" class="update_button wallbutton update_box"><i class="fa fa-paper-plane"></i>Send </span>
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
<span id="addphoto">Add Photo:</span> <input type="file" name="photos[]" id="photoimg" multiple="true"/>
</div>
<input type="hidden" id="uploadvalues"/>
<input type="hidden" id="upload_uid" value="<?php echo $sessionUid;?>" name="update_uid"/>
<input type="hidden" id="upload_Token" value="<?php echo $sessionToken;?>" name="update_token"/>
<input type="hidden"  value="1" name="conversationImage"/>
</form>
</div>

<div class=" blockControl displaynone" id="geoContainer">
<input type='hidden' id='latitude' value=''/><input type='hidden' id='longitude' value=''/>
<div id="geoContainerDiv"></div>

</div>
</div>
</div>
<?php } ?>			
</div>
</div>
</div>

</div>
<?php
if($public_username || $_GET['groupID']) 
{
$groupID=$_GET['groupID'];
?>
<div class="cover overlay" id="cover">
<?php if($public_username == $sessionUsername || $groupID) { ?>
<form id="bgimageform" method="post" enctype="multipart/form-data" action="<?php echo API_BASE_URL; ?>api/profileImageUpload">
<div class="uploadFile timelineUploadBG">
<input type="file" name="photoimg" id="bgphotoimg" class=" custom-file-input" original-title="Change Cover Picture">
</div>
<input type="hidden" name="groupID" value="<?php echo $groupID ?>">
<input type="hidden" name="imageType" value="0">
<input type="hidden" name="uid" value="<?php echo $sessionUid;?>" >
<input type="hidden" name="user_token" value="<?php echo $sessionToken ?>">
</form>
<?php } ?>
<div id="coverBox">
	
</div>
</div>
<?php 
include_once('template_navbar.php'); 
} 
?>
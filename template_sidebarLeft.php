 <div class="sidebar left hidden-xs" id="profileSidebar" >
        <div id="toggleSideBar" data-scrollable>
            <div class="sidebar-block">
                <div class="profile">
<!--
<div id="timelineProfilePic">


</div>-->
<div  id="timelineProfilePic">

<?php 

if($public_username) { 

$username=$public_username ;
//$public_username=$_GET['username'] ;
}


if($sessionUid && $sessionUsername==$public_username) { ?>
<form id="profileimageform" method="post" enctype="multipart/form-data" action="<?php echo API_BASE_URL; ?>api/profileImageUpload">
<div class="uploadFile timelineUploadImg">
<input type="file" name="photoimg" id="profilephotoimg" class=" custom-file-input " original-title="Upload Profile Picture">
</div>
<input type="hidden" name="groupID" value="<?php echo $groupID ?>">
<input type="hidden" name="imageType" value="1">
<input type="hidden" name="uid" value="<?php echo $sessionUid ?>">
<input type="hidden" name="user_token" value="<?php echo $sessionToken ?>">
<input type="hidden" id="sidebarFocus" value="" />
</form>
<?php } ?>


<div id="profilePicImage" data-step="4" data-intro="Upload a profile picture.">
<img src="" alt="people" class="profilePic"  />
</div>
</div>

                   
                    <h4 id="fullName"></h4> <h4 class="idSettings"></h4>
                </div>
            </div>
            <div class="sidebar-block" id="aboutProfileBlock">
               <div class="category commonAbout">Current Workplace</div>
                <ul class="list-about" >
                    <li id="aboutMe" class="feedContent"></li>
                </ul>
                
                 <div class="category commonAbout">Current Adress</div>
                <ul class="list-about" >
                    <li id="instagramButton" class="feedContent"></li>
                </ul>
                 <div class="category commonAbout">Contact No.</div>
                <ul class="list-about" >
                    <li id="googleButton" class="feedContent"></li>
                </ul>
                <div class="category commonAbout">Gender</div>
                <ul class="list-about" >
                    <li id="gender" class="feedContent"></li>
                </ul>
                
                 <div class="category commonAbout">About Me</div>
                <ul class="list-about" >
                    <li id="twitterButton" class="feedContent"></li>
                </ul>




                <!-- <div class="category commonAbout">Current WorkPlace</div>
                <ul class="list-about" >
                    <li id="showwork" class="feedContent"></li>
                </ul> -->
            </div>

<?php
/*
include_once 'template_block_friends.php';
include_once 'template_block_recentViews.php';
include_once 'template_block_groups.php';
*/
$templateData=templateOrderData();

foreach($templateData as $data)
{
include_once $data['t_file'];
}

?>
		

         
			
        </div>
    </div>
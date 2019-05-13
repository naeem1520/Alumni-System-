 <div class="sidebar left hidden-xs" id="profileSidebar">
        <div data-scrollable>
            <div class="sidebar-block">
                <div class="profile">

<div  id="timelineProfilePic">

<?php  if($_GET['groupID']) {
$groupID=$_GET['groupID'];
 ?>
<form id="profileimageform" method="post" enctype="multipart/form-data" action="<?php echo API_BASE_URL; ?>api/profileImageUpload">
<div class="uploadFile timelineUploadImg">
<input type="file" name="photoimg" id="profilephotoimg" class=" custom-file-input " original-title="Upload Profile Picture">
</div>
<input type="hidden" name="groupID" id="groupID" value="<?php echo $groupID ?>" >
<input type="hidden" name="imageType" value="1">
<input type="hidden" name="uid" value="<?php echo $sessionUid ?>">
<input type="hidden" name="user_token" value="<?php echo $sessionToken ?>">
</form>
<?php } ?>


<div id="profilePicImage">
<img src="" alt="people" class="groupPic profilePic"  />
</div>
</div>

                    <h4 id="groupName"></h4>
                   
                </div>
            </div>
            <div class="sidebar-block" id="aboutGroupBlock">
                <div class="category commonAbout">About</div>
                <ul class="list-about" >
                    <li><span id="groupDesc" class="feedContent"></span></li>
                    
                </ul>
            </div>
            <div class="sidebar-block" id="friendsProfileBlock">
                <div class="category">Members</div>
                <div class="sidebar-photos" id="friendsProfileBlock_child">
                    <ul id="userGroupMembersList" class='peopleList'>
                        
                        
                    </ul>
                    
                    <a href="<?php echo BASE_URL.'group/'.$_GET['groupID'].'/members';?>" class="btn btn-primary btn-xs">view all</a>
                </div>
            </div>
			 
			
        </div>
    </div>
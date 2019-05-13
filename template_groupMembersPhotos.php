<?php 
$home = 1; 
$groupID=$_GET['groupID'];
$track=$_GET['track'] ;

$url=BASE_URL.'404.php';
if(empty($groupID) && empty($track))
{
exit(header("location:$url"));
}

if($track!="members" && $track!="photos" )
{
exit(header("location:$url"));
}
?>
<div id="content">
<div class="container-fluid">
<?php 
include_once 'template_successError.php';
include_once 'template_profileBackground.php'; ?>
<?php
if($track=="members")
{
echo "<h3 class='commonMembers'>Members</h3>";
}
else
{
echo "<h3 class='commonPhotos'>Photos</h3>";
}
?>

<div class="timelineFriend"  id="membersPhotosList">
<!-- Members Photos List -->	
</div>
<div id="noRecords"></div>


</div>
</div>
<?php 
/* JavaScript Check */
$home = 1; 
?>
<div id="content">
<div class="container-fluid">

<?php 
include 'template_successError.php';
/* Group Profile */
if($_GET['groupID']) { 
	
$groupID=$_GET['groupID'] ;
if(empty($groupID))
{
$url=BASE_URL.'404.php';
exit(header("location:$url"));
}
}
/* User Profile */
if($public_username) { 

//$username=$_GET['username'] ;
//$public_username=$_GET['username'] ;
if(empty($public_username))
{
$url=BASE_URL.'404.php';
exit(header("location:$url"));
}
}

include_once 'template_successError.php';

include_once 'template_profileBackground.php';
?>
<div class="timeline row" id="updateBox" >

<?php 
if($username == $sessionUsername)
{
include 'template_updateBox.php'; 
}
?>   
</div>

<div class="timeline row scrollMore" id="newsFeed" rel="1">


</div>
<div class="load displaynone"><img src="<?php echo BASE_URL; ?>wall_icons/loadBars.gif"/></div>
<?php 

if(empty($_GET['public_username'])) { 
	?>
<div id="welcomeGrid" class="displaynone">
<h3>Welcome to The Wall Script, <span class="sessionName"></span></h3>
<h4 class="normalFont">Here are some verified people you might enjoy following</h4>
</div>
<div class="timeline row " id="welcomeFriends"  data-step="7" data-intro="Follow verified people." >
</div>
<?php } ?>

<div id="noRecords"></div>



</div>
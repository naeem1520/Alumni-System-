<?php 
$photos=1;
//$public_username=$_GET['username'] ;
$photos_of=$_GET['photos_of'] ; /*photos of yours */

$username=$public_username;
if(empty($public_username))
{
$url=BASE_URL.'404.php';
exit(header("location:$url"));
}
?>

<div id="content">

<div class="container-fluid">
<?php 
include_once 'template_successError.php';

include_once 'template_profileBackground.php'; ?>
<h3 class="commonPhotos photosTitle">Photos</h3>
<div>
<?php 
$pName="";
$pYou="";
if($sessionUsername == $username)
{
$pName="Yours";
$pYou="Your";
}
else
{
$pName=ucfirst($username);
$pYou= ucfirst($username);
}

$active="";
$active_of='';
if($photos_of)
{
$active_of='<i class="fa fa-arrow-circle-o-down"></i>';
}
else
{
$active='<i class="fa fa-arrow-circle-o-down"></i>';

}



?>

<a href="<?php echo BASE_URL.'photos/'.$username; ?>" class="links yourPhotos">Photos of <?php echo $pName; ?></a> <?php echo $active; ?> 
<a href="<?php echo BASE_URL.'photos_of/'.$username; ?>" class="links marginLeft photosOfYours"><?php echo $pYou; ?> Profile Photos</a> <?php echo $active_of; ?>
</div>
<div class="timelineFriend scrollMore"  id="photosList" rel="1">


</div>
<div id="noRecords"></div>


</div>


</div>
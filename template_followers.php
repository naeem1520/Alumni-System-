<?php 
$followers=1;
//$public_username=$getUsername;
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

<h3 class="commonFollowers">Followers</h3>
<div class="timelineFriend scrollMore"  id="friendsList" rel="1">


</div>
<div id="noRecords"></div>
</div>


</div>
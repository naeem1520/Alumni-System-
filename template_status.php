<?php 
$status=1;
$msgID=$_GET['msgID'] ;

if(empty($msgID))
{
$url=BASE_URL.'404.php';
exit(header("location:$url"));
}
?>

<div id="content">

<div class="container-fluid">
<?php 
include_once 'template_successError.php';

//include_once 'template_profileBackground.php'; ?>


<div class="timelineFriend"  id="newsFeed">


</div>
</div>


</div>
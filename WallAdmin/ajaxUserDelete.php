 <?php
include_once 'includes.php';
if(isSet($_POST['uid']))
{
$a_uid=$_POST['uid'];
$data=$WallAdmin->User_Delete($a_uid);
echo $data;
}
?>

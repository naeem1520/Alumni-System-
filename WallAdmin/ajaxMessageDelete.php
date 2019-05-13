 <?php
include_once 'includes.php';
if(isSet($_POST['msg_id']))
{
$a_msg_id=$_POST['msg_id'];
$data=$WallAdmin->Message_Delete($a_msg_id);
//echo true;
}
?>

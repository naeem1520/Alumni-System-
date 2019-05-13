 <?php
include_once 'includes.php';
if(isSet($_POST['group_id']))
{
$group_id=$_POST['group_id'];
$data=$WallAdmin->Group_Delete($group_id);
echo $data;
}
?>

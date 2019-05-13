 <?php
include_once 'includes.php';
if(isSet($_POST['group_id']))
{
$group_id=$_POST['group_id'];
$type=$_POST['type'];
$data=$WallAdmin->Group_Block($group_id,$type);
echo $data;
}
?>

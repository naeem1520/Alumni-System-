 <?php
include_once 'includes.php';

if(isSet($_POST['com_id']))
{
$a_com_id=$_POST['com_id'];
$data=$WallAdmin->Comment_Delete($a_com_id);
echo $data;
}
?>

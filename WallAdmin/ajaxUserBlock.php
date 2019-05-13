 <?php
 include_once 'includes.php';

if(isSet($_POST['uid']))
{
$a_uid=$_POST['uid'];
$a_type=$_POST['type'];

$data=$WallAdmin->User_Block($a_uid,$a_type);

echo $data;

}

?>

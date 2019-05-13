<?php
//Srinivas Tamada http://9lessons.info
include_once 'includes.php';
if(isSet($_POST['pid']))
{
$pid=$_POST['pid'];
$data=$WallAdmin->Delete_Image($pid,$upload_path);
echo $data;
}
?>


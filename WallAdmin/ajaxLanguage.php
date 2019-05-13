 <?php
include_once 'includes.php';
if(strlen($_POST['live'])>0)
{
$live=$_POST['live'];
$data=$WallAdmin->Language($live);
echo $data;

}
?>

 <?php
include_once 'includes.php';
if(isSet($_POST['aid']))
{
$aid=$_POST['aid'];
$data=$WallAdmin->Advertisment_Delete($aid);
if($data)
{
echo $aid;	
}
}
?>

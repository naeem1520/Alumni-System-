 <?php
include_once 'includes.php';
if($_POST['item'])
{
foreach($_POST['item'] as $grid_order=>$grid_id)
{
$id=$grid_order+1;
$data=$WallAdmin->Template($id,$grid_id);
echo $data;
}
}
?>

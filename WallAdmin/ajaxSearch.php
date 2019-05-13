 <?php
include_once 'includes.php';
if(isSet($_POST['searchKey']))
{
$searchKey=$_POST['searchKey'];
$rel=$_POST['rel'];

if($rel=="user")
{
	$data=$WallAdmin->Users_Details_Search($searchKey);
}
else if($rel=="blocked_user")
{
	$data=$WallAdmin->Blocked_Users_Details_Search($searchKey);
}
else if($rel=="verifiedUsers")
{
	$data=$WallAdmin->Verified_Users_Details_Search($searchKey);
}
else if($rel=="updates")
{
	$data=$WallAdmin->Updates_Details_Search($searchKey);
}
else if($rel=="comment")
{
	$data=$WallAdmin->Comments_Details_Search($searchKey);
}
else if($rel=="group")
{
	$data=$WallAdmin->Groups_Details_Search($searchKey);
}
else if($rel =='blockGroup')
{
	$data=$WallAdmin->BlockGroups_Details_Search($searchKey);
}
echo $data;
}
?>

 <?php
if(!empty($_SESSION['admin_id']))
{
$session_admin_uid=$_SESSION['admin_id'];
}
// Session Private

if(empty($session_admin_uid))
{
$url=$admin_base_url.'index.php';
header("Location: $url");
}


?>

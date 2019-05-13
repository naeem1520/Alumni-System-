 <?php
include_once '../config.php';
$session_admin_uid='';
$_SESSION['admin_id']=''; 
if(empty($session_admin_uid) && empty($_SESSION['admin_id']))
{
$url=$admin_base_url.'index.php';
header("Location: $url");
//echo "<script>window.location='$url'</script>";
}
?>

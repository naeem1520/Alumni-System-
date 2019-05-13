 <?php
require 'config.php';
$_SESSION['uid']='';
$_SESSION['token']='';
$userData='';
if(session_destroy())
{
$url=$base_url.'login.php';
header("Location: $url");
//echo "<script>window.location='$url'</script>";
}
?>
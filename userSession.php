 <?php
$sessionUid=$_SESSION['uid']; 
$sessionToken=$_SESSION['token']; 
$sessionUsername=$_SESSION['username']; 
$username=$_SESSION['username']; 
$sessionName=$_SESSION['name']; 
$sessionPic=$_SESSION['pic']; 
// Session Private
$public_username='';
if($_GET['public_username'] || $_GET['msgID'])
{
$public_username=$_GET['public_username']; 
$username=$_GET['public_username']; 
}
else if(empty($sessionUid))
{
$url=$base_url.'login.php';
header("location:$url");
}

if($_GET['username'])
{
$public_username=$_GET['username']; 
$username=$_GET['username']; 
}
?>

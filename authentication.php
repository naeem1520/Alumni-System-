<?php
include_once 'config.php';
if($_GET['token'] && $_GET['uid'] && $_GET['notification_created'])
{
$serverKey=md5(SITE_KEY.$_GET['uid']);
if($serverKey==$_GET['token'])
{
$_SESSION['uid']=$_GET['uid'];
$_SESSION['token']=$_GET['token'];
$_SESSION['username']=$_GET['username'];
$_SESSION['name']=$_GET['name'];
$_SESSION['pic']=$_GET['pic'];
$_SESSION['tour']=$_GET['tour'];

$_SESSION['newsfeedPerPage']=$_GET['newsfeedPerPage'];
$_SESSION['friendsPerPage']=$_GET['friendsPerPage'];
$_SESSION['photosPerPage']=$_GET['photosPerPage'];
$_SESSION['groupsPerPage']=$_GET['groupsPerPage'];
$_SESSION['notificationPerPage']=$_GET['notificationPerPage'];
$_SESSION['friendsWidgetPerPage']=$_GET['friendsWidgetPerPage'];
$_SESSION['language_labels']=$_GET['language_labels'];


$url=BASE_URL.'index.php';
header("location:$url");
}
}
else
{
$url=BASE_URL.'login.php';
header("location:$url");
}

?>
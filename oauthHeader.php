<?php
ob_start("ob_gzhandler");
require 'config.php';
include 'oauth/oauthLogin.php';
$OauthLogin = new oauthLogin();
/*
include 'includes/Wall_Updates.php';
$Wall = new Wall_Updates($db);
include 'OauthLogin.php';
$OauthLogin = new OauthLogin($db);
$userSession=$_SESSION['userSession'];
*/

?>
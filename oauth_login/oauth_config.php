<?php
/*
* OAuth Login Configurations
* Srinivas Tamada www.9lessons.info www.thewallscript.com www.oauthlogin.com
*/

$index=BASE_URL.'login.php'; //redirect to login page or First Page
$home=BASE_URL.'index.php';  //your login page welcome.php 

//Facebook
define('Facebook_App_ID', 'Your_Facebook_App_Id');
define('Facebook_App_Secret', 'Your_Facebook_App_Secret');
define('Facebook_Version', '2.8');

//Google
define('Google_Client_ID', 'Your_Google_Client_ID');
define('Google_Client_Secret', 'Your_Google_Client_ID');
define('Google_Version', '1');

//Microsoft
define('Microsoft_Client_ID', 'Your_Microsoft_Client_ID');
define('Microsoft_Client_Secret', 'Your_Microsoft_Client_Secret');
define('Microsoft_Version', '5.0');

//Github
define('Github_Client_ID', 'Your_Github_Client_ID');
define('Github_Client_Secret', 'Your_Github_Client_Secret');


//LinkedIn
define('LinkedIn_Client_ID', 'Your_LinkedIn_Client_ID');
define('LinkedIn_Client_Secret', 'Your_LinkedIn_Client_Secret');
define('LinkedIn_Version', '1');


require('oauthLogin.php');
$oauthLogin = new oauthLogin();
?>
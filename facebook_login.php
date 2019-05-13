<?php
include 'oauthHeader.php';
require 'oauth/facebook_lib/facebook.php';
require 'oauth/facebook_lib/config.php';

// Connection...
$user = $facebook->getUser();
if ($user)
{
$logoutUrl = $facebook->getLogoutUrl();
try {
$userData = $facebook->api('/me');
} catch (FacebookApiException $e) {

$user = null;
}
/* Login success redirection */
$data=$OauthLogin->userSignup($userData,'facebook');
include 'oauth/oauthRedirection.php';

	
}
else
{
$loginUrl = $facebook->getLoginUrl(array( 'scope' => $facebook_scope));
header("Location:$loginUrl");
}
?>

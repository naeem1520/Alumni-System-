<?php
include 'oauthHeader.php';
require_once 'oauth/google_lib/apiClient.php';
require_once 'oauth/google_lib/contrib/apiOauth2Service.php';

$client = new apiClient();
$client->setApplicationName("Google Account Login");

$oauth2 = new apiOauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  unset($_SESSION['google_data']); //Google session data unset
  $client->revokeToken();
}


if ($client->getAccessToken()) {
  $userData = $oauth2->userinfo->get();
  /* Login success redirection */
  $data=$OauthLogin->userSignup($userData,'google');
  include 'oauth/oauthRedirection.php';
  
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
}
?>

<?php if(isset($personMarkup)): ?>
<?php print $personMarkup ?>
<?php endif ?>
<?php
  if(isset($authUrl)) {
header("Location:$authUrl");
  } 
?>

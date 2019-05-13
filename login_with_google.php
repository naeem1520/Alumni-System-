<?php
require('config.php');
require('oauth_login/oauth_lib/http.php');
require('oauth_login/oauth_lib/oauth_client.php');

$client = new oauth_client_class;
$client->server = 'Google';
$client->offline = true;
$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = BASE_URL.'login_with_google.php';

$client->client_id = Google_Client_ID;
$application_line = __LINE__;
$client->client_secret = Google_Client_Secret;

if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0){
    die('Please go to Google APIs console page '.
    'http://code.google.com/apis/console in the API access tab, '.
    'create a new client ID and client Secret keys');
}


/* API permissions
*/
$client->scope = 'https://www.googleapis.com/auth/userinfo.email '.
'https://www.googleapis.com/auth/userinfo.profile';
if(($success = $client->Initialize()))
{
    if(($success = $client->Process()))
    {
        if(strlen($client->authorization_error))
        {
            $client->error = $client->authorization_error;
            $success = false;
        }
        elseif(strlen($client->access_token))
        {
            $success = $client->CallAPI(
            'https://www.googleapis.com/oauth2/v'.Google_Version.'/userinfo',
            'GET', array(), array('FailOnAccessError'=>true), $user);
        }
    }
    $success = $client->Finalize($success);
}
if($client->exit)
exit;
if($success)
{
    $data=$oauthLogin->userSignup($user,'google');
    require 'oauth_login/oauth_redirect.php';
}
else
{
    
    header("Location: $index");
    //echo "<script>window.location.href='".$index."'</script>";
    
}

?>
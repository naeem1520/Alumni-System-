<?php
require('config.php');
require('oauth_login/oauth_lib/http.php');
require('oauth_login/oauth_lib/oauth_client.php');

$client = new oauth_client_class;
$client->server = 'Microsoft';
$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = BASE_URL.'login_with_microsoft.php';

$client->client_id = Microsoft_Client_ID;
$application_line = __LINE__;
$client->client_secret = Microsoft_Client_Secret;

if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0){
    die('Please go to Microsoft Live Connect Developer Center page '.
    'https://manage.dev.live.com/AddApplication.aspx and create a new client ID and client Secret');
}


/* API permissions
*/
$client->scope = 'wl.basic wl.emails wl.birthday';
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
            'https://apis.live.net/v'.Microsoft_Version.'/me',
            'GET', array(), array('FailOnAccessError'=>true), $user);
        }
    }
    $success = $client->Finalize($success);
}
if($client->exit)
exit;
if($success)
{
    $data=$oauthLogin->userSignup($user,'microsoft');
    require 'oauth_login/oauth_redirect.php';
}
else
{
    header("Location: $index");
    //echo "<script>window.location.href='".$index."'</script>";
}

?>
<?php
require('config.php');
require('oauth_login/oauth_lib/http.php');
require('oauth_login/oauth_lib/oauth_client.php');

$client = new oauth_client_class;
$client->debug = false;
$client->debug_http = true;
$client->server = 'github';
$client->redirect_uri = BASE_URL.'login_with_github.php';

$client->client_id = Github_Client_ID;
$application_line = __LINE__;
$client->client_secret = Github_Client_Secret;

if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0){
    die('Please go to github applications page '.
    'https://github.com/settings/applications/new in the API access tab, '.
    'create a new client IDClient ID and client_secret');
}


/* API permissions
*/
$client->scope = 'user:email';
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
            'https://api.github.com/user',
            'GET', array(), array('FailOnAccessError'=>true), $user);
        }
    }
    $success = $client->Finalize($success);
}
if($client->exit)
exit;
if($success)
{
    
    $data=$oauthLogin->userSignup($user,'github');
    require 'oauth_login/oauth_redirect.php';
}
else
{
    header("Location: $index");
    //echo "<script>window.location.href='".$index."'</script>";
    
}

?>
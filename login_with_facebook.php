<?php
require('config.php');
require('oauth_login/oauth_lib/http.php');
require('oauth_login/oauth_lib/oauth_client.php');

$client = new oauth_client_class;
$client->debug = false;
$client->debug_http = true;
$client->server = 'Facebook';
$client->redirect_uri = BASE_URL.'login_with_facebook.php';

$client->client_id = Facebook_App_ID;
$application_line = __LINE__;
$client->client_secret = Facebook_App_Secret;

if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
{
    die('Please go to Facebook Apps page https://developers.facebook.com/apps , '.
    'create an application set the client_id to App ID/API Key and client_secret with App Secret');
}


/* The initial page to redirect is not set;
*/
$redirect_url = null;

/* API permissions
*/
$client->scope = 'email';
if(($success = $client->Initialize()))
{
    if(($success = $client->CheckAccessToken($redirect_url)))
    {
        if(IsSet($redirect_url))
        {
            
            echo "Token Expire";
        }
        elseif(strlen($client->access_token))
        {
            $success = $client->CallAPI(
            'https://graph.facebook.com/v'.Facebook_Version.'/me?fields=id,first_name,gender,last_name,link,locale,name,timezone,updated_time,verified,email',
            'GET', array(), array('FailOnAccessError'=>true), $user);
        }
    }
    $success = $client->Finalize($success);
}
if($success)
{
    
    if(IsSet($redirect_url))
    {
        header("Location:$redirect_url");
    }
    else
    {
        
        $data=$oauthLogin->userSignup($user,'facebook');
        require 'oauth_login/oauth_redirect.php';
    }
    
}
else
{
    header("Location: $index");
    //echo "<script>window.location.href='".$index."'</script>";
    
}

?>
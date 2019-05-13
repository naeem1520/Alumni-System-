<?php
 
    include 'oauthHeader.php';
	require('oauth/microsoft_lib/http.php');
	require('oauth/microsoft_lib/oauth_client.php');
	require('oauth/microsoft_lib/config.php');
    
	$client = new oauth_client_class;
	$client->server = 'Microsoft';
	$client->redirect_uri = $microsoft_redirect_url;


	$client->client_id = $microsoft_client_id; $application_line = __LINE__;
	$client->client_secret = $microsoft_client_secret;

	if(strlen($client->client_id) == 0
	|| strlen($client->client_secret) == 0)
		die('Please go to Microsoft Live Connect Developer Center page '.
			'https://manage.dev.live.com/AddApplication.aspx and create a new'.
			'application, and in the line '.$application_line.
			' set the client_id to Client ID and client_secret with Client secret. '.
			'The callback URL must be '.$client->redirect_uri.' but make sure '.
			'the domain is valid and can be resolved by a public DNS.');

	/* API permissions
	 */
	$client->scope = $microsoft_scope;
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
					'https://apis.live.net/v5.0/me',
					'GET', array(), array('FailOnAccessError'=>true), $user);
			}
		}
		$success = $client->Finalize($success);
	}
	if($client->exit)
		exit;
	if($success)
	{
	    $userData=$user;
        /* Login success redirection */
		$data=$OauthLogin->userSignup($userData,'microsoft');
		include 'oauth/oauthRedirection.php';
	
	}
	else
	{
      echo 'Error:'.HtmlSpecialChars($client->error); 
	}

?>
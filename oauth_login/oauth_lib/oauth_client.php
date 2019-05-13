<?php
/*
 * oauth_client.php
 *
 * @(#) $Id: oauth_client.php,v 1.152 2016/10/14 23:14:49 mlemos Exp $
 *
 */

class oauth_session_value_class
{
	var $id;
	var $session;
	var $state;
	var $access_token;
	var $access_token_secret;
	var $authorized;
	var $expiry;
	var $type;
	var $server;
	var $creation;
	var $refresh_token;
	var $access_token_response;
};



class oauth_client_class
{

	var $error = '';

	var $debug = false;


	var $debug_http = false;


	var $log_file_name = '';


	var $exit = false;

	var $debug_output = '';


	var $debug_prefix = 'OAuth client: ';


	var $server = '';

	var $configuration_file = 'oauth_configuration.json';


	var $request_token_url = '';


	var $dialog_url = '';


	var $reauthenticate_dialog_url = '';


	var $pin_dialog_url = '';


	var $offline_dialog_url = '';


	var $pin = '';


	var $append_state_to_redirect_uri = '';


	var $access_token_url = '';



	var $oauth_version = '2.0';


	var $url_parameters = false;


	var $authorization_header = true;


	var $token_request_method = 'GET';


	var $signature_method = 'HMAC-SHA1';


	var $redirect_uri = '';


	var $client_id = '';


	var $client_secret = '';


	var $api_key = '';


	var $get_token_with_api_key = false;

/*
{metadocument}
	<variable>
		<name>scope</name>
		<type>STRING</type>
		<value></value>
		<documentation>
			<purpose>Permissions that your application needs to call the OAuth
				server APIs</purpose>
			<usage>Check the documentation of the APIs that your application
				needs to call to set this variable with the identifiers of the
				permissions that the user needs to grant to your application.</usage>
		</documentation>
	</variable>
{/metadocument}
*/
	var $scope = '';

/*
{metadocument}
	<variable>
		<name>realm</name>
		<type>STRING</type>
		<value></value>
		<documentation>
			<purpose>Realm of authorization for OpenID Connect</purpose>
			<usage>Set this variable to the realm value when using OpenID
				Connect.</usage>
		</documentation>
	</variable>
{/metadocument}
*/
	var $realm = '';

/*
{metadocument}
	<variable>
		<name>offline</name>
		<type>BOOLEAN</type>
		<value>0</value>
		<documentation>
			<purpose>Specify whether it will be necessary to call the API when
				the user is not present and the server supports renewing expired
				access tokens using refresh tokens.</purpose>
			<usage>Set this variable to <booleanvalue>1</booleanvalue> if the
				server supports renewing expired tokens automatically when the
				user is not present.</usage>
		</documentation>
	</variable>
{/metadocument}
*/
	var $offline = false;

/*
{metadocument}
	<variable>
		<name>reauthenticate</name>
		<type>BOOLEAN</type>
		<value>0</value>
		<documentation>
			<purpose>Specify whether it will be necessary to force the user to
				authenticate again even after the user has already authorized the
				application before.</purpose>
			<usage>Set this variable to <booleanvalue>1</booleanvalue> if you
				want to force the user to authenticate again.</usage>
		</documentation>
	</variable>
{/metadocument}
*/
	var $reauthenticate = false;

/*
{metadocument}
	<variable>
		<name>access_token</name>
		<type>STRING</type>
		<value></value>
		<documentation>
			<purpose>Access token obtained from the OAuth server</purpose>
			<usage>Check this variable to get the obtained access token upon
				successful OAuth authorization.</usage>
		</documentation>
	</variable>
{/metadocument}
*/
	var $access_token = '';


	var $access_token_secret = '';

	var $access_token_expiry = '';


	var $access_token_type = '';


	var $default_access_token_type = '';



	var $access_token_parameter = '';



	var $access_token_response;


	var $store_access_token_response = false;


	var $access_token_authentication = '';


	var $refresh_token_authentication = '';


	var $refresh_token = '';


	var $access_token_error = '';


	var $authorization_error = '';


	var $response_status = 0;


	var $response_headers = array();


	var $oauth_username = '';


	var $oauth_password = '';


	var $grant_type = "authorization_code";


	var $http_arguments = array();
	var $oauth_user_agent = 'PHP-OAuth-API (http://www.phpclasses.org/oauth-api $Revision: 1.152 $)';

	var $response_time = 0;
	var $session = '';

	Function SetError($error)
	{
		$this->error = $error;
		if($this->debug)
			$this->OutputDebug('Error: '.$error);
		return(false);
	}

	Function SetPHPError($error, &$php_error_message)
	{
		if(IsSet($php_error_message)
		&& strlen($php_error_message))
			$error.=": ".$php_error_message;
		return($this->SetError($error));
	}

	Function OutputDebug($message)
	{
		if($this->debug)
		{
			$message = $this->debug_prefix.$message;
			$this->debug_output .= $message."\n";
			if(strlen($this->log_file_name))
				error_log($message."\n", 3, $this->log_file_name);
			else
				error_log($message);
		}
		return(true);
	}

	Function SetupSession(&$session)
	{
		if(strlen($this->session)
		|| IsSet($_COOKIE[$this->session_cookie]))
		{
			if($this->debug)
				$this->OutputDebug(strlen($this->session) ? 'Checking OAuth session '.$this->session : 'Checking OAuth session from cookie '.$_COOKIE[$this->session_cookie]);
			if(!$this->GetOAuthSession(strlen($this->session) ? $this->session : $_COOKIE[$this->session_cookie], $this->server, $session))
				return($this->SetError('OAuth session error: '.$this->error));
		}
		else
		{
			if($this->debug)
				$this->OutputDebug('No OAuth session is set');
			$session = null;
		}
		if(!IsSet($session))
		{
			if($this->debug)
				$this->OutputDebug('Creating a new OAuth session');
			if(!$this->CreateOAuthSession($this->server, $session))
				return($this->SetError('OAuth session error: '.$this->error));
			SetCookie($this->session_cookie, $session->session, 0, $this->session_path);
		}
		$this->session = $session->session;
		return true;
	}

	Function InitializeOAuthSession(&$session)
	{
		$session = new oauth_session_value_class;
		$session->state = md5(time().rand());
		$session->session = md5($session->state.time().rand());
		$session->access_token = '';
		$session->access_token_secret = '';
		$session->authorized = null;
		$session->expiry = null;
		$session->type = '';
		$session->server = $this->server;
		$session->creation = gmstrftime("%Y-%m-%d %H:%M:%S");
		$session->refresh_token = '';
		$session->access_token_response = null;
	}

	Function GetRequestTokenURL(&$request_token_url)
	{
		$request_token_url = $this->request_token_url;
		return(true);
	}

	Function GetDialogURL(&$url, $redirect_uri = '', $state = '')
	{
		$url = (($this->offline && strlen($this->offline_dialog_url)) ? $this->offline_dialog_url : (($redirect_uri === 'oob' && strlen($this->pin_dialog_url)) ? $this->pin_dialog_url : ($this->reauthenticate ? $this->reauthenticate_dialog_url : $this->dialog_url)));
		if(strlen($url) === 0)
			return $this->SetError('the dialog URL '.($this->offline ? 'for offline access ' : ($this->reauthenticate ?  'for reautentication' : '')).'is not defined for this server');
		$url = str_replace(
			'{REDIRECT_URI}', UrlEncode($redirect_uri), str_replace(
			'{STATE}', UrlEncode($state), str_replace(
			'{CLIENT_ID}', UrlEncode($this->client_id), str_replace(
			'{API_KEY}', UrlEncode($this->api_key), str_replace(
			'{SCOPE}', UrlEncode($this->scope), str_replace(
			'{REALM}', UrlEncode($this->realm),
			$url))))));
		return(true);
	}

	Function GetAccessTokenURL(&$access_token_url)
	{
		$access_token_url = str_replace('{API_KEY}', $this->api_key, $this->access_token_url);
		return(true);
	}

	Function GetStoredState(&$state)
	{
		if(!function_exists('session_start'))
			return $this->SetError('Session variables are not accessible in this PHP environment');
		if(session_id() === ''
		&& !session_start())
			return($this->SetPHPError('it was not possible to start the PHP session', $php_errormsg));
		if(IsSet($_SESSION['OAUTH_STATE']))
			$state = $_SESSION['OAUTH_STATE'];
		else
			$state = $_SESSION['OAUTH_STATE'] = time().'-'.substr(md5(rand().time()), 0, 6);
		return(true);
	}

	Function GetRequestState(&$state)
	{
		if(IsSet($_GET['error']))
		{
			if($this->debug)
				$this->OutputDebug('it was returned the request state error '.$_GET['error']);
			$state = null;
			return false;
		}
		$check = (strlen($this->append_state_to_redirect_uri) ? $this->append_state_to_redirect_uri : 'state');
		$state = (IsSet($_GET[$check]) ? $_GET[$check] : null);
		return(true);
	}

	Function GetRequestCode(&$code)
	{
		$code = (IsSet($_GET['code']) ? $_GET['code'] : null);
		return(true);
	}

	Function GetRequestError(&$error)
	{
		$error = (IsSet($_GET['error']) ? $_GET['error'] : null);
		return(true);
	}

	Function GetRequestDenied(&$denied)
	{
		$denied = (IsSet($_GET['denied']) ? $_GET['denied'] : null);
		return(true);
	}

	Function GetRequestToken(&$token, &$verifier)
	{
		$token = (IsSet($_GET['oauth_token']) ? $_GET['oauth_token'] : null);
		$verifier = (IsSet($_GET['oauth_verifier']) ? $_GET['oauth_verifier'] : null);
		return(true);
	}

	Function GetRedirectURI(&$redirect_uri)
	{
		if(strlen($this->redirect_uri))
			$redirect_uri = $this->redirect_uri;
		else
			$redirect_uri = (IsSet($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		return true;
	}

	Function Redirect($url)
	{
		Header('HTTP/1.0 302 OAuth Redirection');
		Header('Location: '.$url);
	}

	Function StoreAccessToken($access_token)
	{
		if(!function_exists('session_start'))
			return $this->SetError('Session variables are not accessible in this PHP environment');
		if(session_id() === ''
		&& !session_start())
			return($this->SetPHPError('it was not possible to start the PHP session', $php_errormsg));
		if(!$this->GetAccessTokenURL($access_token_url))
			return false;
		$_SESSION['OAUTH_ACCESS_TOKEN'][$access_token_url] = $access_token;
		return true;
	}

	Function GetAccessToken(&$access_token)
	{
		if(!function_exists('session_start'))
			return $this->SetError('Session variables are not accessible in this PHP environment');
		if(session_id() === ''
		&& !session_start())
			return($this->SetPHPError('it was not possible to start the PHP session', $php_errormsg));
		if(!$this->GetAccessTokenURL($access_token_url))
			return false;
		if(IsSet($_SESSION['OAUTH_ACCESS_TOKEN'][$access_token_url]))
			$access_token = $_SESSION['OAUTH_ACCESS_TOKEN'][$access_token_url];
		else
			$access_token = array();
		return true;
	}

	Function ResetAccessToken()
	{
		if(!$this->GetAccessTokenURL($access_token_url))
			return false;
		if($this->debug)
			$this->OutputDebug('Resetting the access token status for OAuth server located at '.$access_token_url);
		if(!function_exists('session_start'))
			return $this->SetError('Session variables are not accessible in this PHP environment');
		if(session_id() === ''
		&& !session_start())
			return($this->SetPHPError('it was not possible to start the PHP session', $php_errormsg));
		Unset($_SESSION['OAUTH_ACCESS_TOKEN'][$access_token_url]);
		UnSet($_SESSION['OAUTH_STATE']);
		return true;
	}


	Function Encode($value)
	{
		return(is_array($value) ? $this->EncodeArray($value) : str_replace('%7E', '~', str_replace('+',' ', RawURLEncode($value))));
	}

	Function EncodeArray($array)
	{
		foreach($array as $key => $value)
			$array[$key] = $this->Encode($value);
		return $array;
	}

	Function HMAC($function, $data, $key)
	{
		switch($function)
		{
			case 'sha1':
				$pack = 'H40';
				break;
			default:
				if($this->debug)
					$this->OutputDebug($function.' is not a supported an HMAC hash type');
				return('');
		}
		if(strlen($key) > 64)
			$key = pack($pack, $function($key));
		if(strlen($key) < 64)
			$key = str_pad($key, 64, "\0");
		return(pack($pack, $function((str_repeat("\x5c", 64) ^ $key).pack($pack, $function((str_repeat("\x36", 64) ^ $key).$data)))));
	}

	Function Sign(&$url, $method, $parameters, $oauth, $request_content_type, $has_files, $post_values_in_uri, &$authorization, &$post_values)
	{
		$values = array(
			'oauth_consumer_key'=>$this->client_id,
			'oauth_nonce'=>md5(uniqid(rand(), true)),
			'oauth_signature_method'=>$this->signature_method,
			'oauth_timestamp'=>time(),
			'oauth_version'=>'1.0',
		);
		if($has_files)
			$value_parameters = array();
		else
		{
			if(($this->url_parameters
			|| $method !== 'POST')
			&& $request_content_type === 'application/x-www-form-urlencoded'
			&& count($parameters))
			{
				$first = (strpos($url, '?') === false);
				foreach($parameters as $parameter => $value)
				{
					$url .= ($first ? '?' : '&').UrlEncode($parameter).'='.UrlEncode($value);
					$first = false;
				}
				$parameters = array();
			}
			$value_parameters = (($request_content_type !== 'application/x-www-form-urlencoded') ? array() : $parameters);
		}
		$header_values = ($method === 'GET' ? array_merge($values, $oauth, $value_parameters) : array_merge($values, $oauth));
		$values = array_merge($values, $oauth, $value_parameters);
		$key = $this->Encode($this->client_secret).'&'.$this->Encode($this->access_token_secret);
		switch($this->signature_method)
		{
			case 'PLAINTEXT':
				$values['oauth_signature'] = $key;
				break;
			case 'HMAC-SHA1':
				$uri = strtok($url, '?');
				$sign = $method.'&'.$this->Encode($uri).'&';
				$first = true;
				$sign_values = $values;
				$u = parse_url($url);
				if(IsSet($u['query']))
				{
					parse_str($u['query'], $q);
					foreach($q as $parameter => $value)
						$sign_values[$parameter] = $value;
				}
				KSort($sign_values);
				foreach($sign_values as $parameter => $value)
				{
					$sign .= $this->Encode(($first ? '' : '&').$parameter.'='.$this->Encode($value));
					$first = false;
				}
				$header_values['oauth_signature'] = $values['oauth_signature'] = base64_encode($this->HMAC('sha1', $sign, $key));
				break;
			default:
				return $this->SetError($this->signature_method.' signature method is not yet supported');
		}
		if($this->authorization_header)
		{
			$authorization = 'OAuth';
			$first = true;
			foreach($header_values as $parameter => $value)
			{
				$authorization .= ($first ? ' ' : ',').$parameter.'="'.$this->Encode($value).'"';
				$first = false;
			}
			$post_values = $parameters;
		}
		else
		{
			if($method !== 'POST'
			|| $post_values_in_uri)
			{
				$first = (strcspn($url, '?') == strlen($url));
				foreach($values as $parameter => $value)
				{
					$url .= ($first ? '?' : '&').$parameter.'='.$this->Encode($value);
					$first = false;
				}
				$post_values = array();
			}
			else
				$post_values = $values;
		}
		return true;
	}

	Function SendAPIRequest($url, $method, $parameters, $oauth, $options, &$response)
	{
		$this->response_status = 0;
		$http = new http_class;
		$http->debug = ($this->debug && $this->debug_http);
		$http->log_debug = true;
		$http->log_file_name = $this->log_file_name;
		$http->sasl_authenticate = 0;
		$http->user_agent = $this->oauth_user_agent;
		$http->redirection_limit = (IsSet($options['FollowRedirection']) ? intval($options['FollowRedirection']) : 0);
		$http->follow_redirect = ($http->redirection_limit != 0);
		if($this->debug)
			$this->OutputDebug('Accessing the '.$options['Resource'].' at '.$url);
		$post_files = array();
		$method = strtoupper($method);
		$authorization = '';
		$request_content_type = (IsSet($options['RequestContentType']) ? strtolower(trim(strtok($options['RequestContentType'], ';'))) : (($method === 'POST' || IsSet($oauth)) ? 'application/x-www-form-urlencoded' : ''));
		$files = (IsSet($options['Files']) ? $options['Files'] : array());
		if(count($files))
		{
			foreach($files as $name => $value)
			{
				if(!IsSet($parameters[$name]))
					return($this->SetError('it was not specified a file parameter named '.$name));
				$file = array();
				$value_type = IsSet($value['Type']) ? $value['Type'] : 'FileName';
				switch($value_type)
				{
					case 'FileName':
						$file['FileName'] = $parameters[$name];
						if(IsSet($value['FileName']))
							$file['Name'] = $value['FileName'];
						break;
					case 'Data':
						$file['Data'] = $parameters[$name];
						if(!IsSet($value['FileName']))
							return($this->SetError('it was not specified the file name for data file parameter '.$name));
						$file['Name'] = $value['FileName'];
						break;
					default:
						return($this->SetError($value_type.' is not a valid type for file '.$name));
				}
				$file['Content-Type'] = (IsSet($value['ContentType']) ? $value['ContentType'] : 'automatic/name');
				$post_files[$name] = $file;
			}
			UnSet($parameters[$name]);
			if($method !== 'POST')
			{
				$this->OutputDebug('For uploading files the method should be POST not '.$method);
				$method = 'POST';
			}
			if($request_content_type !== 'multipart/form-data')
			{
				if(IsSet($options['RequestContentType']))
					return($this->SetError('the request content type for uploading files should be multipart/form-data'));
				$request_content_type = 'multipart/form-data';
			}
		}
		if(IsSet($oauth))
		{
			if(!$this->Sign($url, $method, $parameters, $oauth, $request_content_type, count($files) !== 0, IsSet($options['PostValuesInURI']) && $options['PostValuesInURI'], $authorization, $post_values))
				return false;
		}
		else
		{
			$post_values = $parameters;
			if(count($parameters))
			{
				switch($request_content_type)
				{
					case 'application/x-www-form-urlencoded':
					case 'multipart/form-data':
					case 'application/json':
					case 'application/javascript':
						break;
					default:
						$first = (strpos($url, '?') === false);
						foreach($parameters as $name => $value)
						{
							if(GetType($value) === 'array')
							{
								foreach($value as $index => $value)
								{
									$url .= ($first ? '?' : '&').$name.'='.UrlEncode($value);
									$first = false;
								}
							}
							else
							{
								$url .= ($first ? '?' : '&').$name.'='.UrlEncode($value);
								$first = false;
							}
						}
				}
			}
		}
		if(strlen($authorization) === 0
		&& !strcasecmp($this->access_token_type, 'Bearer'))
			$authorization = 'Bearer '.$this->access_token;
		if(strlen($error = $http->GetRequestArguments($url, $arguments)))
			return($this->SetError('it was not possible to open the '.$options['Resource'].' URL: '.$error));
		$arguments = array_merge($this->http_arguments, $arguments);
		if(strlen($error = $http->Open($arguments)))
			return($this->SetError('it was not possible to open the '.$options['Resource'].' URL: '.$error));
		if(count($post_files))
			$arguments['PostFiles'] = $post_files;
		$arguments['RequestMethod'] = $method;
		switch($request_content_type)
		{
			case 'application/x-www-form-urlencoded':
			case 'multipart/form-data':
				if(IsSet($options['RequestBody']))
					return($this->SetError('the request body is defined automatically from the parameters'));
				$arguments['PostValues'] = $post_values;
				break;
			case 'application/json':
			case 'application/javascript':
				$arguments['Headers']['Content-Type'] = $options['RequestContentType'];
				$arguments['Body'] = (IsSet($options['RequestBody']) ? $options['RequestBody'] : json_encode($parameters));
				break;
			default:
				if(!IsSet($options['RequestBody']))
				{
					if(IsSet($options['RequestContentType']))
						return($this->SetError('it was not specified the body value of the of the API call request'));
					break;
				}
				$arguments['Headers']['Content-Type'] = $options['RequestContentType'];
				$arguments['Body'] = $options['RequestBody'];
				break;
		}
		$arguments['Headers']['Accept'] = (IsSet($options['Accept']) ? $options['Accept'] : '*/*');
		switch($authentication = (IsSet($options['AccessTokenAuthentication']) ? strtolower($options['AccessTokenAuthentication']) : ''))
		{
			case 'basic':
				$arguments['Headers']['Authorization'] = 'Basic '.base64_encode($this->client_id.':'.($this->get_token_with_api_key ? $this->api_key : $this->client_secret));
				break;
			case '':
				if(strlen($authorization))
					$arguments['Headers']['Authorization'] = $authorization;
				break;
			case 'none':
				break;
			default:
				return($this->SetError($authentication.' is not a supported authentication mechanism to retrieve an access token'));
		}
		if(IsSet($options['RequestHeaders']))
			$arguments['Headers'] = array_merge($arguments['Headers'], $options['RequestHeaders']);
		if(strlen($error = $http->SendRequest($arguments))
		|| strlen($error = $http->ReadReplyHeaders($headers)))
		{
			$http->Close();
			return($this->SetError('it was not possible to retrieve the '.$options['Resource'].': '.$error));
		}
		$error = $http->ReadWholeReplyBody($data);
		$http->Close();
		if(strlen($error))
		{
			return($this->SetError('it was not possible to access the '.$options['Resource'].': '.$error));
		}
		$this->response_status = intval($http->response_status);
		$this->response_headers = $headers;
		$content_type = (IsSet($options['ResponseContentType']) ? $options['ResponseContentType'] : (IsSet($headers['content-type']) ? strtolower(trim(strtok($headers['content-type'], ';'))) : 'unspecified'));
		$content_type = preg_replace('/^(.+\\/).+\\+(.+)$/', '\\1\\2', $content_type);
		$this->response_time = (IsSet($headers['date']) ? strtotime(GetType($headers['date']) === 'array' ? $headers['date'][0] : $headers['date']) : time());
		switch($content_type)
		{
			case 'text/javascript':
			case 'application/json':
			case 'application/javascript':
				if(!function_exists('json_decode'))
					return($this->SetError('the JSON extension is not available in this PHP setup'));
				$object = json_decode($data);
				switch(GetType($object))
				{
					case 'object':
						if(!IsSet($options['ConvertObjects'])
						|| !$options['ConvertObjects'])
							$response = $object;
						else
						{
							$response = array();
							foreach($object as $property => $value)
								$response[$property] = $value;
						}
						break;
					case 'array':
						$response = $object;
						break;
					default:
						if(!IsSet($object))
							return($this->SetError('it was not returned a valid JSON definition of the '.$options['Resource'].' values'));
						$response = $object;
						break;
				}
				break;
			case 'application/x-www-form-urlencoded':
			case 'text/plain':
			case 'text/html':
				parse_str($data, $response);
				break;
			case 'text/xml':
				if(IsSet($options['DecodeXMLResponse']))
				{
					switch(strtolower($options['DecodeXMLResponse']))
					{
						case 'simplexml':
							if($this->debug)
								$this->OutputDebug('Decoding XML response with simplexml');
							try
							{
								$response = @new SimpleXMLElement($data);
							}
							catch(Exception $exception)
							{
								return $this->SetError('Could not parse XML response: '.$exception->getMessage());
							}
							break 2;
						default:
							return $this->SetError($options['DecodeXML'].' is not a supported method to decode XML responses');
					}
				}
			default:
				$response = $data;
				break;
		}
		if($this->response_status >= 200
		&& $this->response_status < 300)
			$this->access_token_error = '';
		else
		{
			$this->access_token_error = 'it was not possible to access the '.$options['Resource'].': it was returned an unexpected response status '.$http->response_status.' Response: '.$data;
			if($this->debug)
				$this->OutputDebug('Could not retrieve the OAuth access token. Error: '.$this->access_token_error);
			if(IsSet($options['FailOnAccessError'])
			&& $options['FailOnAccessError'])
			{
				$this->error = $this->access_token_error;
				return false;
			}
		}
		return true;
	}

	Function ProcessToken1($oauth, &$access_token)
	{
		if(!$this->GetAccessTokenURL($url))
			return false;
		$options = array('Resource'=>'OAuth access token');
		$method = strtoupper($this->token_request_method);
		switch($method)
		{
			case 'GET':
				break;
			case 'POST':
				$options['PostValuesInURI'] = true;
				break;
			default:
				$this->error = $method.' is not a supported method to request tokens';
				return false;
		}
		if(!$this->SendAPIRequest($url, $method, array(), $oauth, $options, $response))
			return false;
		if(strlen($this->access_token_error))
		{
			$this->authorization_error = $this->access_token_error;
			return true;
		}
		if(!IsSet($response['oauth_token'])
		|| !IsSet($response['oauth_token_secret']))
		{
			$this->authorization_error= 'it was not returned the access token and secret';
			return true;
		}
		$access_token = array(
			'value'=>$response['oauth_token'],
			'secret'=>$response['oauth_token_secret'],
			'authorized'=>true
		);
		if(IsSet($response['oauth_expires_in'])
		&& $response['oauth_expires_in'] == 0)
		{
			if($this->debug)
				$this->OutputDebug('Ignoring access token expiry set to 0');
			$this->access_token_expiry = '';
		}
		elseif(IsSet($response['oauth_expires_in']))
		{
			$expires = $response['oauth_expires_in'];
			if(strval($expires) !== strval(intval($expires))
			|| $expires <= 0)
				return($this->SetError('OAuth server did not return a supported type of access token expiry time'));
			$this->access_token_expiry = gmstrftime('%Y-%m-%d %H:%M:%S', $this->response_time + $expires);
			if($this->debug)
				$this->OutputDebug('Access token expiry: '.$this->access_token_expiry.' UTC');
			$access_token['expiry'] = $this->access_token_expiry;
		}
		else
			$this->access_token_expiry = '';
		if(IsSet($response['oauth_session_handle']))
		{
			$access_token['refresh'] = $response['oauth_session_handle'];
			if($this->debug)
				$this->OutputDebug('Refresh token: '.$access_token['refresh']);
		}
		return $this->StoreAccessToken($access_token);
	}

	Function ProcessToken2($code, $refresh)
	{
		if(!$this->GetRedirectURI($redirect_uri))
			return false;
		$authentication = $this->access_token_authentication;
		if(strlen($this->oauth_username))
		{
			$values = array(
				'grant_type'=>'password',
				'username'=>$this->oauth_username,
				'password'=>$this->oauth_password,
				'redirect_uri' => $redirect_uri
			);
			$authentication = 'Basic';
		}
		elseif($this->redirect_uri === 'oob'
		&& strlen($this->pin))
		{
			$values = array(
				'grant_type'=>'pin',
				'pin'=>$this->pin,
				'scope'=>$this->scope,
			);
		}
		elseif($refresh)
		{
			$values = array(
				'refresh_token'=>$this->refresh_token,
				'grant_type'=>'refresh_token',
				'scope'=>$this->scope,
			);
			if(strlen($this->refresh_token_authentication))
				$authentication = $this->refresh_token_authentication;
		}
		else
		{
			switch($this->grant_type)
			{
				case 'password':
					return $this->SetError('it was not specified the username for obtaining a password based OAuth 2 authorization');
				case 'authorization_code':
					$values = array(
						'code'=>$code,
						'redirect_uri'=>$redirect_uri,
						'grant_type'=>'authorization_code'
					);
					break;
				case 'client_credentials':
					$values = array(
						'grant_type'=>'client_credentials'
					);
					$authentication = 'Basic';
					break;
				default:
					return $this->SetError($this->grant_type.' is not yet a supported OAuth 2 grant type');
			}
		}
		$options = array(
			'Resource'=>'OAuth '.($refresh ? 'refresh' : 'access').' token',
			'ConvertObjects'=>true
		);
		switch(strtolower($authentication))
		{
			case 'basic':
			case 'none':
				$options['AccessTokenAuthentication'] = $authentication;
				break;
			case '':
				$values['client_id'] = $this->client_id;
				$values['client_secret'] = ($this->get_token_with_api_key ? $this->api_key : $this->client_secret);
				break;
			default:
				return($this->SetError($authentication.' is not a supported authentication mechanism to retrieve an access token'));
		}
		if(!$this->GetAccessTokenURL($access_token_url))
			return false;
		if(!$this->SendAPIRequest($access_token_url, 'POST', $values, null, $options, $response))
			return false;
		if(strlen($this->access_token_error))
		{
			$this->authorization_error = $this->access_token_error;
			return true;
		}
		if(!IsSet($response['access_token']))
		{
			if(IsSet($response['error']))
			{
				$this->authorization_error = 'it was not possible to retrieve the access token: it was returned the error: '.$response['error'];
				return true;
			}
			return($this->SetError('OAuth server did not return the access token'));
		}
		$access_token = array(
			'value'=>($this->access_token = $response['access_token']),
			'authorized'=>true,
		);
		if($this->store_access_token_response)
			$access_token['response'] = $this->access_token_response = $response;
		if($this->debug)
			$this->OutputDebug('Access token: '.$this->access_token);
		if(IsSet($response['expires_in'])
		&& $response['expires_in'] == 0)
		{
			if($this->debug)
				$this->OutputDebug('Ignoring access token expiry set to 0');
			$this->access_token_expiry = '';
		}
		elseif(IsSet($response['expires'])
		|| IsSet($response['expires_in']))
		{
			$expires = (IsSet($response['expires_in']) ? $response['expires_in'] : $response['expires'] - ($response['expires'] > $this->response_time ? $this->response_time : 0));
			if(strval($expires) !== strval(intval($expires))
			|| $expires <= 0)
				return($this->SetError('OAuth server did not return a supported type of access token expiry time'));
			$this->access_token_expiry = gmstrftime('%Y-%m-%d %H:%M:%S', $this->response_time + $expires);
			if($this->debug)
				$this->OutputDebug('Access token expiry: '.$this->access_token_expiry.' UTC');
			$access_token['expiry'] = $this->access_token_expiry;
		}
		else
			$this->access_token_expiry = '';
		if(IsSet($response['token_type']))
		{
			$this->access_token_type = $response['token_type'];
			if(strlen($this->access_token_type)
			&& $this->debug)
				$this->OutputDebug('Access token type: '.$this->access_token_type);
			$access_token['type'] = $this->access_token_type;
		}
		else
		{
			$this->access_token_type = $this->default_access_token_type;
			if(strlen($this->access_token_type)
			&& $this->debug)
				$this->OutputDebug('Assumed the default for OAuth access token type which is '.$this->access_token_type);
		}
		if(IsSet($response['refresh_token']))
		{
			$this->refresh_token = $response['refresh_token'];
			if($this->debug)
				$this->OutputDebug('Refresh token: '.$this->refresh_token);
			$access_token['refresh'] = $this->refresh_token;
		}
		elseif(strlen($this->refresh_token))
		{
			if($this->debug)
				$this->OutputDebug('Reusing previous refresh token: '.$this->refresh_token);
			$access_token['refresh'] = $this->refresh_token;
		}
		return $this->StoreAccessToken($access_token);
	}

	Function RetrieveToken(&$valid)
	{
		$valid = false;
		if(!$this->GetAccessToken($access_token))
			return false;
		if(IsSet($access_token['value']))
		{
			$this->access_token = $access_token['value'];
			$this->access_token_expiry = '';
			$expired = (IsSet($access_token['expiry']) && strcmp($this->access_token_expiry = $access_token['expiry'], gmstrftime('%Y-%m-%d %H:%M:%S')) < 0);
			if($this->debug)
			{
				if($expired)
				{
					$this->OutputDebug('The OAuth access token expired on '.$this->access_token_expiry.' UTC');
				}
				else
				{
					$this->OutputDebug('The OAuth access token '.$this->access_token.' is valid');
					if(strlen($this->access_token_expiry))
						$this->OutputDebug('The OAuth access token expires on '.$this->access_token_expiry);
				}
			}
			if(IsSet($access_token['type']))
			{
				$this->access_token_type = $access_token['type'];
				if(strlen($this->access_token_type)
				&& !$expired
				&& $this->debug)
					$this->OutputDebug('The OAuth access token is of type '.$this->access_token_type);
			}
			else
			{
				$this->access_token_type = $this->default_access_token_type;
				if(strlen($this->access_token_type)
				&& !$expired
				&& $this->debug)
					$this->OutputDebug('Assumed the default for OAuth access token type which is '.$this->access_token_type);
			}
			if(IsSet($access_token['secret']))
			{
				$this->access_token_secret = $access_token['secret'];
				if($this->debug
				&& !$expired
				&& strlen($this->access_token_secret))
					$this->OutputDebug('The OAuth access token secret is '.$this->access_token_secret);
			}
			if(IsSet($access_token['refresh']))
				$this->refresh_token = $access_token['refresh'];
			else
				$this->refresh_token = '';
			$this->access_token_response = (($this->store_access_token_response && IsSet($access_token['response'])) ? $access_token['response'] : null);
			$valid = true;
		}
		return true;
	}

	Function CallAPI($url, $method, $parameters, $options, &$response)
	{
		if(!IsSet($options['Resource']))
			$options['Resource'] = 'API call';
		if(!IsSet($options['ConvertObjects']))
			$options['ConvertObjects'] = false;
		$version = intval($this->oauth_version);
		$two_legged = ($version === 1 && IsSet($options['2Legged']) && $options['2Legged']);
		if(strlen($this->access_token) === 0
		&& !$two_legged)
		{
			if(!$this->RetrieveToken($valid))
				return false;
			if(!$valid)
				return $this->SetError('the access token is not set to a valid value');
		}
		switch($version)
		{
			case 1:
				if(!$two_legged
				&& strlen($this->access_token_expiry)
				&& strcmp($this->access_token_expiry, gmstrftime('%Y-%m-%d %H:%M:%S')) <= 0)
				{
					if(strlen($this->refresh_token) === 0)
						return($this->SetError('the access token expired and no refresh token is available'));
					if($this->debug)
						$this->OutputDebug('Refreshing the OAuth access token expired on '.$this->access_token_expiry);
					$oauth = array(
						'oauth_token'=>$this->access_token,
						'oauth_session_handle'=>$this->refresh_token
					);
					if(!$this->ProcessToken1($oauth, $access_token))
						return false;
					if(IsSet($options['FailOnAccessError'])
					&& $options['FailOnAccessError']
					&& strlen($this->authorization_error))
					{
						$this->error = $this->authorization_error;
						return false;
					}
					if(!IsSet($access_token['authorized'])
					|| !$access_token['authorized'])
						return($this->SetError('failed to obtain a renewed the expired access token'));
					$this->access_token = $access_token['value'];
					$this->access_token_secret = $access_token['secret'];
					if(IsSet($access_token['refresh']))
						$this->refresh_token = $access_token['refresh'];
				}
				$oauth = array();
				if(!$two_legged)
					$oauth[strlen($this->access_token_parameter) ? $this->access_token_parameter : 'oauth_token'] = $this->access_token;
				break;

			case 2:
				if(strlen($this->access_token_expiry)
				&& strcmp($this->access_token_expiry, gmstrftime('%Y-%m-%d %H:%M:%S')) <= 0)
				{
					if(strlen($this->refresh_token) === 0)
						return($this->SetError('the access token expired and no refresh token is available'));
					if($this->debug)
						$this->OutputDebug('Refreshing the OAuth access token expired on '.$this->access_token_expiry);
					if(!$this->ProcessToken2(null, true))
						return false;
					if(IsSet($options['FailOnAccessError'])
					&& $options['FailOnAccessError']
					&& strlen($this->authorization_error))
					{
						$this->error = $this->authorization_error;
						return false;
					}
				}
				$oauth = null;
				if(strcasecmp($this->access_token_type, 'Bearer'))
					$url .= (strcspn($url, '?') < strlen($url) ? '&' : '?').(strlen($this->access_token_parameter) ? $this->access_token_parameter : 'access_token').'='.UrlEncode($this->access_token);
				break;

			default:
				return($this->SetError($this->oauth_version.' is not a supported version of the OAuth protocol'));
		}
		return($this->SendAPIRequest($url, $method, $parameters, $oauth, $options, $response));
	}

	Function Initialize()
	{
		if(strlen($this->server) === 0)
			return true;
		$this->oauth_version =
		$this->dialog_url = 
		$this->reauthenticate_dialog_url = 
		$this->pin_dialog_url = 
		$this->access_token_url = 
		$this->request_token_url =
		$this->append_state_to_redirect_uri = '';
		$this->authorization_header = true;
		$this->url_parameters = false;
		$this->token_request_method = 'GET';
		$this->signature_method = 'HMAC-SHA1';
		$this->access_token_authentication = '';
		$this->access_token_parameter = '';
		$this->default_access_token_type = '';
		$this->store_access_token_response = false;
		$this->refresh_token_authentication = '';
		$this->grant_type = 'authorization_code';
		switch($this->server)
		{
			case 'Facebook':
				$this->oauth_version = '2.0';
				$this->dialog_url = 'https://www.facebook.com/v2.8/dialog/oauth?client_id={CLIENT_ID}&redirect_uri={REDIRECT_URI}&scope={SCOPE}&state={STATE}';
				$this->reauthenticate_dialog_url = 'https://www.facebook.com/v'.Facebook_Version.'/dialog/oauth?client_id={CLIENT_ID}&redirect_uri={REDIRECT_URI}&scope={SCOPE}&state={STATE}&auth_type=reauthenticate';
				$this->access_token_url = 'https://graph.facebook.com/oauth/access_token';
				break;

			case 'github':
				$this->oauth_version = '2.0';
				$this->dialog_url = 'https://github.com/login/oauth/authorize?client_id={CLIENT_ID}&redirect_uri={REDIRECT_URI}&scope={SCOPE}&state={STATE}';
				$this->access_token_url = 'https://github.com/login/oauth/access_token';
				break;

			case 'Google':
				$this->oauth_version = '2.0';
				$this->dialog_url = 'https://accounts.google.com/o/oauth2/auth?response_type=code&client_id={CLIENT_ID}&redirect_uri={REDIRECT_URI}&scope={SCOPE}&state={STATE}';
				$this->offline_dialog_url = 'https://accounts.google.com/o/oauth2/auth?response_type=code&client_id={CLIENT_ID}&redirect_uri={REDIRECT_URI}&scope={SCOPE}&state={STATE}&access_type=offline&approval_prompt=force';
				$this->access_token_url = 'https://accounts.google.com/o/oauth2/token';
				break;

			case 'LinkedIn':
				$this->oauth_version = '1.0a';
				$this->request_token_url = 'https://api.linkedin.com/uas/oauth/requestToken?scope={SCOPE}';
				$this->dialog_url = 'https://api.linkedin.com/uas/oauth/authenticate';
				$this->access_token_url = 'https://api.linkedin.com/uas/oauth/accessToken';
				$this->url_parameters = true;
				break;

			case 'Microsoft':
				$this->oauth_version = '2.0';
				$this->dialog_url = 'https://login.live.com/oauth20_authorize.srf?client_id={CLIENT_ID}&scope={SCOPE}&response_type=code&redirect_uri={REDIRECT_URI}&state={STATE}';
				$this->access_token_url = 'https://login.live.com/oauth20_token.srf';
				break;

			case 'Twitter':
				$this->oauth_version = '1.0a';
				$this->request_token_url = 'https://api.twitter.com/oauth/request_token';
				$this->dialog_url = 'https://api.twitter.com/oauth/authenticate';
				$this->access_token_url = 'https://api.twitter.com/oauth/access_token';
				$this->url_parameters = false;
				break;

		

			default:
				if(!($json = @file_get_contents($this->configuration_file)))
				{
					if(!file_exists($this->configuration_file))
						return $this->SetError('the OAuth server configuration file '.$this->configuration_file.' does not exist');
					return $this->SetPHPError('could not read the OAuth server configuration file '.$this->configuration_file, $php_errormsg);
				}
				$oauth_server = json_decode($json);
				if(!IsSet($oauth_server))
					return $this->SetPHPError('It was not possible to decode the OAuth server configuration file '.$this->configuration_file.' eventually due to incorrect format', $php_errormsg);
				if(GetType($oauth_server) !== 'object')
					return $this->SetError('It was not possible to decode the OAuth server configuration file '.$this->configuration_file.' because it does not correctly define a JSON object');
				if(!IsSet($oauth_server->servers)
				|| GetType($oauth_server->servers) !== 'object')
					return $this->SetError('It was not possible to decode the OAuth server configuration file '.$this->configuration_file.' because it does not correctly define a JSON object for servers');
				if(!IsSet($oauth_server->servers->{$this->server}))
					return($this->SetError($this->server.' is not yet a supported type of OAuth server. Please send a request in this class support forum (preferred) http://www.phpclasses.org/oauth-api , or if it is a security or private matter, contact the author Manuel Lemos mlemos@acm.org to request adding built-in support to this type of OAuth server.'));
				$properties = $oauth_server->servers->{$this->server};
				if(GetType($properties) !== 'object')
					return $this->SetError('The OAuth server configuration file '.$this->configuration_file.' for the "'.$this->server.'" server does not correctly define a JSON object');
				$types = array(
					'oauth_version'=>'string',
					'request_token_url'=>'string',
					'dialog_url'=>'string',
					'reauthenticate_dialog_url'=>'string',
					'pin_dialog_url'=>'string',
					'offline_dialog_url'=>'string',
					'access_token_url'=>'string',
					'append_state_to_redirect_uri'=> 'string',
					'authorization_header'=>'boolean',
					'url_parameters' => 'boolean',
					'token_request_method'=>'string',
					'signature_method'=>'string',
					'access_token_authentication'=>'string',
					'access_token_parameter'=>'string',
					'default_access_token_type'=>'string',
					'store_access_token_response'=>'boolean',
					'refresh_token_authentication'=>'string',
					'grant_type'=>'string'
				);
				$required = array(
					'oauth_version'=>array(),
					'request_token_url'=>array('1.0', '1.0a'),
					'dialog_url'=>array(),
					'access_token_url'=>array(),
				);
				foreach($properties as $property => $value)
				{
					if(!IsSet($types[$property]))
						return $this->SetError($property.' is not a supported property for the "'.$this->server.'" server in the OAuth server configuration file '.$this->configuration_file);
					$type = GetType($value);
					$expected = $types[$property];
					if($type !== $expected)
						return $this->SetError(' the property "'.$property.'" for the "'.$this->server.'" server is not of type "'.$expected.'", it is of type "'.$type.'", in the OAuth server configuration file '.$this->configuration_file);
					$this->{$property} = $value;
					UnSet($required[$property]);
				}
				foreach($required as $property => $value)
				{
					if(count($value)
					&& in_array($this->oauth_version, $value))
						return $this->SetError('the property "'.$property.'" is not defined for the "'.$this->server.'" server in the OAuth server configuration file '.$this->configuration_file);
				}
				break;
		}
		return(true);
	}

	Function CheckAccessToken(&$redirect_url)
	{
		$redirect_url = null;
		if(strlen($this->access_token)
		|| strlen($this->access_token_secret))
		{
			if($this->debug)
				$this->OutputDebug('The Process function should not be called again if the OAuth token was already set manually');
			return $this->SetError('the OAuth token was already set');
		}
		switch(intval($this->oauth_version))
		{
			case 1:
				$one_a = ($this->oauth_version === '1.0a');
				if($this->debug)
					$this->OutputDebug('Checking the OAuth token authorization state');
				if(!$this->GetAccessToken($access_token))
					return false;
				if(IsSet($access_token['expiry']))
					$this->access_token_expiry = $access_token['expiry'];
				if(IsSet($access_token['authorized'])
				&& IsSet($access_token['value']))
				{
					$expired = (IsSet($access_token['expiry']) && strcmp($access_token['expiry'], gmstrftime('%Y-%m-%d %H:%M:%S')) <= 0);
					if(!$access_token['authorized']
					|| $expired)
					{
						if($this->debug)
						{
							if($expired)
								$this->OutputDebug('The OAuth token expired on '.$access_token['expiry'].'UTC');
							else
								$this->OutputDebug('The OAuth token is not yet authorized');
						}
						if($one_a
						&& $this->redirect_uri === 'oob'
						&& strlen($this->pin))
						{
							if($this->debug)
								$this->OutputDebug('Checking the pin');
							$this->access_token_secret = $access_token['secret'];
							$oauth = array(
								'oauth_token'=>$access_token['value'],
								'oauth_verifier'=>$this->pin
							);
							if(!$this->ProcessToken1($oauth, $access_token))
								return false;
							if($this->debug)
								$this->OutputDebug('The OAuth token was authorized');
						}
						else
						{
							if($this->debug)
								$this->OutputDebug('Checking the OAuth token and verifier');
							if(!$this->GetRequestToken($token, $verifier))
								return false;
							if(!IsSet($token)
							|| ($one_a
							&& !IsSet($verifier)))
							{
								if(!$this->GetRequestDenied($denied))
									return false;
								if(IsSet($denied)
								&& $denied === $access_token['value'])
								{
									if($this->debug)
										$this->OutputDebug('The authorization request was denied');
									$this->authorization_error = 'the request was denied';
									return true;
								}
								else
								{
									if($this->debug)
										$this->OutputDebug('Reset the OAuth token state because token and verifier are not both set');
									$access_token = array();
								}
							}
							elseif($token !== $access_token['value'])
							{
								if($this->debug)
									$this->OutputDebug('Reset the OAuth token state because token does not match what as previously retrieved');
								$access_token = array();
							}
							else
							{
								$this->access_token_secret = $access_token['secret'];
								$oauth = array(
									'oauth_token'=>$token,
								);
								if($one_a)
									$oauth['oauth_verifier'] = $verifier;
								if(!$this->ProcessToken1($oauth, $access_token))
									return false;
								if($this->debug)
									$this->OutputDebug('The OAuth token was authorized');
							}
						}
					}
					elseif($this->debug)
						$this->OutputDebug('The OAuth token was already authorized');
					if(IsSet($access_token['authorized'])
					&& $access_token['authorized'])
					{
						$this->access_token = $access_token['value'];
						$this->access_token_secret = $access_token['secret'];
						if(IsSet($access_token['refresh']))
							$this->refresh_token = $access_token['refresh'];
						return true;
					}
				}
				else
				{
					if($this->debug)
						$this->OutputDebug('The OAuth access token is not set');
					$access_token = array();
				}
				if(!IsSet($access_token['authorized']))
				{
					if($this->debug)
						$this->OutputDebug('Requesting the unauthorized OAuth token');
					if(!$this->GetRequestTokenURL($url))
						return false;
					$url = str_replace('{SCOPE}', UrlEncode($this->scope), $url); 
					if(!$this->GetRedirectURI($redirect_uri))
						return false;
					$oauth = array(
						'oauth_callback'=>$redirect_uri,
					);
					$options = array(
						'Resource'=>'OAuth request token',
						'FailOnAccessError'=>true
					);
					$method = strtoupper($this->token_request_method);
					switch($method)
					{
						case 'GET':
							break;
						case 'POST':
							$options['PostValuesInURI'] = true;
							break;
						default:
							$this->error = $method.' is not a supported method to request tokens';
							break;
					}
					if(!$this->SendAPIRequest($url, $method, array(), $oauth, $options, $response))
						return false;
					if(strlen($this->access_token_error))
					{
						$this->authorization_error = $this->access_token_error;
						return true;
					}
					if(!IsSet($response['oauth_token'])
					|| !IsSet($response['oauth_token_secret']))
					{
						$this->authorization_error = 'it was not returned the requested token';
						return true;
					}
					$access_token = array(
						'value'=>$response['oauth_token'],
						'secret'=>$response['oauth_token_secret'],
						'authorized'=>false
					);
					if(IsSet($response['login_url']))
						$access_token['login_url'] = $response['login_url'];
					if(!$this->StoreAccessToken($access_token))
						return false;
				}
				if(!$this->GetDialogURL($url))
					return false;
				switch($url)
				{
					case 'automatic':
						if(!IsSet($access_token['login_url']))
							return($this->SetError('The request token response did not automatically the login dialog URL as expected'));
						if($this->debug)
							$this->OutputDebug('Dialog URL obtained automatically from the request token response: '.$url);
						$url = $access_token['login_url'];
						break;
					case '2legged':
						if($this->debug)
							$this->OutputDebug('Obtaining 2 legged access token');
						$this->access_token_secret = $access_token['secret'];
						$oauth = array(
							'oauth_token'=>$access_token['value'],
						);
						if(!$this->ProcessToken1($oauth, $access_token))
							return false;
						if($this->debug)
							$this->OutputDebug('The OAuth token was authorized');
						return true;
					default:
						$url .= (strpos($url, '?') === false ? '?' : '&').'oauth_token='.$access_token['value'];
				}
				if(!$one_a)
				{
					if(!$this->GetRedirectURI($redirect_uri))
						return false;
					$url .= '&oauth_callback='.UrlEncode($redirect_uri);
				}
				if($this->debug)
					$this->OutputDebug('Redirecting to OAuth authorize page '.$url);
				$redirect_url = $url;
				return true;

			case 2:
				if($this->debug)
				{
					if(!$this->GetAccessTokenURL($access_token_url))
						return false;
					$this->OutputDebug('Checking if OAuth access token was already retrieved from '.$access_token_url);
				}
				if(!$this->RetrieveToken($valid))
					return false;
				$expired = (strlen($this->access_token_expiry) && strcmp($this->access_token_expiry, gmstrftime('%Y-%m-%d %H:%M:%S')) <= 0 && strlen($this->refresh_token) === 0);
				if($valid
				&& !$expired)
					return true;
				if($this->debug)
				{
					if(!$valid)
						$this->OutputDebug('A valid access token is not available');
					elseif($expired)
						$this->OutputDebug('The access token expired');
				}
				switch($this->grant_type)
				{
					case 'authorization_code':
						if($this->redirect_uri === 'oob'
						&& strlen($this->pin))
						{
							if($this->debug)
								$this->OutputDebug('Getting the access token using the pin');
							if(!$this->ProcessToken2(null, false))
								return false;
							if(strlen($this->authorization_error))
								return $this->SetError($this->authorization_error);
							return true;
						}
						elseif(strlen($this->oauth_username) === 0)
							break;
					case 'password':
						if($this->debug)
							$this->OutputDebug('Getting the access token using the username and password');
						if(!$this->ProcessToken2(null, false))
							return false;
						if(strlen($this->authorization_error))
							return $this->SetError($this->authorization_error);
						return true;
					case 'client_credentials':
						if($this->debug)
							$this->OutputDebug('Getting the access token using the client credentials');
						if(!$this->ProcessToken2(null, false))
							return false;
						if(strlen($this->authorization_error))
							return $this->SetError($this->authorization_error);
						return true;
					default:
						return $this->SetError($this->grant_type.' is not yet a supported OAuth 2 grant type');
				}
				if($this->debug)
					$this->OutputDebug('Checking the authentication state in URI '.$_SERVER['REQUEST_URI']);
				if(!$this->GetStoredState($stored_state))
					return false;
				if(strlen($stored_state) == 0)
					return($this->SetError('it was not set the OAuth state'));
				if(!$this->GetRequestState($state))
					return false;
				if($state === $stored_state)
				{
					if($this->debug)
						$this->OutputDebug('Checking the authentication code');
					if(!$this->GetRequestCode($code))
						return false;
					if(strlen($code) == 0)
					{
						if(!$this->GetRequestError($this->authorization_error))
							return false;
						if(IsSet($this->authorization_error))
						{
							if($this->debug)
								$this->OutputDebug('Authorization failed with error code '.$this->authorization_error);
							switch($this->authorization_error)
							{
								case 'invalid_request':
								case 'unauthorized_client':
								case 'access_denied':
								case 'unsupported_response_type':
								case 'invalid_scope':
								case 'server_error':
								case 'temporarily_unavailable':
								case 'user_denied':
									return true;
								default:
									return($this->SetError('it was returned an unknown OAuth error code'));
							}
						}
						return($this->SetError('it was not returned the OAuth dialog code'));
					}
					if(!$this->ProcessToken2($code, false))
						return false;
					if(strlen($this->authorization_error))
						return $this->SetError($this->authorization_error);
				}
				else
				{
					if(!$this->GetRedirectURI($redirect_uri))
						return false;
					if(strlen($this->append_state_to_redirect_uri))
						$redirect_uri .= (strpos($redirect_uri, '?') === false ? '?' : '&').$this->append_state_to_redirect_uri.'='.$stored_state;
					if(!$this->GetDialogURL($url, $redirect_uri, $stored_state))
						return false;
					if(strlen($url) == 0)
						return($this->SetError('it was not set the OAuth dialog URL'));
					if($this->debug)
						$this->OutputDebug('Redirecting to OAuth Dialog '.$url);
					$redirect_url = $url;
				}
				break;

			default:
				return($this->SetError($this->oauth_version.' is not a supported version of the OAuth protocol'));
		}
		return(true);
	}

	Function Process()
	{
		if(!$this->CheckAccessToken($redirect_url))
			return false;
		if(IsSet($redirect_url))
		{
			$this->Redirect($redirect_url);
			$this->exit = true;
		}
		return true;
	}

	Function Finalize($success)
	{
		return($success);
	}

	Function Output()
	{
		if(strlen($this->authorization_error)
		|| strlen($this->access_token_error)
		|| strlen($this->access_token))
		{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>OAuth client result</title>
</head>
<body>
<h1>OAuth client result</h1>
<?php
			if(strlen($this->authorization_error))
			{
?>
<p>It was not possible to authorize the application.<?php
				if($this->debug)
				{
?>
<br>Authorization error: <?php echo HtmlSpecialChars($this->authorization_error);
				}
?></p>
<?php
			}
			elseif(strlen($this->access_token_error))
			{
?>
<p>It was not possible to use the application access token.
<?php
				if($this->debug)
				{
?>
<br>Error: <?php echo HtmlSpecialChars($this->access_token_error);
				}
?></p>
<?php
			}
			elseif(strlen($this->access_token))
			{
?>
<p>The application authorization was obtained successfully.
<?php
				if($this->debug)
				{
?>
<br>Access token: <?php echo HtmlSpecialChars($this->access_token);
					if(IsSet($this->access_token_secret))
					{
?>
<br>Access token secret: <?php echo HtmlSpecialChars($this->access_token_secret);
					}
				}
?></p>
<?php
				if(strlen($this->access_token_expiry))
				{
?>
<p>Access token expiry: <?php echo $this->access_token_expiry; ?> UTC</p>
<?php
				}
			}
?>
</body>
</html>
<?php
		}
	}


};



?>
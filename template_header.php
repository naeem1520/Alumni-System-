<?php 
require 'config.php';
require 'userSession.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title><?php echo SITE_NAME; ?></title>
<meta name="description" content="<?php echo SITE_DESC; ?>"/>

<link href='<?php echo BASE_URL.UPLOAD_PATH;?>favicon.png' rel='icon' type='image/x-icon'/>
<link  href='<?php echo BASE_URL.UPLOAD_PATH;?>favicon.png' rel='shortcut icon' type='image/x-icon'/>

<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'/>
<!-- CSS -->
<link href="<?php echo BASE_URL;?>css/wallscriptBoot.css" rel="stylesheet"/>
<link href="<?php echo BASE_URL;?>css/wallscriptPlugins.css" rel="stylesheet"/>
<link href="<?php echo BASE_URL;?>css/wallscript.css" rel="stylesheet"/>
</head>
<body>
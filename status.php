<?php include_once('template_header.php'); ?>
<?php
if(!empty($sessionUid) && $sessionUid>0 )
{
include_once('template_topMenu.php');
$publicAccess='0';
}
else
{    
include_once 'template_topMenuLogin.php';
$publicAccess='1';
}
?>
<?php include_once('template_sidebarLeft.php'); ?>
<?php  include_once('template_status.php'); ?>
<?php include_once('template_footer.php'); ?>
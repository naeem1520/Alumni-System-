<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="description" content="<?php echo SITE_DESC; ?>"/>
<link href='<?php echo BASE_URL.UPLOAD_PATH;?>favicon.png' rel='icon' type='image/x-icon'/>
<link  href='<?php echo BASE_URL.UPLOAD_PATH;?>favicon.png' rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo BASE_URL;?>css/wallscriptBoot.css" rel="stylesheet"/>
<link href="<?php echo BASE_URL;?>css/wallscriptPlugins.css" rel="stylesheet"/>
<link href="<?php echo BASE_URL;?>css/wallscript.css" rel="stylesheet"/>
<script src="<?php echo BASE_URL;?>js/jquery.min.js" ></script>
<script src="<?php echo BASE_URL;?>js/jquery.validate.js" ></script>
<script src="<?php echo BASE_URL;?>js/ajaxPost.js" ></script>
<script>
function publicLabelData(apiBaseUrl)
{

var uid="";
var encodedata=JSON.stringify({"uid": uid});
var url=apiBaseUrl+'api/publicLabelData'; 

ajaxPost(url,encodedata, function(data) 
{
if(data.labelData.length)
{
var D=data.labelData[0];
$(".loginTitle").html(D.loginTitle);
$(".emailUsername").html(D.emailUsername);
$(".password").html(D.password);
$(".forgotPassword").html(D.forgotPassword);

$(".buttonFacebook").html(D.buttonFacebook);
$(".buttonGoogle").html(D.buttonGoogle);
$(".buttonMicrosoft").html(D.buttonMicrosoft);
$(".buttonLinkedin").html(D.buttonLinkedin);
$(".buttonLogin").val(D.buttonLogin);
$(".buttonSignUp").val(D.buttonSignUp);
$(".buttonForgotButton").val(D.buttonForgotButton);
$(".buttonSetNewPassword").val(D.buttonSetNewPassword);
$(".settingsNewPassword").html(D.settingsNewPassword);
$(".settingsConfirmPassword").html(D.settingsConfirmPassword);
$(".registrationTitle").html(D.registrationTitle);
$(".email").html(D.email);
$(".username").html(D.username);
$(".agreeMessage").html(D.agreeMessage);
$(".terms").html(D.terms);
$(".resetPassword").html(D.resetPassword);
$(".thankYou").html(D.thankYou);
$(".thankYouMessage").html(D.thankYouMessage);
}
});
}
</script>
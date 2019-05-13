<?php
include_once 'config.php';
if(empty($_GET['code']))
{
$url=BASE_URL.'login.php';
header("location:$url");
}
include_once 'template_headerLogin.php';
?>

<script>
$(document).ready(function()
{
$.baseUrl='<?php echo BASE_URL ?>';
$.apiBaseUrl='<?php echo API_BASE_URL ?>';
$.baseUploads='<?php echo UPLOAD_PATH ?>';
$.active_code='<?php echo$_GET["code"] ?>';

publicLabelData($.apiBaseUrl);
resetPasswordCode($.active_code, $.apiBaseUrl);

$('body').on('click','#resetButton',function()
{
var npassword=$("#password").val();
var cpassword=$("#cpassword").val();
if($.trim(npassword).length>0 && $.trim(cpassword).length>0)
{

if($.trim(npassword) == $.trim(cpassword))
{
resetPassword($.active_code,npassword,cpassword);
}
else
{
$("#resetMessage").removeClass("has-success").addClass("has-error").html("Password does not match the confirm password.");
}

}
return false;
});
});

function resetPasswordCode(code)
{
var encodedata=JSON.stringify({"code": code});  
var url=$.apiBaseUrl+'api/resetPasswordCode'; /* User singup API */

ajaxPost(url,encodedata, function(data) {

if(parseInt(data.resetPasswordCode[0].status)<1)
{
var url=$.baseUrl+'login.php';
$("#signup").html("<br/>Link has been expired, please request again.");
}


});
}

function resetPassword(code,npassword,cpassword)
{
var encodedata=JSON.stringify({"code": code, "npassword": npassword, "cpassword": cpassword});  
var url=$.apiBaseUrl+'api/resetPassword'; /* User singup API */

ajaxPost(url,encodedata, function(data) {

if(parseInt(data.resetPassword[0].status))
{

$("#password").val("");
$("#cpassword").val("");
$("#resetMessage").removeClass("has-error").addClass("has-success").html("Password has been update.");
}


});
}




</script>
<title><?php echo SITE_NAME; ?> Reset Password</title>
</head>
<body class="login">
<?php include_once 'template_topMenuLogin.php'; ?>
<div id="content" class="loginContent">
<div class="container-fluid">
<div class="row">
<div class="blockCenter" >
<div class="panel panel-default ">
<div class="panel-body login-body forgot">
<div class="category resetPassword">Reset Password</div>
<form method="post" action="" name="signup" id="signup" autocomplete="off" autocomplete="false" >

<label class="settingsNewPassword">New Password</label>
<input class="form-control reg" id="password" type="password" name="password" placeholder="Enter password" autocomplete="off" autocomplete="false"  rel="0">
<label class="settingsConfirmPassword">Confirm Password</label>
<input class="form-control reg" id="cpassword" type="password" name="cpassword" placeholder="Enter confirm password" autocomplete="off" autocomplete="false"  rel="0">

<div class="has-success" id="resetMessage"></div>
<div style="clear:both" >
<input type="submit" class="wallbutton buttonSetNewPassword" value="Set New Password" id="resetButton"> 
</div>
</form>
</div>
</div>
</div>
</div>



</div>
</div>
</div>
</body>

</html>
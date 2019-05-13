<?php
include_once 'config.php';
include_once 'template_headerLogin.php';
?>
<script>
$(document).ready(function()
{
$.baseUrl='<?php echo BASE_URL ?>';
$.apiBaseUrl='<?php echo API_BASE_URL ?>';
$.baseUploads='<?php echo UPLOAD_PATH ?>';

publicLabelData($.apiBaseUrl);

$('body').on('click','#forgotButton',function()
{
var usernameEmail=$("#forgotValue").val();

if(/^[a-zA-Z0-9_-]{3,16}$/i.test(usernameEmail) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(usernameEmail))
{


var encodedata=JSON.stringify({"usernameEmail": usernameEmail});  
var url=$.apiBaseUrl+'api/forgot'; /* User singup API */
ajaxPost(url,encodedata, function(data) {

if(parseInt(data.forgot[0].status)>0)
$("#forgotMessage").removeClass("has-error").addClass("has-success").html("An e-mail has been sent.");
else
$("#forgotMessage").removeClass("has-success").addClass("has-error").html("No account with that user or e-mail address exists.");

});
}
return false;
});

});
</script>
<title><?php echo SITE_NAME; ?> Forgot</title>
</head>
<body class="login">
<?php include_once 'template_topMenuLogin.php'; ?>
<div id="content" class="loginContent">
<div class="container-fluid">
<div class="row">    
<div class="blockCenter" >
<div class="panel panel-default ">
<div class="panel-body login-body forgot">
<div class="category forgotPassword">Forgot Password</div>
<p>Enter the username or email address you signed up with below. An email will be sent containing a link to reset your password.</p>
<form method="post" action="" name="signup" id="signup" autocomplete="off" autocomplete="false" >
<label>Email or Username</label>
<input class="form-control reg" id="forgotValue" type="text" name="email" placeholder="Enter Email or Username" autocomplete="off" autocomplete="false"  rel="0">
<div class="has-success" id="forgotMessage"></div>
<div style="clear:both" >
<input type="submit" class="wallbutton buttonForgotButton" value="Send Reset Instructions" id="forgotButton"> 
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</body>

</html>
<?php
include_once 'config.php';
include_once 'template_headerLogin.php';
?>

<script>
$(document).ready(function()
{
$.baseUrl='<?php echo BASE_URL ?>';
$.baseUploads='<?php echo UPLOAD_PATH ?>';
$.active_code='<?php echo$_GET["code"] ?>';
publicLabelData($.baseUrl);
});
</script>
</head>
<body class="login">
<?php include_once 'template_topMenuLogin.php'; ?>
<div id="content" class="loginContent">
<div class="container-fluid">
<div class="row">
<div  >
<div class="panel panel-default ">
<div class="panel-body login-body verifyMessage" >

<h1 class="thankYou">THANK YOU!</h1>
<h3 class="thankYouMessage">
<?php
if(SMTP_CONNECTION)
{ 
echo "Please confirm your email.";
}
else
{
echo "Please login with your details.";	
}
?>
</h3>

</div>
</div>
</div>
</div>



</div>
</div>
</div>
</body>

</html>
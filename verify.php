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
$.baseUrl='<?php echo BASE_URL ?>';
$.apiBaseUrl='<?php echo API_BASE_URL ?>';
$.baseUploads='<?php echo UPLOAD_PATH ?>';
$.active_code='<?php echo$_GET["code"] ?>';

$(document).ready(function()
{
verifyCode($.active_code);
});

function verifyCode(code)
{
var encodedata=JSON.stringify({"code": code});  
var url=$.apiBaseUrl+'api/verifyCode'; /* User singup API */

ajaxPost(url,encodedata, function(data) 
{
if(parseInt(data.verifyCode[0].status)<1)
{
var url=$.baseUrl+'login.php';
window.location.replace(url);
}
});
}
</script>
</head>
<body class="login">
<?php include_once 'template_topMenuLogin.php'; ?>
<div id="content" class="loginContent">
<div class="container-fluid">
<div class="row">

<div class="panel panel-default ">
<div class="panel-body login-body verifyMessage" >
<h2>Welcome to <?php echo SITE_NAME ?>.</h2>
<h2 id="statusVerify">Your account is verified.</h2>
<br/>
<a href="<?php echo BASE_URL;?>login.php" class="wallbutton">Start Login</a>
</div>
</div>
</div>

</div>
</div>
</div>
</body>
</html>
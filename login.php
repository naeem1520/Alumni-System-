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
            $.SMTP_CONNECTION='<?php echo SMTP_CONNECTION ?>';
            var encodedata,username,password,email,fname,pic, id;
            publicLabelData($.apiBaseUrl);

            $(".reg").val("");
            $("#baseURL").html($.baseUrl);
            /* User Login */
            $('body').on('click','#login',function()
            {
                  username=$('#username').val();
                  password=$('#password').val();

                  if($.trim(username).length>0 && $.trim(password).length>0 )
                  {
                        encodedata=JSON.stringify({"username": username,"password": password});
                        var url=$.apiBaseUrl+'api/login'; /* User Login API */
                        ajaxPost(url,encodedata, function(data) {
                              if(data.login.length)
                              {
                                    var data=data.login[0];
                                    var cdata=data.configurations[0];
                                    if(data.uid>0)
                                    {
                                          var url=$.baseUrl+'authentication.php?uid='+data.uid+
                                          '&notification_created='+data.notification_created+'&token='+data.token+
                                          '&name='+data.name+'&username='+data.username+'&pic='+data.profile_pic+
                                          '&newsfeedPerPage='+cdata.newsfeedPerPage+'&friendsPerPage='+cdata.friendsPerPage+
                                          '&photosPerPage='+cdata.photosPerPage+'&groupsPerPage='+cdata.groupsPerPage+
                                          '&notificationPerPage='+cdata.notificationPerPage+'&friendsWidgetPerPage='+cdata.friendsWidgetPerPage+'&tour='+data.tour;
                                          window.location.replace(url);
                                    }
                                    else
                                    {
                                          $("#loginError").show().html("Username or Password is invalid");
                                    }
                              }

                        });
                          
                  }
                  else
                  {
                        $("#loginError").show().html("Enter Username and Password");
                  }
                  

                  return false;

            });


            $('body').on('change','#remail',function()
            {
                  email=$(this).val();
                  if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(email))
                  {
                        encodedata=JSON.stringify({"usernameEmail": email,"type": "1"});
                        var url=$.apiBaseUrl+'api/usernameEmailCheck'; /* User singup API */
                        ajaxPost(url,encodedata, function(data) 
                        {

                              if(data.usernameEmailCheck.length)
                              {
                                    $('#remail').removeClass("errorInput").addClass("successInput").attr("rel","1");
                              }
                              else
                              {
                                    $('#remail').removeClass("successInput").addClass("errorInput").attr("rel","0");     
                              }
                        });
                  }
                  else
                  {
                        $('#remail').removeClass("successInput").addClass("errorInput").attr("rel","0");     
                  }
                  return false;


            });

            $('body').on('change','#rusername',function()
            {
                  username=$(this).val();
                  if(/^[a-zA-Z0-9_-]{3,25}$/i.test(username))
                  {
                        encodedata=JSON.stringify({"usernameEmail": username,"type": "0"});  
                        var url=$.apiBaseUrl+'api/usernameEmailCheck'; /* User singup API */
                        ajaxPost(url,encodedata, function(data) {
                              if(data.usernameEmailCheck.length)
                              {
                                    $('#rusername').removeClass("errorInput").addClass("successInput").attr("rel","1");
                              }
                              else
                              {
                                    $('#rusername').removeClass("successInput").addClass("errorInput").attr("rel","0");     
                              }
                        });
                  }
                  else
                  {
                        $('#rusername').removeClass("successInput").addClass("errorInput").attr("rel","0");  
                  }
                  return false;
            });


            /* User Registration */
            $('body').on('click','#signupButton',function()
            {
                  $("#signupButton").val("Processing..");
                  var statusEmail=$('#remail').attr('rel');   
                  var statusUsername=$('#rusername').attr('rel');

                  if(statusEmail>0 && statusUsername>0)
                  {
                        username=$('#rusername').val();
                        password=$('#rpassword').val();
                        email=$('#remail').val();
                        id=$('#rid').val();
                        encodedata=JSON.stringify({"username": username,"password": password,"email": email, "id": id});
                        console.log(encodedata);
                        var url=$.apiBaseUrl+'api/signup'; /* User singup API */
                        ajaxPost(url,encodedata, function(data) {
                              if(data.signup.length)
                              {
/*      
var data=data.signup[0];
var cdata=data.configurations[0];
var url=$.baseUrl+'authentication.php?uid='+data.uid+
       '&notification_created='+data.notification_created+'&token='+data.token+
       '&name='+data.name+'&username='+data.username+'&pic='+data.profile_pic+
       '&newsfeedPerPage='+cdata.newsfeedPerPage+'&friendsPerPage='+cdata.friendsPerPage+
       '&photosPerPage='+cdata.photosPerPage+'&groupsPerPage='+cdata.groupsPerPage+
       '&notificationPerPage='+cdata.notificationPerPage+'&friendsWidgetPerPage='+cdata.friendsWidgetPerPage+'&tour='+data.tour;

       */
       if(parseInt(data.signup[0].status))
       {
            var url=$.baseUrl+'thankyou.php';
            window.location.replace(url);    
      }
      else
      {
          $("#signupButton").val("Sign Up");   
    }

}
else
{
      $("#signupError").show().html("Username or Email already present.");
}
});
                  }
                  else
                  {
                        $("#signupError").show().html("Enter valid information");     
                  }

                  return false;
            });

            $.validator.addMethod("email", function(value, element) {  
                  return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);  
            }, "Give valid email address.");

            $.validator.addMethod("username",function(value,element){
                  return this.optional(element) || /^[a-zA-Z0-9_-]{3,16}$/i.test(value);  
            },"Username should be 3-15characters and no spaces");


            $.validator.addMethod("password",function(value,element){
                  return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,16}$/i.test(value);  
            },"Password should be 6-16 characters");



// Validate signup form
$("#signup").validate({
      rules: {
            email: "required email",
            username: "required username",
            password: "required password",

      },


});


$("#rusername").keyup(function(){
      var x=$(this).val();
      $("#usernameLabel").html(x);
});



});
</script>
<title><?php echo SITE_NAME; ?> Login</title>
</head>
<body class="login">
      <?php include_once 'template_topMenuLogin.php'; ?>
      <div id="content" class="loginContent">

            <div class="container-fluid">
                  <div class="row">

                        <div class="col-md-5">
                              <div class="panel panel-default">




                                    <div class="panel-body login-body ">
                                          <div class="category loginTitle">Login</div>
                                          <form method="post" action="" name="login" autocomplete="off" autocomplete="false">
                                                <label class="emailUsername">Email or Username</label>
                                                <input class="form-control" id="username" autocomplete="off" name="uname" type="text" placeholder="Enter Email or Username">
                                                <label class="password">Password</label>
                                                <input class="form-control" id="password" autocomplete="off" name="passcode" type="password" placeholder="Enter Password">
                                                <div class="has-error  displaynone" id="loginError">


                                                </div>



                                                <input type="submit" class="wallbutton messageButton buttonLogin" value="Login" id="login"> 

                                                <a href="forgot.php" class="forgot-password forgotPassword">Forgot password?</a>


                                          </form>
                                          <div class="box-body">





                                               <!--  <a  href="login_with_facebook.php" class="btn btn-block btn-social btn-facebook">
                                                      <i class="fa fa-facebook"></i> <span class="buttonFacebook">Sign in with Facebook</span>
                                                </a>


                                                <a href="login_with_google.php" class="btn btn-block btn-social btn-google-plus">
                                                      <i class="fa fa-google"></i> <span class="buttonGoogle">Sign in with Google</span>
                                                </a> -->




                                          </div>
                                    </div>
                              </div>
                        </div>

                        <div class="col-md-2"></div>


                        <div class="col-md-5">



                              <div class="panel panel-default ">
                                    <div class="panel-body login-body">
                                          <div class="category registrationTitle">Registration</div>
                                          <form method="post" action="" name="signup" id="signup" autocomplete="off" autocomplete="false" >

                                                <label class="email">ID</label>
                                                <input class="form-control reg" id="rid" type="text"  name="id" placeholder="Enter id" autocomplete="off" autocomplete="false"  rel="0">
                                                <label class="email">Email</label>
                                                <input class="form-control reg" id="remail" type="text"  name="email" placeholder="Enter Email" autocomplete="off" autocomplete="false"  rel="0">
                                                <label class="username">Username</label>
                                                <input class="form-control reg" id="rusername" type="text" name="username" maxlength="25" placeholder="Enter Username" autocomplete="off" autocomplete="false" rel='0'>
                                                <div id="urlText"><span id="baseURL" class="labelURL" ></span><span id="usernameLabel"></span></div>
                                                <label class="password">Password</label>
                                                <input class="form-control reg" id="rpassword" type="password"  name="password" placeholder="Enter Password" autocomplete="off" autocomplete="false" >
                                                <div id="terms"><span class="agreeMessage">By clicking Sign Up, you agree to our</span> <a href="terms.php" class="terms" target="_blank">Terms</a></div>
                                                <div class="has-error  displaynone" id="signupError"></div>
                                                <div style="clear:both" class="text-center">
                                                      <input type="submit" class="wallbutton buttonSignUp" value="Sign Up" id="signupButton"> 
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
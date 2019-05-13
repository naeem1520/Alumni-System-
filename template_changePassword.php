<?php
$changePassword='1';
?>

<div id="content">

<div class="container-fluid">
<?php 
include_once 'template_successError.php';
?>
<div class="timelineFriend"  id="settings">


<div class="row">

<div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray settingsChangePassword">Change password</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">

                            
                                <div class="form-group">
                                    <label class="col-sm-4 control-label settingsOldPassword">Old Password</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Old Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-4 control-label settingsNewPassword">New Password</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" id="newPassword" placeholder="New Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-4 control-label settingsConfirmPassword">Confirm Password</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"></label>
                                    <div class="col-sm-7">
                                        <input type="submit" id="changePassword" class="wallbutton" value="Set New Password"/>
                                </div>
                              
                           
                            </form>
                        </div>
                    </div>
                </div>


              



</div>

</div>
</div>


</div>
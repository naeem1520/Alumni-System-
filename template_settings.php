<?php
$settings=1;
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
                        <div class="panel-heading panel-heading-gray settingsTitle">Profile Settings</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">

                            <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label settingsUsername">ID</label>
                                    <div class="col-sm-8 textSettings idSettings">
                                        
                                    </div>
                                </div>



                            <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label settingsUsername">Username</label>
                                    <div class="col-sm-8 textSettings" id="usernameSettings">
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label settingsEmail">Email</label>
                                    <div class="col-sm-8 textSettings" id="emailSettings">
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label settingsName">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nameSettings" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label settingsPassword">Password</label>
                                    <div class="col-sm-8 selectpicker" id="">
                                      <a href="changePassword.php"><i class="fa fa-key"></i><span class="settingsChangePassword">Change Password</span></a>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label settingsGroup">Group</label>
                                    <div class="col-sm-8 selectpicker" id="">
                                      <a href="createGroup.php"><i class="fa fa-plus-circle"></i><span class="commonCreateGroup">Create Group</span></a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label settingsGender">Gender</label>
                                    <div class="col-sm-8">
                                        <select name="select" class="selectpicker"  id="genderSettings">
                                             <option value="">Select Gender</option>
                                            <option value="male" id="male">Male</option>
                                            <option value="female" id="female">Female</option>
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label settingsAboutMe">Current Workplace</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="2" id="aboutSettings"></textarea>
                                    </div>
                                </div>
                               <!--  <div class="form-group">
                                    <label class="col-sm-3 control-label settingsAboutMe">Current WorkPlace</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="2" id="workSettings"></textarea>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label settingsEmailAlerts">Email Alerts</label>
                                    <div class="col-sm-8">

                                    <select name="select" class="selectpicker"  id="emailNotifications">
                                            <option value="1" id="1">On</option>
                                            <option value="0" id="0">Off</option>
                                        </select>
                                    
                                    </div>
                                </div>
                                
         
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="submit" id="updateSettings" class="wallbutton buttonSaveSettings" value="Save Settings"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


<div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray socialTitle">Social Connections</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">

                            
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label socialFacebook">Facebook</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="facebookSettings" class="form-control social" id="inputEmail3" placeholder="">
                                        <span class="labelURL">https://www.facebook.com/</span><span class="" id="facebookSettingsLabel"></span>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label socialTwitter">About me</label>
                                    <div class="col-sm-8">
                                        <textarea rows="5" id="twitterSettings" class="form-control social" id="inputEmail3" placeholder=""></textarea>
                                        
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail3"  class="col-sm-3 control-label socialGoogle">Contact No.</label>
                                    <div class="col-sm-8">
                                        <input  type="number" id="googleSettings" class="form-control social" id="inputEmail3" placeholder="Number Must be 11 digits ">
                                        
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label socialInstagram">Current Adress</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="instagramSettings" class="form-control social" id="inputEmail3" placeholder="">
                                       
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="wallbutton buttonSocialSave" id="socialSettings">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                



</div>

</div>
</div>


</div>
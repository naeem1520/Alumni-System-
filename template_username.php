<?php
$usernameValue='1';
?>

<div id="content">

<div class="container-fluid">
<?php 
include_once 'template_successError.php';
?>
<div class="timelineFriend"  id="settings">


<div class="row">

<div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray settingsChangePassword">Set Username and complete the signup process</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">

                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label settingsOldPassword">Username</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="usernameValue" placeholder="Enter username" />
                                        <div class="error displaynone" id="usernameUpdateMsg"></div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"></label>
                                    <div class="col-sm-7">
                                        <input type="submit" id="usernameSubmit" class="wallbutton" value="Save"/>

                                </div>
                              
                           
                            </form>
                        </div>
                    </div>
                </div>


              



</div>

</div>
</div>


</div>
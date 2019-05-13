<?php
$editGroup='1';
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
                        <div class="panel-heading panel-heading-gray">Edit group</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">

                            
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-8">
                                  
                                        <input type="text" class="form-control" id="groupNameEdit" placeholder="Group Name">
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Description </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="5" id="groupDescEdit"></textarea>
                                    </div>
                                </div>
       
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <input type="submit" id="editGroup" class="wallbutton" value='Save Group'/>
                                        <a id="deleteGroup" class="wallbutton redButton" />Delete Group</a>
                                        
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
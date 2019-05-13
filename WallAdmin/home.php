<?php
include_once 'includes.php';
$Users_Count=$WallAdmin->Users_Count();
$Updates_Count=$WallAdmin->Updates_Count();
$Comments_Count=$WallAdmin->Comments_Count();
$Groups_Count=$WallAdmin->Groups_Count();
$Share_Count=$WallAdmin->Share_Count();
$Like_Count=$WallAdmin->Like_Count();
$ActiveUsers_Count=$WallAdmin->ActiveUsers_Count();
$Conversations_Count=$WallAdmin->Conversations_Count();
$UserUploads_Count=$WallAdmin->UserUploads_Count();
$ProfileUploads_Count=$WallAdmin->ProfileUploads_Count();
$dashboard=1;
$msg='';



if(isSet($_POST['applicationName']) && isSet($_POST['applicationDesc']) && isSet($_POST['applicationToken']))
{
$applicationName=$_POST['applicationName'];
$applicationDesc=$_POST['applicationDesc'];
$applicationToken=$_POST['applicationToken'];

if(strlen($applicationName)>0 && strlen($applicationDesc)>0 && strlen($applicationToken)>0)
{
$data=$WallAdmin->Site_Config($applicationName,$applicationDesc,$applicationToken);
$msg="Updated Successfully.";
}

}
include 'configurations.php';
?>

<!DOCTYPE html>
<html>
    <?php include_once("head.php"); ?>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once("header.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
           <?php include_once("menu.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
			
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $Users_Count; ?>
                                    </h3>
                                    <p>
                                        Users
                                    </p>
                                </div>

                                <a href="users.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $Updates_Count; ?>
                                    </h3>
                                    <p>
                                        Messages
                                    </p>
                                </div>

                                <a href="updates.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                       <?php echo $Comments_Count; ?>
                                    </h3>
                                    <p>
                                      Comments

                                    </p>
                                </div>

                                <a href="comments.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $Groups_Count; ?>
                                    </h3>
                                    <p>
                                        Groups
                                    </p>
                                </div>

                                <a href="groups.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						
						 <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box flat_sky">
                                <div class="inner">
                                    <h3>
                                        <?php echo $Share_Count; ?>
                                    </h3>
                                    <p>
                                        Shares
                                    </p>
                                </div>

                               
                            </div>
                        </div><!-- ./col -->
						
						 <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box flat_yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $Like_Count; ?>
                                    </h3>
                                    <p>
                                        Likes
                                    </p>
                                </div>

                               
                            </div>
                        </div><!-- ./col -->
						
						 <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box flat_black">
                                <div class="inner">
                                    <h3>
                                        <?php echo $ActiveUsers_Count; ?>
                                    </h3>
                                    <p>
                                        Active Users
                                    </p>
                                </div>

                              
                            </div>
                        </div><!-- ./col -->
						
						 <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box flat_lemon">
                                <div class="inner">
                                    <h3>
                                        <?php echo $Conversations_Count; ?>
                                    </h3>
                                    <p>
                                        Conversations
                                    </p>
                                </div>

                            </div>
                        </div><!-- ./col -->
						
							 <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box flat_new">
                                <div class="inner">
                                    <h3>
                                        <?php echo $UserUploads_Count; ?>
                                    </h3>
                                    <p>
                                        User Uploads
                                    </p>
                                </div>

                                <a href="userUploads.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						
							 <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box flat_new1">
                                <div class="inner">
                                    <h3>
                                        <?php echo $ProfileUploads_Count; ?>
                                    </h3>
                                    <p>
                                        Profile Pictures
                                    </p>
                                </div>

                                <a href="userPics.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        </div>
						<div class="row">
						 <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Application Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
<form role="form" method="post" action="" name="applicationDetails">
<div class="box-body">
<div class="form-group">
<label for="exampleInputEmail1">Application Name <?php echo $applicationName ?></label>
<input type="text" class="form-control" name="applicationName" placeholder="" value="<?php echo $applicationName ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Application Description</label>
<input type="text" class="form-control" name="applicationDesc" placeholder="" value="<?php echo $applicationDesc ?>">


</div>

<div class="form-group">
<label for="exampleInputEmail1">Application Secret Key  </label>
<input type="text" class="form-control" name="applicationToken" placeholder="" value="<?php echo $applicationToken ?>">
<span class="note">Note:</span> Generating API token using this KEY.
<label class="control-label" for="inputError"> <?php echo $msg; ?></label>
</div>


</div><!-- /.box-body -->

<div class="box-footer">

<input type="submit" class="btn btn-success" value="Save Details" />
</div>
</form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
						

                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Application Logo</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project Logo</label>
                                            <form id="imageform" method="post" enctype="multipart/form-data" action="ajaxLogoUpload.php">
                                            <input type="file" class="form-control" name="photoimg"  id="photoimg"/>
                                             <div id="logo_img">
                                             <img src="../uploads/logo.png" class='logoPreview'/>
                                             </div>
                                            </form>
                                        </div>

                                         <div class="form-group">
                                            <label for="exampleInputEmail1">Project Favicon</label>
                                            <form id="imageformFav" method="post" enctype="multipart/form-data" action="ajaxFaviconUpload.php">
                                            <input type="file" class="form-control" name="photoimg"  id="photoimgFav"/>
                                            <div id="fav_img">
                                             <img src="../uploads/favicon.png" class='logoPreview'/>
                                            </div>
                                            </form>
                                        </div>
                               


                                    </div><!-- /.box-body -->

                                    <div class="box-footer">

                                      <span class="note">Note:</span> Please upload .PNG format images. 
                                    </div>
                               
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                        </div>
						
                    

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->




    </body>
</html>

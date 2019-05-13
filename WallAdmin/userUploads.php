<?php
include_once 'includes.php';
include_once 'pagination_header.php';
$UserUploads_Details_Array=$WallAdmin->UserUploads_Details($start,$per_page);
$UserUploads_Count=$WallAdmin->UserUploads_Count();
$count = $UserUploads_Count;
$no_of_paginations = ceil($count / $per_page);
$useruploads=1;
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
                        User Uploads
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User Uploads</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<div class="row">

										<?php
										foreach($UserUploads_Details_Array as $data)
										{

										$image=$admin_path.$data['image_path'];

										?>
                        	<div class="col-lg-2 col-xs-6">
                            <!-- small box -->
                           <div class="small-box bg-aqua" id="image<?php echo $data['id']; ?>">

                                   <img src="<?php echo $image; ?>" class="imageAdmin"/>



                                <a href="#" class="small-box-footer imageDelete" id="<?php echo $data['id']; ?>">
                                    <i class="fa fa-trash"></i> Delete 
                                </a>
                            </div>
                        </div><!-- ./col -->

						<?php } ?>






                    </div>
 <?php include 'pagination_footer.php'; ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->




    </body>
</html>

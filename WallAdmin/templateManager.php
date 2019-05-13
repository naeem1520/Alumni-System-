<?php
include_once 'includes.php';
$Template_Order=$WallAdmin->Template_Order();
$templatemanager=1;
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
                       Template Manager

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Template Manager</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 <div class="row">
                        <!-- left column -->
                       		 <div class="col-lg-3 col-xs-6" id="sortable">
                            <!-- small box -->

                <?php
                foreach($Template_Order as $data)
                {
                if($data['t_id']==1)
                $color="flat_new";
                else if($data['t_id']==2)
                $color="bg-red";
                else if($data['t_id']==3)
                $color="flat_yellow";
                else
                $color="flat_sky";
                ?>

							 <div class="templateDrag small-box <?php echo $color; ?>" id="item-<?php echo $data['t_id'] ?>">
                                <div class="inner">

                                    <p>
                                        <?php echo $data['t_name'] ?>
                                    </p>
                                </div>


                            </div>

                            <?php } ?>



                        </div><!-- ./col -->

								 <div class="col-lg-9">
                            <!-- small box -->
                            <div class="small-box flat_black " style="min-height: 365px;">
                                <div class="inner">
                                    <p>
                                       Updates Part
                                    </p>


                                </div>


                            </div>
                        </div><!-- ./col -->

<div class="col-lg-12">
           <!-- small box -->
           <div class="alert alert-success alert-dismissable" id="alert" style="display:none">
           Template order has been saved successfully.</div>
        <p><a href="#" class="save btn btn-success">Save Template</a>


       </div><!-- ./col -->

                        <!-- right column -->

                    </div>



                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->




    </body>
</html>

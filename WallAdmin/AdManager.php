<?php
include_once 'includes.php';
$Advertisments=$WallAdmin->Advertisments();
$admanager=1;
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
Event Manager

</h1>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Settings</li>
                </ol>
              </section>

              <!-- Main content -->
              <section class="content">
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                      <div class="box-header">
                        <h3 class="box-title">Create An Event</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->




                      <div class="box-body">
                        <label for="exampleInputPassword1"> Event Type</label>

                        <input type="radio" class="form-control adType" name="adType" id="adTypeBanner" value='0' style="width:20px !important" checked="checked" /> Banner &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="form-control adType" name="adType" id="adTypeGoogle" value='1' style="width:20px !important" /> Google Adsense or Java Script Code
                      </div>
                      



                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Title</label>
                          <input type="text" class="form-control" id="adTitle" placeholder="Ad Title">
                        </div>
                      </div>

                      <div class="box-body" id="adBannerCard">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Description</label>
                          <input type="text" class="form-control" id="adDesc" placeholder="Ad Description">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">URL</label>
                          <input type="text" class="form-control" id="adURL" placeholder="Ad URL">
                          <input type="hidden" id="adImg">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">Banner</label>
                          <form id="bigprofileimageform" method="post" enctype="multipart/form-data" action="ajaxImageUpload.php">
                            <input type="file" id="exampleInputFile" type="file" name="photos">

                        </div>



                      </div>

                      <div class="box-body" id="adGoogleCard" style="display:none">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Java Script Code</label>
                          <textarea rows="10" value="code" id="code" class="form-control"></textarea>
                        </div>
                      </div>


                      <!-- /.box-body -->

                      <div class="box-footer">
                        <a href="#" class="btn btn-success" id="adSave">Save</a>
                      </div>

                    </div>
                    <!-- /.box -->





                  </div>
                  <!--/.col (left) -->


                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-success">
                      <div class="box-header">
                        <h3 class="box-title">Preview</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->


                      <div class="box-body">
                        <div class="blockPreview">
                          <div id="ad_image" class='ad_imagediv'></div>
                          <div> <a href="#" id="suggest_title" class="suggest_title" target="blank">Event Title</a></div>
                          <div id="suggest_url" class="suggest_url">Ad URL</div>
                          <div id="ad_desc" class="ad_desc">Event Description</div>
                        </div>
                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">

                      </div>

                    </div>
                    <!-- /.box -->





                  </div>
                  <!--/.col (left) -->

                  <!-- left column -->

                  <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-success">
                      <div class="box-header">
                        <h3 class="box-title">Event</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->


                      <div class="box-body" id="AdsBlock">

                        <?php
if($Advertisments){
    foreach($Advertisments as $data)
    {
        if($data['ad_type']<1){
            ?>
                          <div class="blockPreview" id="adBlock<?php echo $data['a_id'];  ?>">
                            <a href="#" id="<?php echo $data['a_id'];  ?>" class="adDelete">X</a>
                            <div class='ad_imagedivx'><img src="<?php echo $base_url.$upload_path.$data['a_img']; ?>" style="height: 150px;width:228px"></div>
                            <div>
                              <a href="<?php echo $data['a_url']; ?>" class="suggest_title" target="blank">
                                <?php echo $data['a_title']; ?>
                              </a>
                            </div>
                            <div class="suggest_url">
                              <?php echo $data['a_url']; ?>
                            </div>
                            <div class="ad_desc">
                              <?php echo $data['a_desc']; ?>
                            </div>

                          </div>

                          <?php }
        
        else { ?>

          <div class="blockPreview" id="adBlock<?php echo $data['a_id'];  ?>">
                            <a href="#" id="<?php echo $data['a_id'];  ?>" class="adDelete">X</a>
                            <div class='ad_imagedivx' style="width:228px;height: 170px;">Ad Java Script Code</div>
                            <div>
                              <a href="<?php echo $data['a_url']; ?>" class="suggest_title" target="blank">
                                <?php echo $data['a_title']; ?>
                              </a>
                            </div>
                            

                          </div>
      
      <?php
        }  
    }?>

                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">

                      </div>

                    </div>
                    <!-- /.box -->
                  </div>
                  <!--/.col (left) -->
                  <?php } ?>


                </div>


              </section>
              <!-- /.content -->
            </aside>
            <!-- /.right-side -->
        </div>
        <!-- ./wrapper -->




    </body>

  </html>
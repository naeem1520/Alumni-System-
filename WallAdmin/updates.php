<?php
include_once 'includes.php';
include_once 'pagination_header.php';
$Updates_Details_Array=$WallAdmin->Updates_Details($start,$per_page);
$Updates_Count=$WallAdmin->Updates_Count();
$count = $Updates_Count;
$no_of_paginations = ceil($count / $per_page);
$updates=1;
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
                       User Updates

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Messages</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                  <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Messages</h3>
                                    <a href="http://localhost/wallscript/WallAdmin/admin_post.php">Add Post</a>
                                    <div class="pull-right searchBlock">
                                    <form method="post" action="">
                                    <input type="text" value="" name="searchKey" rel="update" id="searchInput" placeholder="Search"/>
                                   <input type="submit" class="btn-success" value=" Search " rel="updates" id="searchButton"/>
                                    </form>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body" id="updatesSearchResults" style="display:none">
                                     <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">Post serial</th>
                                            <th>UserId</th>
                                            <th>User</th>
                                            <th>Message</th>
                                            <th>Preview</th>
                                            <th>IP Address</th>

                                            <th style="width: 150px">Actions</th>

                                        </tr>
                                        <tbody id="tbody"></tbody></table>

                                </div>
                                <div class="box-body" id="updatesResults">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">Post serial</th>
                                            <th>UserId</th>
                                            <th>User</th>
											<th>Message</th>
                                            <th>Preview</th>
                                            <th>IP Address</th>

											<th style="width: 150px">Actions</th>

                                        </tr>
										<?php
										foreach($Updates_Details_Array as $data)
										{
										?>
                                        <tr id="updates<?php echo $data['msg_id']; ?>">
                                         <td ><?php echo $data["msg_id"] ?></td>
										 <td ><?php echo $data["userid"] ?></td>

                                            <td><a href="<?php echo $base_url.$data['username']; ?>" target="_blank"><?php echo $data['username']; ?></a></td>
											<td class="textContent"><?php echo htmlcode($data['message']); ?><br/>
											
											
											</td>
                                             <td>
                                               <a href="<?php echo $base_url.'status/'.$data["msg_id"]; ?>" target="_blank">View</a>
                                           </td>
                                           <td>
                                               <?php echo $data['ip']; ?>
                                           </td>
											<td> <a href="#" class="btn btn-danger btn-sm updateDelete" id="<?php echo $data["msg_id"] ?>"><i class="fa fa-trash"></i> Delete</a></td>

                                        </tr>
										<?php } ?>




                                    </table>

                                    <?php
                                    if(empty($Updates_Details_Array))
                                    {
                                    echo '<div id="noResults">No Results</div>';
                                    }
                                    ?>
                                </div><!-- /.box-body -->
                              <?php include 'pagination_footer.php'; ?>
      </div><!-- /.box -->


                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->




    </body>
</html>

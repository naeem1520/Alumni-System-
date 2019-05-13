<?php
include_once 'includes.php';
include_once 'pagination_header.php';
$Users_Details_Array=$WallAdmin->Blocked_Users_Details($start,$per_page);
$Users_Count=$WallAdmin->Users_Count();
$count = $Users_Count;
$no_of_paginations = ceil($count / $per_page);
$blockuser=1;
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
                      Users

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blocked Users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                  <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Blocked Users</h3>
                                    <div class="pull-right searchBlock">
                                    <form method="post" action="">
                                    <input type="text" value="" name="searchKey" rel="blocked_user" id="searchInput" placeholder="Search"/>
                                   <input type="submit" class="btn-success" value=" Search " rel="blocked_user" id="searchButton"/>
                                    </form>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body" id="blocked_userSearchResults" style="display:none">
                                            <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">serial no</th>
                                            <th>UserId</th>
                                            <th>UserName</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone No.</th>
                                            <th>Workplace</th>
                                            <th>User Type</th>
                                            <th>Status</th>
                                            <th>Verified</th>
                                            <th>Actions</th>

                                        </tr>
                                        <tbody id="tbody">
                                            


                                        </tbody>

                                        </table>


                                </div>
                                <div class="box-body" id="blocked_userResults">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>UserId</th>
                                            <th>UserName</th>
											<th>Full Name</th>
                                            <th>Email</th>
                                             <th>Phone No.</th>
                                             <th>Workplace</th>
                                            <th>User Type</th>
											<th>Status</th>
											<th>Verified</th>
											<th>Actions</th>

                                        </tr>
										<?php

										foreach($Users_Details_Array as $data)
										{

										?>
                                        <tr id="users<?php echo $data['uid']; ?>">
										 <td style="width: 10px">serial no</td>
                                         <td><?php echo $data['userid']; ?></td>
                                            <td><?php echo $data['username']; ?></td>
											<td>
											<?php echo $data['name']; ?>

											</td>
                                            <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['googleProfile']; ?></td>
									<td><?php echo $data['bio']; ?></td>
                                            <td>
											<?php if($data['provider']) { ?>
											<span class="label label-primary">Social</span>
											<?php }  ?>
											</td>
											<td>
											<?php if($data['name']) { ?>
											<span class="label label-success">Complete</span>
											<?php } ?>
											</td>
											<td>
											<?php if($data['verified']) { ?>
											<span class="label label-blue">Verified</span>
											<?php }?>
											</td>
											<td>
											<a href="#" class="btn btn-danger btn-sm delete" id="<?php echo $data['uid']; ?>" rel="">Delete</a>
											<a href="#" class="btn btn-warning btn-sm block" id="<?php echo $data['uid']; ?>" rel="1">Unblock</a>
											</td>

                                        </tr>
										<?php }
                    ?>



                                    </table>
                              <?php
                              if(empty($Users_Details_Array))
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

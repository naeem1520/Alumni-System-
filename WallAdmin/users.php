<?php
include_once 'includes.php';
include_once 'pagination_header.php';
$Users_Details_Array=$WallAdmin->Users_Details($start,$per_page);
$Users_Count=$WallAdmin->Users_Count();
$count = $Users_Count;
$no_of_paginations = ceil($count / $per_page);
$user=1;


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
                        <li class="active">Users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                  <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Users</h3>

                                    <div class="pull-right searchBlock">
                                    <form method="post" action="">
                                    <input type="text" value="" name="searchKey"  id="searchInput" placeholder="Search"/>
                                    <input type="submit" class="btn-success wallbutton" value=" Search " rel="user" id="searchButton"/>
                                    </form>
                                    </div>


                                </div><!-- /.box-header -->

                                <div class="box-body" id="userSearchResults" style="display:none">
                                    
                                     <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">Serial No</th>
                                            <th>UserId</th>
                                            <th>UserName</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Workplace</th>
                                            <th>User Type</th>
                                            <th >Status</th>
                                            <th>Verified</th>
                                            <th >Actions</th>

                                        </tr>
                                        <tbody id="tbody">
                                            


                                        </tbody>


                                        </table>
                                </div>


                                <div class="box-body" id="userResults">
                                    <div id="pnt">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">Serial No</th>
                                            <th>UserId</th>
                                            <th>UserName</th>
											<th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
											<th>Workplace</th>
                                            <th class="hideforpdf">User Type</th>
											<th class="hideforpdf">Status</th>
											<th class="hideforpdf">Verified</th>
											<th class="hideforpdf">Actions</th>

                                        </tr>
										<?php
										foreach($Users_Details_Array as $data)
										{

										?>
                                        <tr id="users<?php echo $data['uid']; ?>">
										 <td style="width: 5px"><?php echo $data['uid']; ?> </td>
                                          
                                          <td><?php echo $data['userid']; ?></td>

                                            <td><a href="<?php echo $base_url.$data['username']; ?>" target="_blank"><?php echo $data['username']; ?></a></td>
											<td>
											<?php echo $data['name']; ?>

											</td>
                                            <td><?php echo $data['email']; ?></td>

            								<td><?php echo $data['googleProfile']; ?></td>

                                            <td><?php echo $data['bio']; ?></td>
                                            <td class="hideforpdf">
                                                
											<?php if($data['provider']) { ?>
											<span class="label label-primary">Social</span>
											<?php } ?>
											</td>
											<td class="hideforpdf">
											<?php if($data['name']) { ?>
											<span class="label label-success">Complete</span>
											<?php } ?>
											</td>
											<td class="hideforpdf" id="verified<?php echo $data['uid'];?>">
											<?php if($data['verified']) { ?>
											<span class="label label-blue"><i class="fa fa-star"></i> Verified</span>
											<?php }?>
											</td>
											<td class="hideforpdf">
											<a href="#" class="btn btn-danger btn-sm block" id="<?php echo $data['uid']; ?>" rel=""><i class="fa fa-ban"></i> Block</a>&nbsp;&nbsp;&nbsp;
											<?php if($data['verified']=='0') { ?>
											<a href="#" class="btn btn-info btn-sm verified" id="<?php echo $data['uid']; ?>" rel=""><i class="fa fa-star-o"></i> Verify</a>
											<?php } ?>
											</td>

                                        </tr>
										<?php } ?>



                                    </table>
                                    </div>
                                </div><!-- /.box-body -->
                                <center><tr>
                <td colspan="2" align="center"><input type="submit" value="Print" class="button" onclick="prnt()"></td>
            </tr></center>
								<?php include 'pagination_footer.php'; ?>
      </div><!-- /.box -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

 <script>
            function prnt(){
                var div="<html><head><style> .hideforpdf{display: none;}td{text-align:center;}table{border: 1px solid black;float: center;}table tr{border: 1px solid black;}table tr td{border: 1px solid black;}table tr th{border: 1px solid black;}</style></head><body>"
                div+=document.getElementById('pnt').innerHTML;
                div+="</body></html>"
                var win=window.open("", "", "width=960,height=500");
                win.document.write("");
                win.document.write(div);
                win.document.write("");
                win.print();
            }
        </script>


    </body>
</html>

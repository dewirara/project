<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

if($_GET['action']='del')
{
$userid=intval($_GET['uid']);
$query=mysqli_query($con,"DELETE FROM `admintable` WHERE `admintable`.`userid` = ".$_GET['uid']);
if($query)
{
$msg="User deleted ";
}
else{
$error="Something went wrong . Please try again.";    
} 
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <title>DEWI NEWS | Manage Users</title>
		<link rel="stylesheet" href="../plugins/morris/morris.css">
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />\
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">
        <div id="wrapper">
           <?php include('includes/topheader.php');?>
           <?php include('includes/leftsidebar.php');?>
            <div class="content-page">
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Manage Posts </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Users</a>
                                        </li>
                                        <li class="active">
                                            Manage User  
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                         

                                    <div class="table-responsive">
<table class="table table-colored table-centered table-inverse m-0">
<thead>
<tr>
 
<th>Image</th>                                          
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
</tr>
</thead>
<tbody>
    
<?php
$query=mysqli_query($con,"select userid, userimage, username, useremail, userpass, userrole, userstatus from admintable");
$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>
<tr>

<td colspan="4" align="center"><h3 style="color:red">No record found</h3></td>
<tr>
<?php 
} else {
while($row=mysqli_fetch_array($query))
{

    $src = "userimage/".$row['userimage'];
?>
 <tr>
<td><?php echo '<img src="'. $src .'" alt="Random image" ,width=100px, height=100px /><br>';?></td>
<td><b><?php echo htmlentities($row['username']);?></b></td>
<td><?php echo htmlentities($row['useremail'])?></td>
<td><?php if($row['userrole']==1){echo "Admin";} else if($row['userrole']==2){echo "Manager";}else{echo "Customer";}?></td>
<td><?php if($row['userstatus']==1){echo "Active";} 
        else if($row['userstatus']==0){echo "Inactive";}?></td>

<td><a href="edit-user.php?uid=<?php echo htmlentities($row['userid']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> 
    &nbsp;<a href="manage-user.php?uid=<?php echo htmlentities($row['userid']);?>&&action=del" onclick="return confirm('Do you reaaly want to delete ?')"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
 </tr>
<?php } }?>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div> 

                </div>

       <?php include('includes/footer.php');?>

            </div>
        </div>
        <script>
            var resizefunc = [];
        </script>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>
		<script src="../plugins/morris/morris.min.js"></script>
		<script src="../plugins/raphael/raphael-min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../plugins/jvectormap/gdp-data.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
		<script src="assets/pages/jquery.blog-dashboard.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>
<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

if($_GET['action']=='done')
{
$appid=intval($_GET['apid']);
$query=mysqli_query($con,"update appointment_table set app_status='0' where app_id='$appid'");
if($query)
{
$msg="Appointment Updated ";
}
else{
$error="Something went wrong . Please try again.";    
} 
}

if($_GET['action']=='addcust')
{
$appid=intval($_GET['apid']);
$queryaddcust=mysqli_query($con,"select app_id, app_name, app_email, app_subject, app_msg, app_status from appointment_table where app_id='$appid'");
while($rowcust=mysqli_fetch_array($queryaddcust))
{
$name = $rowcust['app_name'];
$email = $rowcust['app_email'];
$status = 0;
$role = 3;
$pass = 'abcdefghij';
$pass = md5($pass);
$userimage = '';

    $checkqyery = mysqli_query($con, "SELECT `useremail` FROM `admintable` WHERE `useremail` = '".$email."'") or exit(mysqli_error($con));

    if(mysqli_num_rows($checkqyery)) {
        $error='This email is already being used';  
    }else{
        $querycustadd=mysqli_query($con,"insert into `admintable`(username,useremail,userpass,userrole,userstatus,userimage) values('$name','$email','$pass','$role','$status','$userimage')");
        $querydone=mysqli_query($con,"update appointment_table set app_status='0' where app_id='$appid'");
        if($querycustadd){
            $msg="User successfully added ";
            $mail_msg = "Hi " . $name .".";          
            $mail_msg = "We have created a customer id as per your request to post advertisement in our site.";
            $mail_msg = "Your Username is " . $name .".";            
            $mail_msg = "Your Password is " . $pass .".";            
            $mail_msg = "Thank You";            
            mail($email, 'Customer', $mail_msg);
        }
        else{
            $error="Something went wrong . Please try again.";    
        } 
    }
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
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
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
                                            <a href="#">Appointments</a>
                                        </li>
                                        <li class="active">
                                            Manage Appointments  
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
                                          
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Message</th>
<th>Status</th>
</tr>
</thead>
<tbody>
    
<?php
$query=mysqli_query($con,"select app_id, app_name, app_email, app_subject, app_msg, app_status from appointment_table where app_status=1");
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
<td><b><?php echo htmlentities($row['app_name']);?></b></td>
<td><?php echo htmlentities($row['app_email'])?></td>
<td><?php echo htmlentities($row['app_subject'])?></td>
<td><?php echo htmlentities($row['app_msg'])?></td>
<td><?php echo 'Pending';?></td>
<td>
    <a href="edit-appointment.php?apid=<?php echo htmlentities($row['app_id']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> 
    &nbsp;<a href="appointments.php?apid=<?php echo htmlentities($row['app_id']);?>&&action=done"> <i class="fa fa-check" style="color: #006400"></i></a> </td>
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
     \



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
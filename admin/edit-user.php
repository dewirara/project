<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if(isset($_POST['update']))
{
$username=$_POST['username'];
$useremail=$_POST['useremail'];
$userpass=$_POST['userpass'];
$userrole=$_POST['userrole'];
$userstatus=$_POST['userstatus'];
$imgfile=$_FILES["userimage"]["name"];
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
$userid=intval($_GET['uid']);

if(!in_array($extension,$allowed_extensions) && $imgfile != null)
        {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }
        else
        {
            if($imgfile != null){
                $imgnewfile=md5($imgfile).".".$extension;
                move_uploaded_file($_FILES["userimage"]["tmp_name"],"userimage/".$imgnewfile);
                $query=mysqli_query($con,"update admintable set username='$username', useremail='$useremail', userpass='$userpass', userrole='$userrole', userstatus='$userstatus', userimage='$imgnewfile' where userid='$userid'");
            }else{
                $query=mysqli_query($con,"update admintable set username='$username', useremail='$useremail', userpass='$userpass', userrole='$userrole', userstatus='$userstatus' where userid='$userid'");
            }

            

            if($query)
                {
                $msg="User updated ";
                }
                else{
                $error="Something went wrong . Please try again.";    
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
        <title>DEWI NEWS | Add User</title>
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
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
                                    <h4 class="page-title">Edit User </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"> Users </a>
                                        </li>
                                        <li class="active">
                                            Add User
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
<div class="row">
<div class="col-sm-6">  
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div>

<?php
$userid=intval($_GET['uid']);
$query=mysqli_query($con,"select userimage, username, useremail, userpass, userrole, userstatus from admintable where userid=$userid");
while($row=mysqli_fetch_array($query))
{
?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="editpost" method="post" enctype="multipart/form-data">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">User Name</label>
<input type="text" class="form-control" id="username" value="<?php echo htmlentities($row['username']);?>" name="username" placeholder="Enter User Name" required>
</div>
    <div class="form-group m-b-20">
        <label for="exampleInputEmail1">User Email</label>
        <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Enter User Email" value="<?php echo htmlentities($row['useremail']);?>" required>
    </div>
    
    <div class="form-group m-b-20">
        <label for="exampleInputEmail1">User Password</label>
        <input type="text" class="form-control" id="userpass" name="userpass" placeholder="Enter User Password" value="<?php echo htmlentities($row['userpass']);?>" required>
    </div>

    <div class="form-group m-b-20">
        <label for="exampleInputEmail1">User Role</label>
        <select class="form-control" name="userrole" id="userrole" onChange="getUserRole(this.value);" required>
            <option value="1" <?php if($row['userrole']==1){echo "selected";} ?>>Admin </option>
            <option value="2" <?php if($row['userrole']==2){echo "selected";} ?>> Manager </option>
            <option value="3" <?php if($row['userrole']==3){echo "selected";} ?>> Customer </option>
        </select> 
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-b-30 m-t-0 header-title"><b>User Status</b></h4>
                <select class="form-control" name="userstatus" id="userstatus" onChange="getUserStat(this.value);" required>
                    <option value="1" <?php if($row['userstatus']==1){echo "selected";} ?>>Active </option>
                    <option value="0" <?php if($row['userstatus']==0){echo "selected";} ?>> Inactive </option>
                </select> 
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-b-30 m-t-0 header-title"><b>User Image</b></h4>
                <img src="userimage/<?php echo htmlentities($row['userimage']);?>" width="300"/>
                <input type="file" class="form-control" id="userimage" name="userimage" value="<?php  echo $row['userimage']; ?>" >
            </div>
        </div>
    </div>

<?php } ?>

<button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>
</form>

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
        <script src="../plugins/summernote/summernote.min.js"></script>
        <script src="../plugins/select2/js/select2.min.js"></script>
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>
        <script src="assets/pages/jquery.blog-add.init.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>

            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 240,                
                    minHeight: null,           
                    maxHeight: null,             
                    focus: false                
                });
               
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
  <script src="../plugins/switchery/switchery.min.js"></script>
        <script src="../plugins/summernote/summernote.min.js"></script>



    </body>
</html>
<?php } ?>
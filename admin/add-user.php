<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
	header('location:index.php');
}
else{

	if(isset($_POST['submit']))
	{
		$username=$_POST['username'];

		$useremail=$_POST['useremail'];
		$userpass=$_POST['userpass'];
		$userrole=$_POST['userrole'];
		$userstatus=$_POST['userstatus'];
		$imgfile=$_FILES["userimage"]["name"];
		$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
		$allowed_extensions = array(".jpg","jpeg",".png",".gif");
		
		if(!in_array($extension,$allowed_extensions))
		{
			echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
		}
		else
		{
			$imgnewfile=md5($imgfile).".".$extension;
			move_uploaded_file($_FILES["userimage"]["tmp_name"],"userimage/".$imgnewfile);

			$checkqyery = mysqli_query($con, "SELECT `useremail` FROM `admintable` WHERE `useremail` = '".$useremail."'") or exit(mysqli_error($con));

			if(mysqli_num_rows($checkqyery)) {
			    $error='This email is already being used';  
			}else{
				$query=mysqli_query($con,"insert into `admintable`(username,useremail,userpass,userrole,userstatus,userimage) values('$username','$useremail','$userpass','$userrole','$userstatus','$imgnewfile')");
				if($query){
					$msg="User successfully added ";
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
		<script>
			function getSubCat(val) {
				$.ajax({
					type: "POST",
					url: "get_subcategory.php",
					data:'catid='+val,
					success: function(data){
						$("#subcategory").html(data);
					}
				});
			}
		</script>
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
									<h4 class="page-title">Add User </h4>
									<ol class="breadcrumb p-0 m-0">
										<li>
											<a href="#">User</a>
										</li>
										<li>
											<a href="#">Add User </a>
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


							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="p-6">
										<div class="">
											<form name="adduser" method="post" enctype="multipart/form-data">
												<div class="form-group m-b-20">
													<label for="exampleInputEmail1">User Name</label>
													<input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" required>
												</div>
												<div class="form-group m-b-20">
													<label for="exampleInputEmail1">User Email</label>
													<input type="text" class="form-control" id="useremail" name="useremail" placeholder="Enter User Email" required>
												</div>

												<div class="form-group m-b-20">
													<label for="exampleInputEmail1">User Password</label>
													<input type="text" class="form-control" id="userpass" name="userpass" placeholder="Enter User Password" required>
												</div>



												<div class="form-group m-b-20">
													<label for="exampleInputEmail1">User Role</label>
													<select class="form-control" name="userrole" id="userrole" onChange="getUserRole(this.value);" required>
														<option value="1">Admin </option>
														<option value="2"> Manager </option>
														<option value="3"> Customer </option>
													</select> 
												</div>

												<div class="row">
													<div class="col-sm-12">
														<div class="card-box">
															<h4 class="m-b-30 m-t-0 header-title"><b>User Status</b></h4>
															<select class="form-control" name="userstatus" id="userstatus" onChange="getUserStat(this.value);" required>
																<option value="1">Active </option>
																<option value="0"> Inactive </option>
															</select> 
														</div>
													</div>
												</div>


												<div class="row">
													<div class="col-sm-12">
														<div class="card-box">
															<h4 class="m-b-30 m-t-0 header-title"><b>User Image</b></h4>
															<input type="file" class="form-control" id="userimage" name="userimage"  required>
														</div>
													</div>
												</div>


												<button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save</button>
												<button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
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
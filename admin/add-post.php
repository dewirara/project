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
        $posttitle = $_POST['posttitle'];
        $catid = $_POST['category'];
        $postdetails = $_POST['postdetails'];
        $poststatus = $_POST['post_status'];
        $posttype = $_POST['post_type'];
        $cancomment = $_POST['can_comment'];
        $post_date = date("Y/F/d");
        $post_user = $_SESSION['login'];
        $arr = explode(" ",$posttitle);
        $url = implode("-",$arr);
        $imgfile = $_FILES["postimage"]["name"];

        
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
        if(!in_array($extension,$allowed_extensions)&& strcmp($posttype, 'coupon') == 0)
        {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }
        else
        {
            if($extension=='jpeg'){
            $imgnewfile=md5($imgfile).".".$extension;
            }else{
                $imgnewfile=md5($imgfile).$extension;
            }
            move_uploaded_file($_FILES["postimage"]["tmp_name"],"postimages/".$imgnewfile);
            $query=mysqli_query($con,"insert into post_table(post_title,post_content,post_cat,post_user,post_date,can_comment,post_status,post_type, post_image) values('$posttitle','$postdetails','$catid','$post_user','$post_date','$cancomment', '$poststatus','$posttype','$imgnewfile')");
            if($query)
            {
                $msg="Post successfully added ";
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

        <title>DEWI NEWS | Add Post</title>

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
                            <h4 class="page-title">Add Post </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="#">Post</a>
                                </li>
                                <li>
                                    <a href="#">Add Post </a>
                                </li>
                                <li class="active">
                                    Add Post
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
                                    <form name="addpost" method="post" enctype="multipart/form-data">
                                     <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Post Title</label>
                                        <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter title" required>
                                    </div>



                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select class="form-control" name="category" id="category" >
                                            <option value="">Select Category </option>
                                            <?php
                                            $ret=mysqli_query($con,"select cat_id,cat_name from  category_table");
                                            while($result=mysqli_fetch_array($ret))
                                            {    
                                                ?>
                                                <option value="<?php echo htmlentities($result['cat_id']);?>"><?php echo htmlentities($result['cat_name']);?></option>
                                            <?php } ?>

                                        </select> 
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                         <div class="card-box">
                                            <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                            <textarea class="summernote" name="postdetails"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group m-b-20">
                                    <label for="exampleInputEmail1">Post Status</label>
                                    <select class="form-control" name="post_status" id="post_status" >
                                        <option value=""> Select Post Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Banned</option>
                                    </select> 
                                </div>

                                <div class="form-group m-b-20">
                                    <label for="exampleInputEmail1">Post Type</label>
                                    <select class="form-control" name="post_type" id="post_type" >
                                        <option value="">Select Post Type </option>
                                        <option value="news">News</option>
                                        <option value="breaking_news">Breaking News</option>
                                    </select> 
                                </div>

                                <div class="form-group m-b-20">
                                    <label for="exampleInputEmail1">Can Anyone Comment on This Post?</label>
                                    <select class="form-control" name="can_comment" id="can_comment" >
                                        <option value=""> Select An Option </option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select> 
                                </div>


                                <div class="row">
                                    <div class="col-sm-12">
                                     <div class="card-box">
                                        <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                        <input type="file" class="form-control" id="postimage" name="postimage">
                                    </div>
                                </div>
                            </div>


                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save and Post</button>
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
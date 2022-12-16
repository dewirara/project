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
        $posttitle = $_POST['posttitle'];
        $catid = $_POST['category'];
        $postdetails = $_POST['postdetails'];
        $poststatus = $_POST['post_status'];
        $posttype = $_POST['post_type'];
        $cancomment = $_POST['can_comment'];
        $post_date = date("Y/m/d");
        $arr = explode(" ",$posttitle);
        $url=implode("-",$arr);
        $status=1;
        $postid=intval($_GET['pid']);
        $query=mysqli_query($con,"update post_table set post_title='$posttitle',post_cat='$catid',post_content='$postdetails',post_status='$poststatus', can_comment='$cancomment', post_type='$posttype', post_date='$post_date' where post_id='$postid'");
        if($query)
        {
            $msg="Post updated ";
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
                            <h4 class="page-title">Edit Post </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="#">Admin</a>
                                </li>
                                <li>
                                    <a href="#"> Posts </a>
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

                    <?php
                    $postid=intval($_GET['pid']);
                    $query=mysqli_query($con,"select post_id, post_title ,post_cat,post_content, post_status, can_comment, post_type, post_image from post_table where post_id='$postid'");
                    while($row=mysqli_fetch_array($query))
                    {
                        ?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
                                         <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Post Title</label>
                                            <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['post_title']);?>" name="posttitle" placeholder="Enter title" required>
                                        </div>



                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                                <?php 
                                                $catid=intval($row['post_cat']);
                                                $querycat=mysqli_query($con,"Select cat_id,cat_name from  category_table where cat_id='$catid'"); 
                                                while($rowcat=mysqli_fetch_array($querycat))
                                                {
                                                    ?>
                                                    <option value="<?php echo htmlentities($rowcat['cat_id']);?>"><?php echo htmlentities($rowcat['cat_name']);?></option>
                                                <?php }

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
                                                <textarea class="summernote" name="postdetails" required><?php echo htmlentities($row['post_content']);?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Post Status</label>
                                        <select class="form-control" name="post_status" id="post_status" required>
                                            <option value=""> Select Post Status</option>
                                            <option value="1" <?php if($row['post_status']==1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($row['post_status']==0){echo "selected";} ?>>Banned</option>
                                        </select> 
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Post Type</label>
                                        <select class="form-control" name="post_type" id="post_type" required>
                                            <option value="">Select Post Type </option>
                                            <option value="news" <?php if($row['post_type']=='news'){echo "selected";} ?>>News</option>
                                            <option value="breaking_news" <?php if($row['post_type']=='breaking_news'){echo "selected";} ?>>Breaking News</option>
                                        </select> 
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Can Anyone Comment on This Post?</label>
                                        <select class="form-control" name="can_comment" id="can_comment" required>
                                            <option value=""> Select An Option </option>
                                            <option value="1" <?php if($row['can_comment']==1){echo "selected";} ?>>Yes</option>
                                            <option value="0" <?php if($row['can_comment']==0){echo "selected";} ?>>No</option>
                                        </select> 
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                         <div class="card-box">
                                            <h4 class="m-b-30 m-t-0 header-title"><b>Post Image</b></h4>
                                            <img src="postimages/<?php echo$row['post_image'];?>" width="300"/>
                                            <br />
                                            <a href="change-image.php?pid=<?php echo htmlentities($row['post_id']);?>">Update Image</a>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>

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
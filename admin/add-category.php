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
        $category=$_POST['category'];
        $query=mysqli_query($con,"insert into category_table(cat_name) values('$category')");
        if($query)
        {
            $msg="Category created ";
        }
        else{
            $error="Something went wrong . Please try again.";    
        } 
    }

    if($_GET['action']=='del' && $_GET['rid'])
    {
       $cat_id=intval($_GET['rid']);
       $query=mysqli_query($con,"delete from  category_table  where cat_id='$cat_id'");
       $delmsg="Category deleted forever";
    }

    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>

        <title>DEWI NEWS | Add Category</title>

        <!-- App css -->
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
                                    <h4 class="page-title">Add Category</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Category </a>
                                        </li>
                                        <li class="active">
                                            Add Category
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                       </div>
                       <div class="row">
                        <div class="col-sm-4">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Add Category </b></h4>
                                <hr />

                                </div>
                                <div class="row">
                                    <div class="col-xs-12">    
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
                                    <br>
                                    <div class="col-xs-12">
                                        <form class="form-horizontal" name="category" method="post">
                                            <div class="form-group">
                                                <div class="col-sm-2 control-label">
                                                   <label >Category</label> 
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" value="" name="category" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">&nbsp;</label>
                                                <div class="col-md-10">

                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                            </div>
                            <div class="col-sm-8">
                             <div class="demo-box m-t-20">
                                <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query=mysqli_query($con,"Select cat_id,cat_name from  category_table");
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo htmlentities($row['cat_id']);?></th>
                                                    <td><?php echo htmlentities($row['cat_name']);?></td>
                                                    <td><a href="edit-category.php?cid=<?php echo htmlentities($row['cat_id']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> 
                                                       &nbsp;<a href="add-category.php?rid=<?php echo htmlentities($row['cat_id']);?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
                                                   </tr>
                                                   <?php
                                               } ?>
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

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
    </html>
    <?php } ?>
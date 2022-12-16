<?php 
session_start();
  include('config.php');
  error_reporting(0);

        $name = $_POST['com_user'];
        $message = $_POST['com_content'];
        $post_id = $_POST['com_post'];
        $com_date = date("Y-m-d H:i:s");
        $query=mysqli_query($con,"insert into 
            `comment_table`(com_name,post_id,com_content,com_date) values('$name','$post_id','$message','$com_date')");
        if($query)
        {
            $msg="Appointment Submitted ";
            echo success_result($name, $message, $com_date);
        }
        else{
            $error="Something went wrong . Please try again.";   
            echo $error;
        }
    ?>
    <?php
 function success_result($name, $message, $com_date){
    ?>
    <div class="comment-list">
    <div class="single-comment justify-content-between d-flex">
      <div class="user justify-content-between d-flex">
        <div class="thumb">
          <img src="img/placeholder.jpg" alt="" height="42" width="42">
        </div>
        <div class="desc">
          <h5><a href="#"><?php echo $name; ?></a></h5>
          <p class="date"><?php echo $com_date; ?> </p>
          <p class="comment">
            <?php echo $message; ?>
          </p>
        </div>
      </div>
   </div>
 </div>
 <?php } ?>
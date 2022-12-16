<?php
session_start();
  include('includes/config.php');
  include('functions.php');
  error_reporting(0);

  if(isset($_POST['submit']))
    {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $status = 1;
        $query=mysqli_query($con,"insert into `appointment_table`(app_name,app_email,app_subject,app_msg,app_status) values('$name','$email','$subject','$message','$status')");
        if($query)
        {
            $msg="Appointment Submitted ";
        }
        else{
            $error="Something went wrong . Please try again.";    
        } 

    }
    ?>
<?php
include('header.php');
?>
<section class="blog-post-area section-gap relative">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <?php
              $query=mysqli_query($con,"select post_id, post_image, post_title, post_content, post_cat, post_user, post_status, post_date, post_type, can_comment from post_table where post_status=1");

              $row=mysqli_num_rows($query);
              if($row!=0)
              {
                while($rowposts=mysqli_fetch_array($query)){
                 $src = "admin/postimages/".$rowposts['post_image'];
            ?>
            <div class="single-amenities">
              <div class="amenities-thumb">
                <img
                class="img-fluid w-100"
                src="<?php echo $src; ?>"
                alt=""
                />
              </div>
              <div class="amenities-details">
                <h5>
                  <a href="single.php?postid=<?php echo htmlentities($rowposts['post_id']);?>"
                  ><?php echo $rowposts['post_title']; ?>
                </a>
              </h5>
              <div class="amenities-meta mb-10">
                <a href="single.php?postid=<?php echo htmlentities($rowposts['post_id']);?>" class=""
                ><span class="ti-calendar"></span><?php echo $rowposts['post_date']; ?></a
                >
                <?php getNumberComments($con,$rowposts['post_id']) ?>
                >
              </div>
              <p>
                <?php echo $rowposts['post_content']; ?>
              </p>

              <div class="d-flex justify-content-between mt-20">
                <div>
                  <a href="single.php?postid=<?php echo htmlentities($rowposts['post_id']);?>" class="blog-post-btn">
                    Read More <span class="ti-arrow-right"></span>
                  </a>
                </div>
                <?php getCtegoryNameIndex($con, $rowposts['post_cat']); ?>
              </div>
            </div>
          </div>
          <?php 
            }
           } 
          ?>
      </div>
</div>
</div>

</div>
</div>
</div>
</section>
<?php
include('footer.php');
?>
<?php
session_start();
include('includes/config.php');
error_reporting(0);
include('header.php');
include('functions.php');
?>

<section class="banner-area relative">
  <div class="overlay overlay-bg"></div>
  <div class="banner-content text-center">
    <h1>Archive Page</h1>
    <p>
      DEWI NEWS 
    </p>
  </div>
</section>
<section class="blog-post-area section-gap relative">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <?php

            if($_GET['action']=='catsearch'){
              $query=mysqli_query($con,"select post_cat,post_id, post_image, post_title, post_content, post_user, post_status, post_date, post_type, can_comment from post_table where post_cat LIKE '%{$_GET['val']}%' and post_status=1");
            }else if($_GET['action']=='yearsearch' || $_GET['action']=='mnthsearch'){
              $query=mysqli_query($con,"select post_cat,post_id, post_image, post_title, post_content, post_user, post_status, post_date, post_type, can_comment from post_table where post_date LIKE '%{$_GET['val']}%' and post_status=1");

            }else if($_GET['action']=='authsearch'){
              $query=mysqli_query($con,"select post_cat,post_id, post_image, post_title, post_content, post_user, post_status, post_date, post_type, can_comment from post_table where post_user LIKE '%{$_GET['val']}%' and post_status=1");
              
            }else if(isset($_GET['textsearch'])){
              $query=mysqli_query($con,"select post_cat,post_id, post_image, post_title, post_content, post_user, post_status, post_date, post_type, can_comment from post_table where post_title LIKE '%{$_GET['textsearch']}%' and post_status=1");
              
            }else{
              $query=mysqli_query($con,"select post_cat,post_id, post_image, post_title, post_content, post_user, post_status, post_date, post_type, can_comment from post_table where post_status=1 LIMIT 3");
            }

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

                    <div class="d-flex justify-content-center mt-10">
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
            }else{
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
                    <a href="#"
                      >No News Found!!!
                    </a>
                  </h5>
                  </div>
                </div>
              <?php 
            } 
            ?>
          </div>
</div>
</div>
</section>
<?php
include('footer.php');
?>
<?php
session_start();
include('includes/config.php');
error_reporting(0);
include('header.php');
include('functions.php');
?>

<section class="home-banner-area relative">
  <div class="container-fluid">
    <div class="row">
      <div class="owl-carousel home-banner-owl">
        <?php
              $query=mysqli_query($con,"select post_id, post_image, post_title from post_table where post_status=1 ORDER BY post_id DESC LIMIT 3");

              $row=mysqli_num_rows($query);
              if($row!=0)
              {
                while($rowposts=mysqli_fetch_array($query)){
                 $src = "admin/postimages/".$rowposts['post_image'];
                 ?>
        <div class="banner-img">
          <img class="img-fluid" src="<?php echo $src; ?>" alt="" />
          <div class="text-wrapper">
            <a href="single.php?postid=<?php echo htmlentities($rowposts['post_id']);?>" class="d-flex">
              <h1>
                <?php echo $rowposts['post_title']; ?>
              </h1>
            </a>
          </div>
        </div>
      <?php }
      } ?>
      </div>
    </div>
  </div>
</section>
<section class="blog-post-area section-gap relative">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <?php
              $query=mysqli_query($con,"select DISTINCT post_cat,post_id, post_image, post_title, post_content, post_user, post_status, post_date, post_type, can_comment from post_table where post_status=1 LIMIT 2");

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
<div class="col-lg-4 sidebar-widgets">
  <div class="widget-wrap">
    <div class="single-sidebar-widget search-widget">
      <form class="search-form" action="#">
        <input placeholder="Search Posts" name="search" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <?php getCtegoryLists($con); ?>

    <div class="single-sidebar-widget share-widget">
      <h4 class="share-title">Share this post</h4>
      <div class="social-icons mt-20">
        <a href="#">
          <span class="ti-facebook"></span>
        </a>
        <a href="#">
          <span class="ti-twitter"></span>
        </a>
        <a href="#">
          <span class="ti-pinterest"></span>
        </a>
        <a href="#">
          <span class="ti-instagram"></span>
        </a>
      </div>
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
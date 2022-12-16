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
    <h1>News Details</h1>
    <p>Details Page For A News</p>
  </div>
</section>
<?php
  
    $postId = $_GET['postid'];
    $can_comment = '';
    $query=mysqli_query($con,"select post_id, post_image, post_title, post_content, post_cat,post_user, post_status, post_date, post_type, can_comment from post_table where post_id=$postId ");

    while($rowposts=mysqli_fetch_array($query)){
        $src = "admin/postimages/".$rowposts['post_image'];
        $can_comment = $rowposts['can_comment'];
?>
<section class="blog_area section-gap single-post-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="main_blog_details">
         <img class="img-fluid" src="<?php echo $src; ?>" alt="">
         <a href="#"><h4><?php echo $rowposts['post_title']; ?></h4></a>
         <div class="user_details">
          <?php getCtegoryName($con, $rowposts['post_cat']); ?>
         <div class="float-right mt-sm-0 mt-3">
           <div class="media">
            <div class="media-body">
             <h5> <?php echo $rowposts['post_user']; ?></h5>
             <p><?php echo $rowposts['post_date']; ?></p>
           </div>
           <div class="d-flex">
             <img src="" alt="">
           </div>
         </div>
       </div>
     </div>
     <p><?php echo $rowposts['post_content']; ?></p>
 </div>
<?php } ?>
<div class="comments-area">
  <?php 
  $querycoment=mysqli_query($con,"select com_name, post_id, com_content, com_date from comment_table where post_id=$postId ");
  $rowcount=mysqli_num_rows($querycoment);
  ?>
  <h4><?php echo $rowcount; if($rowcount>1){?> Comments <?php }else{ ?> Comment <?php } ?></h4>
  <?php
  while($rowcomment=mysqli_fetch_array($querycoment)){
  ?>
  <div class="comment-list">
    <div class="single-comment justify-content-between d-flex">
      <div class="user justify-content-between d-flex">
        <div class="thumb">
          <img src="img/placeholder.jpg" alt="" height="42" width="42">
        </div>
        <div class="desc">
          <h5><a href="#"><?php echo $rowcomment['com_name']; ?></a></h5>
          <p class="date"><?php echo $rowcomment['com_date']; ?> </p>
          <p class="comment">
            <?php echo $rowcomment['com_content']; ?>
          </p>
        </div>
      </div>
   </div>
 </div> 
 <?php } ?>                                            				
</div>
<?php if($can_comment==1){ ?>
<div class="comment-form">
  <h4>Leave a Reply</h4>
  <form class="form-area contact-form text-right"
              id="commentForm"
              action="single.php"
              method="post"
              name="comment">
    <div class="form-group form-inline">
      <div class="form-group col-lg-12 col-md-12 name">
        <input name="com_user" type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
        <input name="com_post" type="hidden" class="form-control" id="com_post" value="<?php echo $postId; ?>">
      </div>									
    </div>
    <div class="form-group">
      <textarea name="com_content" class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
    </div>	
    <button
      type="submit"
        name="submit"
        class="primary-btn text-uppercase com-submit-bt"
      >
        Post Comment
      </button>
  </form>
</div>
<?php } ?>
</div>

<div class="col-lg-4 sidebar-widgets">
  <div class="widget-wrap">
    

   <?php echo getSearchForm($con); ?>

   <?php echo getCtegoryLists($con); ?>
</div>
</div>
</div>
</div>
</div>
</section>
<?php
include('footer.php');
?>
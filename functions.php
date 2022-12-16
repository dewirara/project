<?php


function getCtegoryLists($con){
	?>
  <div class="single-sidebar-widget post-category-widget">
   <h4 class="category-title">Catgories</h4>
   <ul class="cat-list mt-20">
    <?php 
    $querycat=mysqli_query($con,"Select cat_id,cat_name from  category_table");
    while($rowcat=mysqli_fetch_array($querycat))
    {
      ?>
      <li>
        <a href="archive.php?val=<?php echo $rowcat['cat_name'];?>&&action=catsearch" class="d-flex justify-content-between">
          <p><?php echo htmlentities($rowcat['cat_name'])?></p>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>
<?php 
}

function getYearLists($con){
  ?>
  <div class="single-sidebar-widget post-category-widget">
   <h4 class="category-title">Year Lists</h4>
   <ul class="cat-list mt-20">
    <?php 
    $querypost=mysqli_query($con,"select post_date from post_table where post_status=1 ");
    $yeararr = array();
    while($rowpost=mysqli_fetch_array($querypost))
    {
      $yeararr[] = substr($rowpost['post_date'], 0, 4);
    }
    $yeararr = array_unique($yeararr);
    foreach ($yeararr as $value) {
      ?>
      <li>
        <a href="archive.php?val=<?php echo $value;?>&&action=yearsearch" class="d-flex justify-content-between">
          <p><?php echo $value;?></p>
        </a>
      </li>
      <?php
    }
    ?>
  </ul>
</div>
<?php 
}

function getMonthLists($con){
  ?>
  <div class="single-sidebar-widget post-category-widget">
   <h4 class="category-title">Month Lists</h4>
   <ul class="cat-list mt-20">
    <?php 
    $querypost=mysqli_query($con,"select post_date from post_table where post_status=1 ");
    $montharr = array();
    while($rowpost=mysqli_fetch_array($querypost))
    {
      $withoutyear = substr($rowpost['post_date'], 5);
      $montharr[] = substr($withoutyear, 0,-3);
    }
    $montharr = array_unique($montharr);
    foreach ($montharr as $value) {
      ?>
      <li>
        <a href="archive.php?val=<?php echo $value;?>&&action=mnthsearch" class="d-flex justify-content-between">
          <p><?php echo $value;?></p>
        </a>
      </li>
      <?php
    }
    ?>
  </ul>
</div>
<?php 
}

function getAuthorLists($con){
  ?>
  <div class="single-sidebar-widget post-category-widget">
   <h4 class="category-title">Author Lists</h4>
   <ul class="cat-list mt-20">
    <?php 
    $querypost=mysqli_query($con,"select post_user from post_table where post_status=1 ");
    $userarr = array();
    while($rowpost=mysqli_fetch_array($querypost))
    {
      $userarr[] = $rowpost['post_user'];
    }
    $userarr = array_unique($userarr);
    foreach ($userarr as $value) {
      $checkqyery = mysqli_query($con, "SELECT `username` FROM `admintable` WHERE `useremail` = '".$value."'") or exit(mysqli_error($con));
      $rowcheck=mysqli_fetch_array($checkqyery);
      ?>
      <li>
        <a href="archive.php?val=<?php echo $rowcheck['username'];?>&&action=authsearch" class="d-flex justify-content-between">
          <p><?php echo ucfirst($rowcheck['username']); ?></p>
        </a>
      </li>
      <?php
    }
    ?>
  </ul>
</div>
<?php 
}

function getCtegoryName($con, $catId){
  ?>
  <?php 
  $querycat=mysqli_query($con,"Select cat_id,cat_name from  category_table where cat_id = $catId");
  while($rowcat=mysqli_fetch_array($querycat))
  {
    ?>
    <div class="float-left">
      <a href="#"> <?php echo $rowcat['cat_name']; ?></a>
    </div>
  <?php } ?>
  <?php 
}
function getCtegoryNameIndex($con, $catId){
  ?>
  <?php 
  $querycat=mysqli_query($con,"Select cat_id,cat_name from  category_table where cat_id = $catId");
  while($rowcat=mysqli_fetch_array($querycat))
  {
    ?>
    <div class="category">
      <a href="#">
        <span class="ti-folder mr-1"></span> <?php echo $rowcat['cat_name']; ?>
      </a>
    </div>
  <?php } ?>
  <?php 
}

function getNumberComments($con, $postId){
  ?>
  <?php 
  $querycoment=mysqli_query($con,"select com_name, post_id, com_content, com_date from comment_table where post_id=$postId ");
  $rowcount=mysqli_num_rows($querycoment);
  ?>
<a href="#" class="ml-20"
                ><span class="ti-comment"></span><?php echo  $rowcount; ?></a
  <?php
}

function getSearchForm(){
  ?>
<div class="single-sidebar-widget search-widget">
     <form class="search-form" method="get" action="archive.php">
       <input placeholder="Search Posts" name="textsearch" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'">
       <button type="submit"><i class="fa fa-search"></i></button>
     </form>
   </div>
  <?php } ?>
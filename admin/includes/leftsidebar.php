            
            <div class="left side-menu">
              <div class="sidebar-inner slimscrollleft">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                  <ul>
                   <li class="menu-title">Navigation</li>

                   <li class="has_sub">
                    <a href="dashboard.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>

                  </li>

                  <?php  
                     $checkqyery = mysqli_query($con, "SELECT `userid` FROM `admintable` WHERE `useremail` = '".$_SESSION['login']."'") or exit(mysqli_error($con));

                      $row=mysqli_fetch_array($checkqyery);
                      if($row['userid']==1){
                  ?>
               <?php } ?>

               <?php
               if($row['userid']==1 || $row['userid']==2){
               ?>

                 <li class="has_sub">
                  <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> User </span> <span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    <li><a href="add-user.php">Add User </a></li>
                    <li><a href="manage-user.php">Manage User</a></li>
                  </ul>
                </li>  
              <?php } ?>
             
                      <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Posts </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                          <li><a href="add-post.php">Add Posts</a></li>
                          <li><a href="manage-posts.php">Manage Posts</a></li>
                          <?php
                           if($row['userid']==1 || $row['userid']==2){
                          ?>
                          <li><a href="add-category.php">Category</a></li>
                        <?php } ?>
                        </ul>
                      </li>  
              <?php
               if($row['userid']==1 || $row['userid']==2){
               ?>

                    
              <?php } ?>   
                  </ul>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>
              </div>
            </div>
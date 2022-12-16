 <?php 

            $querysite=mysqli_query($con,"select site_title from site_info_table");
                    $row=mysqli_fetch_array($querysite);
            
            $nameqyery = mysqli_query($con, "SELECT `username` FROM `admintable` WHERE `useremail` = '".$_SESSION['login']."'") or exit(mysqli_error($con));

            $rowcheck=mysqli_fetch_array($nameqyery);

            ?>

            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                <a href="#" class="logo">
                    <span class="logo-lg"><b>Admin Panel</b></span>
                </a>
            </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Navbar-left -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                     
                    
                        </ul>

                        <!-- Right(Notification) -->
                        <ul class="nav navbar-nav navbar-right">
                          

                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                    <img src="assets/images/users/InShot_20201027_170734509.jpg" alt="user-img" class="img-circle user-img">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li>
                                        <h5>Hi, <?php echo ucfirst($rowcheck['username']); ?></h5>
                                    </li>
                                    <li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul> <!-- end navbar-right -->

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
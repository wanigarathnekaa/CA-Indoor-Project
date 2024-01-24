<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?php echo URLROOT; ?>/images/Logo3.png" alt="logo">
            </span>
        </div>
        <!-- <div class="text logo-text">
            <span class="name">Milan Bhanuka </span>
            <span class="profession">Web developer</span>
        </div> -->

        <i class='bx bx-chevron-right toggle'></i>
    </header>
 
       <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                
                <?php if ($role == "User") { ?>
                    <li class="nav-link">
                        <a href="C&A_Indoor_Project/Pages/Dashboard/user">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class="bx bxs-calendar icon"></i>
                            <span class="text nav-text">Schedule</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="C&A_Indoor_Project/Pages/View_Advertisement/user">
                            <i class="fa-brands fa-adversal icon"></i>
                            <span class="text nav-text">Advertisement</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="C&A_Indoor_Project/Pages/Coach/user">
                            <i class="fa-solid fa-user-group icon"></i>
                            <span class="text nav-text">Coach</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class="bx bx-store icon"></i>
                            <span class="text nav-text">Cricket Store</span>
                        </a>
                    </li>
                    <li class="profile">
                        <a href="C&A_Indoor_Project/Pages/Profile/user">
                            <i class="bx bx-user-circle icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                <?php } else if ($role == "Admin") { ?>
                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Pages/Dashboard/admin">
                                <i class="bx bx-home-alt icon"></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="#">
                                <i class="bx bxs-calendar icon"></i>
                                <span class="text nav-text">Schedule</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="#">
                                <i class="fa-brands fa-adversal icon"></i>
                                <span class="text nav-text">Advertisement</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="#">
                                <i class="bx bxs-user-detail icon"></i>
                                <span class="text nav-text">User Management</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="#">
                                <i class="bx bxs-detail icon"></i>
                                <span class="text nav-text">System Logs</span>
                            </a>
                        </li>
                        <li class="profile">
                            <a href="C&A_Indoor_Project/Pages/Profile/user">
                                <i class="bx bx-user-circle icon"></i>
                                <span class="text nav-text">Profile</span>
                            </a>
                        </li>
                <?php }
                 else if ($role == "Cashier") { ?>
                            <li class="nav-link">
                                <a href="#">
                                    <i class="bx bx-home-alt icon"></i>
                                    <span class="text nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="#">
                                    <i class="bx bxs-calendar icon"></i>
                                    <span class="text nav-text">Schedule</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="#">
                                    <i class="fa-brands fa-adversal icon"></i>
                                    <span class="text nav-text">Advertisement</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="#">
                                    <i class="bx bx-money-withdraw icon"></i>
                                    <span class="text nav-text">Payment</span>
                                </a>
                            </li>
                            <li class="profile">
                                <a href="C&A_Indoor_Project/Pages/Profile/user">
                                    <i class="bx bx-user-circle icon"></i>
                                    <span class="text nav-text">Profile</span>
                                </a>
                            </li>
                <?php } else if ($role == "Coach") { ?>
                                <li class="nav-link">
                                    <a href="C&A_Indoor_Project/Pages/dashboard/coach">
                                        <i class="bx bx-home-alt icon"></i>
                                        <span class="text nav-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="#">
                                        <i class="bx bxs-calendar icon"></i>
                                        <span class="text nav-text">Schedule</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="C&A_Indoor_Project/Pages/View_Advertisement/user">

                                        <i class="fa-brands fa-adversal icon"></i>
                                        <span class="text nav-text">Advertisement</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="#">
                                        <i class="bx bx-store icon"></i>
                                        <span class="text nav-text">Cricket Store</span>
                                    </a>
                                </li>
                                <li class="profile">
                                    <a href="C&A_Indoor_Project/Pages/Profile/user">
                                        <i class="bx bx-user-circle icon"></i>
                                        <span class="text nav-text">Profile</span>
                                    </a>
                                </li>
                <?php } else if ($role == "Manager") { ?>
                                    <li class="nav-link">
                                        <a href="C&A_Indoor_Project/Pages/Dashboard/manager">
                                            <i class="bx bx-home-alt icon"></i>
                                            <span class="text nav-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="#">
                                            <i class="bx bxs-calendar icon"></i>
                                            <span class="text nav-text">Schedule</span>
                                        </a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="C&A_Indoor_Project/Pages/View_Advertisement/user">
                                            <i class="fa-brands fa-adversal icon"></i>
                                            <span class="text nav-text">Advertisement</span>
                                        </a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="C&A_Indoor_Project/Pages/Coach_Registration/coach">
                                            <i class="bx bxs-user-plus icon"></i>
                                            <span class="text nav-text">Registration</span>
                                        </a>
                                    </li>

                                    <li class="nav-link">
                                        <a href="#">
                                            <i class="bx bx-store icon"></i>
                                            <span class="text nav-text">Cricket Store</span>
                                        </a>
                                    </li>

                                    <li class="nav-link">
                                        <a href="#">
                                            <i class="bx bxs-report icon"></i>
                                            <span class="text nav-text">Report</span>
                                        </a>
                                    </li>
                                    <li class="profile">
                                        <a href="C&A_Indoor_Project/Pages/Manager_Profile/manager">
                                            <i class="bx bx-user-circle icon"></i>
                                            <span class="text nav-text">Profile</span>
                                        </a>
                                    </li>
                <?php } else if ($role == "Owner") { ?>
                                        <li class="nav-link">
                                            <a href="#">
                                                <i class="bx bx-home-alt icon"></i>
                                                <span class="text nav-text">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="#">
                                                <i class="bx bxs-calendar icon"></i>
                                                <span class="text nav-text">Schedule</span>
                                            </a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="#">
                                                <i class="fa-brands fa-adversal icon"></i>
                                                <span class="text nav-text">Advertisement</span>
                                            </a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="C&A_Indoor_Project/Pages/Manager_Registration/manager">
                                                <i class="bx bxs-user-plus icon"></i>
                                                <span class="text nav-text">Registration</span>
                                            </a>
                                        </li>

                                        <li class="nav-link">
                                            <a href="#">
                                                <i class="bx bx-store icon"></i>
                                                <span class="text nav-text">Cricket Store</span>
                                            </a>
                                        </li>

                                        <li class="nav-link">
                                            <a href="#">
                                                <i class="bx bxs-report icon"></i>
                                                <span class="text nav-text">Report</span>
                                            </a>
                                        </li>

                                        <li class="nav-link">
                                            <a href="#">
                                                <i class="fa-solid fa-comments-dollar icon"></i>
                                                <span class="text nav-text">Confirmation Fee</span>
                                            </a>
                                        </li>
                                        <li class="profile">
                                            <a href="C&A_Indoor_Project/Pages/Profile/user">
                                                <i class="bx bx-user-circle icon"></i>
                                                <span class="text nav-text">Profile</span>
                                            </a>
                                        </li>
                <?php } ?>

                <? if ($role != "Cashier") { ?>
                    <li class="nav-link">
                        <a href="#">
                            <i class="bx bxs-alarm-exclamation icon"></i>
                            <span class="text nav-text">Feedback</span>
                        </a>
                    </li>
                <? } ?>


            </ul>
        </div>
        <div class="bottom-content">
            <li class="logout">
                <a href="http://localhost/C&A_Indoor_Project/Users/login">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text nav-text">logout</span>
                </a>
            </li>
        </div>
    </div>
</nav>

<!-- <section class="navbar"> 
    <div class="titlecontainer">
                
                  <input type="checkbox" id="check">
      <header>
        <div class="navigation">
          <a href="#">Profile</a></li>
          <a href="#">Shedule</a></li>
          <a href="#">Advertisement</a></li>
          <a href="#">Cricket Shop</a></li>
          <a href="#">Feedback</a></li>
          <a href="#">Registration</a></li>
          <a href="#">Report</a></li>
    
      </div>
      <label for="check">
        <i class="fas fa-bars menu-btn"></i>
        <i class="fas fa-times close-btn"></i>
    
      </label>
      </header>
            </div></section> -->
 <!-- javascripts -->
 <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
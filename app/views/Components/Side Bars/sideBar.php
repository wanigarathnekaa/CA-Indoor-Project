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
                        <a href="<?php echo URLROOT; ?>/Pages/Dashboard/user">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo URLROOT; ?>/Pages/userSchedule/user">
                            <i class="bx bxs-calendar icon"></i>
                            <span class="text nav-text">Schedule</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo URLROOT; ?>/Pages/View_Advertisement/user">
                            <i class="fa-brands fa-adversal icon"></i>
                            <span class="text nav-text">Advertisement</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="<?php echo URLROOT; ?>/Pages/Coach/user">
                            <i class="fa-solid fa-user-group icon"></i>
                            <span class="text nav-text">Coach</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="<?php echo URLROOT; ?>/Pages/Cricket_Shop/User">
                            <i class="bx bx-store icon"></i>
                            <span class="text nav-text">Cricket Store</span>
                        </a>
                    </li>
                    <li class="profile">
                        <a href="<?php echo URLROOT; ?>/Pages/Profile/user">
                            <i class="bx bx-user-circle icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo URLROOT; ?>/Complaint/create">
                            <i class="bx bxs-alarm-exclamation icon"></i>
                            <span class="text nav-text">Feedback</span>
                        </a>
                    </li>
                <?php } else if ($role == "Admin") { ?>
                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Pages/Dashboard/admin">
                                <i class="bx bx-home-alt icon"></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li>
                        <!-- <li class="nav-link">
                            <a href="#">
                                <i class="bx bxs-calendar icon"></i>
                                <span class="text nav-text">Schedule</span>
                            </a>
                        </li> -->
                        <li class="nav-link">
                            <a href="#">
                                <i class="fa-brands fa-adversal icon"></i>
                                <span class="text nav-text">Customers</span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="C&A_Indoor_Project/Pages/CompanyUsers/add-user.php"><span class="text nav-text">Add
                                            Customer</span></a></li>
                                <li><a href="customer-list.php"><span class="text nav-text">Manage Customers</span></a></li>
                            </ul>
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
                            <a href="C&A_Indoor_Project/Pages/CompanyUser_Profile/Admin">
                                <i class="bx bx-user-circle icon"></i>
                                <span class="text nav-text">Profile</span>
                            </a>
                        </li>
                <?php } else if ($role == "Cashier") { ?>
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
                                <a href="C&A_Indoor_Project/Pages/CompanyUser_Profile/Admin">
                                    <i class="bx bx-user-circle icon"></i>
                                    <span class="text nav-text">Profile</span>
                                </a>
                            </li>
                <?php } else if ($role == "Coach") { ?>
                                <li class="nav-link">
                                    <a href="<?php echo URLROOT; ?>/Pages/Dashboard/coach">
                                        <i class="bx bx-home-alt icon"></i>
                                        <span class="text nav-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="<?php echo URLROOT; ?>/Pages/userSchedule/coach">
                                        <i class="bx bxs-calendar icon"></i>
                                        <span class="text nav-text">Schedule</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="<?php echo URLROOT; ?>/Pages/View_Advertisement/coach">

                                        <i class="fa-brands fa-adversal icon"></i>
                                        <span class="text nav-text">Advertisement</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="<?php echo URLROOT; ?>/Pages/Cricket_Shop/Coach">
                                        <i class="bx bx-store icon"></i>
                                        <span class="text nav-text">Cricket Store</span>
                                    </a>
                                </li>
                                <li class="profile">
                                    <a href="<?php echo URLROOT; ?>/Pages/Profile/user">
                                        <i class="bx bx-user-circle icon"></i>
                                        <span class="text nav-text">Profile</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="<?php echo URLROOT; ?>/Complaint/create">
                                        <i class="bx bxs-alarm-exclamation icon"></i>
                                        <span class="text nav-text">Feedback</span>
                                    </a>
                                </li>
                <?php } else if ($role == "Manager") { ?>
                                    <li class="nav-link">
                                        <a href="<?php echo URLROOT; ?>/Pages/Dashboard/manager">
                                            <i class="bx bx-home-alt icon"></i>
                                            <span class="text nav-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="<?php echo URLROOT; ?>/Pages/Schedule/manager">
                                            <i class="bx bxs-calendar icon"></i>
                                            <span class="text nav-text">Schedule</span>
                                        </a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="<?php echo URLROOT; ?>/Pages/View_Advertisement/manager">
                                            <i class="fa-brands fa-adversal icon"></i>
                                            <span class="text nav-text">Advertisement</span>
                                        </a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="<?php echo URLROOT; ?>/Pages/Coach_Registration/coach">
                                            <i class="bx bxs-user-plus icon"></i>
                                            <span class="text nav-text">Registration</span>
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
                                            <a href="<?php echo URLROOT; ?>/Pages/Dashboard/owner">
                                                <i class="bx bx-home-alt icon"></i>
                                                <span class="text nav-text">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="<?php echo URLROOT; ?>/Pages/Schedule/owner">
                                                <i class="bx bxs-calendar icon"></i>
                                                <span class="text nav-text">Schedule</span>
                                            </a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="<?php echo URLROOT; ?>/Pages/View_Advertisement/owner">
                                                <i class="fa-brands fa-adversal icon"></i>
                                                <span class="text nav-text">Advertisement</span>
                                            </a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="<?php echo URLROOT; ?>/Pages/Manager_Registration/manager">
                                                <i class="bx bxs-user-plus icon"></i>
                                                <span class="text nav-text">Registration</span>
                                            </a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="#">
                                                <i class="bx bxs-report icon"></i>
                                                <span class="text nav-text">Report</span>
                                            </a>
                                        </li>
                                        <li class="profile">
                                            <a href="<?php echo URLROOT; ?>/Pages/CompanyUser_Profile/Owner">
                                                <i class="bx bx-user-circle icon"></i>
                                                <span class="text nav-text">Profile</span>
                                            </a>
                                        </li>
                <?php } ?>
            </ul>
        </div>
        <div class="bottom-content">
            <li class="logout">
                <a href="<?php echo URLROOT; ?>/Users/logout">
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
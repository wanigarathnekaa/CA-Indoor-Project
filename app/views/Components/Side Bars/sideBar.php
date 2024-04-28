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
                    <?php
                    if ($_SESSION['user_role'] != "User") {
                        redirect('Pages/ErrorPage/404');
                    }
                    ?>
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
                    <li class="nav-link">
                        <a href="<?php echo URLROOT; ?>/Complaint/create">
                            <!-- <i class="bx bxs-alarm-exclamation icon"></i> -->
                            <i class="fa-regular fa-comments icon"></i>
                            <span class="text nav-text">Feedback</span>
                        </a>
                    </li>
                    <li class="profile">
                        <a href="<?php echo URLROOT; ?>/Pages/Profile/user">
                            <i class="bx bx-user-circle icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                <?php } else if ($role == "Admin") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Admin") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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
                        <!-- <li class="nav-link">
                            <a href="#">
                                <i class="bx bxs-user-detail icon"></i>
                                <span class="text nav-text">User Management</span>
                            </a>
                        </li> -->

                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Pages/View_Advertisement/admin">
                                <i class="fa-brands fa-adversal icon"></i>
                                <span class="text nav-text">Advertisement</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Reports/SelectReport">
                                <i class="bx bxs-report icon"></i>

                                <span class="text nav-text">Reports</span>
                            </a>

                        </li>

                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Pages/AccountLogTable">
                                <i class="bx bxs-detail icon"></i>
                                <span class="text nav-text">System Logs</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Complaint/viewComplaints">
                                <i class="fa-solid fa-comments icon"></i>

                                <span class="text nav-text">Complaints</span>
                            </a>
                        </li>
                        <li class="profile">
                            <a href="C&A_Indoor_Project/Pages/CompanyUser_Profile/Admin">
                                <i class="bx bx-user-circle icon"></i>
                                <span class="text nav-text">Profile</span>
                            </a>
                        </li>
                <?php } else if ($role == "Cashier") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Cashier") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
                            <li class="nav-link">
                                <a href="<?php echo URLROOT; ?>/Pages/Dashboard/cashier">
                                    <i class="bx bx-home-alt icon"></i>
                                    <span class="text nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="<?php echo URLROOT; ?>/Pages/Schedule/cashier">
                                    <i class="bx bxs-calendar icon"></i>
                                    <span class="text nav-text">Schedule</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="<?php echo URLROOT; ?>/Pages/View_Advertisement/cashier">
                                    <i class="fa-brands fa-adversal icon"></i>
                                    <span class="text nav-text">Advertisement</span>
                                </a>
                            </li>
                            <!-- <li class="nav-link">
                                <a href="#">
                                    <i class="bx bx-money-withdraw icon"></i>
                                    <span class="text nav-text">Payment</span>
                                </a>
                            </li> -->
                            <li class="profile">
                                <a href="C&A_Indoor_Project/Pages/CompanyUser_Profile/Admin">
                                    <i class="bx bx-user-circle icon"></i>
                                    <span class="text nav-text">Profile</span>
                                </a>
                            </li>
                <?php } else if ($role == "Coach") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Coach") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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
                                    <a href="<?php echo URLROOT; ?>/Pages/availabilityPage/coach">
                                        <!-- <i class="bx bxs-calendar icon"></i> -->
                                        <i class="fa-solid fa-business-time icon"></i>
                                        <span class="text nav-text">Availability</span>
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
                                <li class="nav-link">
                                    <a href="<?php echo URLROOT; ?>/Complaint/create">
                                        <i class="fa-regular fa-comments icon"></i>
                                        <span class="text nav-text">Feedback</span>
                                    </a>
                                </li>
                                <li class="profile">
                                    <a href="<?php echo URLROOT; ?>/Pages/Profile/user">
                                        <i class="bx bx-user-circle icon"></i>
                                        <span class="text nav-text">Profile</span>
                                    </a>
                                </li>

                <?php } else if ($role == "Manager") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Manager") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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
                                    <li class="profile">
                                        <a href="C&A_Indoor_Project/Pages/Manager_Profile/manager">
                                            <i class="bx bx-user-circle icon"></i>
                                            <span class="text nav-text">Profile</span>
                                        </a>
                                    </li>
                <?php } else if ($role == "Owner") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Owner") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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



<!-- NAVIGATION BAR -->
<nav class= "nav">
        <div class="logo">
            <img src="<?php echo URLROOT; ?>/images/logo.png" alt="">
        </div>
        
        <div class="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </nav>
    <div class="menubar2">
        <ul>
        <?php if ($role == "User") { ?>
                    <?php
                    if ($_SESSION['user_role'] != "User") {
                        redirect('Pages/ErrorPage/404');
                    }
                    ?>
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
                    <li class="nav-link">
                        <a href="<?php echo URLROOT; ?>/Complaint/create">
                            <!-- <i class="bx bxs-alarm-exclamation icon"></i> -->
                            <i class="fa-regular fa-comments icon"></i>
                            <span class="text nav-text">Feedback</span>
                        </a>
                    </li>
                    <li class="profile">
                        <a href="<?php echo URLROOT; ?>/Pages/Profile/user">
                            <i class="bx bx-user-circle icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                <?php } else if ($role == "Admin") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Admin") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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
                        <!-- <li class="nav-link">
                            <a href="#">
                                <i class="bx bxs-user-detail icon"></i>
                                <span class="text nav-text">User Management</span>
                            </a>
                        </li> -->

                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Pages/View_Advertisement/admin">
                                <i class="fa-brands fa-adversal icon"></i>
                                <span class="text nav-text">Advertisement</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Reports/SelectReport">
                                <i class="bx bxs-report icon"></i>

                                <span class="text nav-text">Reports</span>
                            </a>

                        </li>

                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Pages/AccountLogTable">
                                <i class="bx bxs-detail icon"></i>
                                <span class="text nav-text">System Logs</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="C&A_Indoor_Project/Complaint/viewComplaints">
                                <i class="fa-solid fa-comments icon"></i>

                                <span class="text nav-text">Complaints</span>
                            </a>
                        </li>
                        <li class="profile">
                            <a href="C&A_Indoor_Project/Pages/CompanyUser_Profile/Admin">
                                <i class="bx bx-user-circle icon"></i>
                                <span class="text nav-text">Profile</span>
                            </a>
                        </li>
                <?php } else if ($role == "Cashier") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Cashier") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
                            <li class="nav-link">
                                <a href="<?php echo URLROOT; ?>/Pages/Dashboard/cashier">
                                    <i class="bx bx-home-alt icon"></i>
                                    <span class="text nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="<?php echo URLROOT; ?>/Pages/Schedule/cashier">
                                    <i class="bx bxs-calendar icon"></i>
                                    <span class="text nav-text">Schedule</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="<?php echo URLROOT; ?>/Pages/View_Advertisement/cashier">
                                    <i class="fa-brands fa-adversal icon"></i>
                                    <span class="text nav-text">Advertisement</span>
                                </a>
                            </li>
                            <!-- <li class="nav-link">
                                <a href="#">
                                    <i class="bx bx-money-withdraw icon"></i>
                                    <span class="text nav-text">Payment</span>
                                </a>
                            </li> -->
                            <li class="profile">
                                <a href="C&A_Indoor_Project/Pages/CompanyUser_Profile/Admin">
                                    <i class="bx bx-user-circle icon"></i>
                                    <span class="text nav-text">Profile</span>
                                </a>
                            </li>
                <?php } else if ($role == "Coach") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Coach") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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
                                    <a href="<?php echo URLROOT; ?>/Pages/availabilityPage/coach">
                                        <!-- <i class="bx bxs-calendar icon"></i> -->
                                        <i class="fa-solid fa-business-time icon"></i>
                                        <span class="text nav-text">Availability</span>
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
                                <li class="nav-link">
                                    <a href="<?php echo URLROOT; ?>/Complaint/create">
                                        <i class="fa-regular fa-comments icon"></i>
                                        <span class="text nav-text">Feedback</span>
                                    </a>
                                </li>
                                <li class="profile">
                                    <a href="<?php echo URLROOT; ?>/Pages/Profile/user">
                                        <i class="bx bx-user-circle icon"></i>
                                        <span class="text nav-text">Profile</span>
                                    </a>
                                </li>

                <?php } else if ($role == "Manager") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Manager") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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
                                    <li class="profile">
                                        <a href="C&A_Indoor_Project/Pages/Manager_Profile/manager">
                                            <i class="bx bx-user-circle icon"></i>
                                            <span class="text nav-text">Profile</span>
                                        </a>
                                    </li>
                <?php } else if ($role == "Owner") { ?>
                        <?php
                        if ($_SESSION['user_role'] != "Owner") {
                            redirect('Pages/ErrorPage/404');
                        }
                        ?>
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
                <li class="logout">
                <a href="<?php echo URLROOT; ?>/Users/logout">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text nav-text">logout</span>
                </a>
            </li>
        </ul>
    </div>


<script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>


<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="<?php echo URLROOT;?>/images/Logo3.png" alt="logo">
                </span>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    

                   
                    <?php

                    if($role == "User"){
                        echo '
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
                            <a href="C&A_Indoor_Project/Pages/Advertisements/advertisement">
                               <i class="bx bxs-cricket-ball icon"></i>
                               <span class="text nav-text">Advertisement</span>
                            </a>
                        </li>
                        
                        <li class="nav-link">
                            <a href="#">
                                <i class="bx bx-body icon"></i>
                                <span class="text nav-text">Coach</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="#">
                                <i class="bx bx-store icon"></i>
                                <span class="text nav-text">Cricket Store</span>
                            </a>
                        </li>';
                    }
                    else if($role == "Admin"){
                        echo '
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
                            <i class="bx bxs-cricket-ball icon"></i>
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
                            </li>';
                    }
                    else if($role == "Cashier"){
                        echo '

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
                            <i class="bx bxs-cricket-ball icon"></i>
                            <span class="text nav-text">Advertisement</span>
                        </a>
                        </li>
                        <li class="nav-link">
                            <a href="#">
                                <i class="bx bx-money-withdraw icon"></i>
                                <span class="text nav-text">Payment</span>
                            </a>
                        </li>
                        ';
                    }
                    else if($role == "Coach"){
                        echo '
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
                            <i class="bx bxs-cricket-ball icon"></i>
                            <span class="text nav-text">Advertisement</span>
                        </a>
                        </li>
                            <li class="nav-link">
                                <a href="#">
                                    <i class="bx bx-store icon"></i>
                                    <span class="text nav-text">Cricket Store</span>
                                </a>
                            </li>';
                    }
                    else if($role == "Manager" || $role == "Owner"){
                        echo '
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
                            <i class="bx bxs-cricket-ball icon"></i>
                            <span class="text nav-text">Advertisement</span>
                        </a>
                        </li>
                            <li class="nav-link">
                                <a href="#">
                                    <i class= "bx bxs-user-plus icon"></i>
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
                            </li> ';
                    }  
                    
                    if($role == "Owner"){
                        echo '<li class="nav-link">
                                <a href="#">
                                    <i class="bx bx-money icon"></i>
                                    <span class="text nav-text">Confirmation Fee</span>
                                </a>
                            </li>';
                    }


                    if($role != "Cashier"){
                        echo '
                        <li class="nav-link">
                            <a href="#">
                                <i class="bx bxs-alarm-exclamation icon"></i>
                                <span class="text nav-text">Feedback</span>
                            </a>
                        </li>
                        ';
                    }
                    
                    

                    ?>
                </ul>
            </div>


    

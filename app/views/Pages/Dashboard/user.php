<!-- <h1 style="left: 47vw; width: calc(100% - 47vw);position:fixed;padding-right: 4rem;">Welcome <?php echo $_SESSION['user_name'] ?></h1> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/playerDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/sideBar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">



</head>

<body>

    <!-- side bar -->
    <?php
    $role = "User";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- content -->
    <section class="home">

        <!-- LANDING SECTION -->
        <div class="sec-landing">
                <div class="landing-content">
                    <div>
                        <h3>WELCOME TO</h3>
                        <h1>C & A</h1>
                        <h2>INDOOR CRICKET NET</h2>
                    </div>
                </div>
                <div class="landing-image">
                    <img src="<?php echo URLROOT; ?>/images/batsman.png" alt="">
                </div>
        </div>

        <!-- OUR SERVICES -->
        <div class="sec-service">
            <div class="tagrow">
                <h2>OUR SERVICES</h2>
            </div>

            <div class="service-cards">
                <a class="card" href="#">
                    <div class="card-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="cardName">Coaches</div>
                    </div>    
                </a>
                <a class="card" href="#">
                    <div class="card-icon">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <div>
                        <div class="cardName">Online Reservations</div>
                    </div>    
                </a>

                <a class="card" href="#">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <div class="cardName">Buy Equipments</div>
                    </div>    
                </a>
            </div>
        </div>


        <!-- Your Reservations -->
        <div class="sec-reservation">
            <div class="tagrow">
                    <h2>Reservations</h2>
            </div>
            <div class="details">
                <!-- upcomming Reservations -->
                <div class="tablediv">
                    <?php
                            require APPROOT . '/views/Pages/Tables/personal_reservation.php';
                    ?>
                </div>
                
                <!-- Calander -->
                <div class="calanderdiv">
                    <iframe src="http://localhost/C&A_Indoor_Project/Pages/Calendar/User" frameborder="0"></iframe>                        
                </div>
            </div>
        </div>


        <!-- OUR COACHES -->
        <section class="coaches">
            <div class="tagrow">
                <div class="tag"><h2>OUR COACHES</h2></div>
                <div><a href="#" class="btn">View All</a></div>  
            </div>
            <button class="pre-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button>

            <div class="coaches-container">
                <div class="coach-card">
                    <div class="coach-img">
                        <img src="<?php echo URLROOT; ?>/images/image1.jpg" class="coach-thum" alt="">
                    </div>
                    <div class="coach-details">
                        <h3 class="coach-name">Milan Bhanuka</h3>
                    </div>
                </div>

                <div class="coach-card">
                    <div class="coach-img">
                        <img src="<?php echo URLROOT; ?>/images/image1.jpg" class="coach-thum" alt="">
                    </div>
                    <div class="coach-details">
                        <h3 class="coach-name">Milan Bhanuka</h3>
                    </div>
                </div>

                <div class="coach-card">
                    <div class="coach-img">
                        <img src="<?php echo URLROOT; ?>/images/image1.jpg" class="coach-thum" alt="">
                    </div>
                    <div class="coach-details">
                        <h3 class="coach-name">Milan Bhanuka</h3>
                    </div>
                </div>

                <div class="coach-card">
                    <div class="coach-img">
                        <img src="<?php echo URLROOT; ?>/images/image1.jpg" class="coach-thum" alt="">
                    </div>
                    <div class="coach-details">
                        <h3 class="coach-name">Milan Bhanuka</h3>
                    </div>
                </div>

                <div class="coach-card">
                    <div class="coach-img">
                        <img src="<?php echo URLROOT; ?>/images/image1.jpg" class="coach-thum" alt="">
                    </div>
                    <div class="coach-details">
                        <h3 class="coach-name">Milan Bhanuka</h3>
                    </div>
                </div>

                <div class="coach-card">
                    <div class="coach-img">
                        <img src="<?php echo URLROOT; ?>/images/image1.jpg" class="coach-thum" alt="">
                    </div>
                    <div class="coach-details">
                        <h3 class="coach-name">Milan Bhanuka</h3>
                    </div>
                </div>

                

                

            </div>

        </section>
        
        
        



        

        <!-- <div class="sec">
            <div class="tagrow">
                <h2>FIND US HERE</h2>
            </div>
            <div class="google-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.982584570147!2d79.92213817448265!3d6.892686118764102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25138514423cb%3A0x981f4120a1d021d1!2sC%26A%20Indoor%20Cricket%20Net!5e0!3m2!1sen!2slk!4v1698731444163!5m2!1sen!2slk"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div> -->




            


            
    </section>




    <!-- side bar -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/coachContainer.js"></script>
</body>

</html>
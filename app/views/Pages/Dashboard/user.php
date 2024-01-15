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
                <a class="card" href="C&A_Indoor_Project/Pages/Coach/user">
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
                <div class="tag"><h2>Coaches</h2></div>
                <div><a href="C&A_Indoor_Project/Pages/Coach/user" class="btn">View All</a></div>  
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
                        <img src="<?php echo URLROOT; ?>/images/image2.jpg" class="coach-thum" alt="">
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


        <!-- Advertisement -->
        <section class="advertisement">
            <div class="tagrow">
                <div class="tag"><h2>Advertisement</h2></div>
                <div><a href="C&A_Indoor_Project/Pages/Advertisements/advertisement" class="btn">View All</a></div>  
            </div>
            <button class="adspre-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button>
            <button class="adsnxt-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button>
            <div class="ads-container">
                <?php foreach ($data["adverts"] as $advert): ?>
                    <div class="ads-card">
                        <div class="ads-img">
                            <img src="<?php echo URLROOT; ?>/public/uploads/<?php echo $advert->img; ?>" class="ads-thum" alt="">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <!-- ABOUT US -->
        <div class="sec-about">
            <div class="tagrow">
                <h2>ABOUT US</h2>
            </div>
            <div class="about-content">
                <!-- map -->
                <div class="map-div">
                    <div class="tagrow">
                        <h2>FIND US HERE</h2>
                    </div>
                    <div class="google-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.982584570147!2d79.92213817448265!3d6.892686118764102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25138514423cb%3A0x981f4120a1d021d1!2sC%26A%20Indoor%20Cricket%20Net!5e0!3m2!1sen!2slk!4v1698731444163!5m2!1sen!2slk"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- about -->
                <div class="about-div">
                    <div class="tagrow">
                        <h2>We provide the best service for you</h2>
                    </div>
                    <div class="aboutDetails">
                        <div class="detail">
                            <i class="fa-solid fa-circle-check tick"></i>
                            <p>Best coaching service from qualified coaches</p>
                        </div>

                        <div class="detail">
                            <i class="fa-solid fa-circle-check tick"></i>
                            <p>We have 03 indoor cricket nets with 01 bowling machine</p>
                        </div>

                        <div class="detail">
                            <i class="fa-solid fa-circle-check tick"></i>
                            <p>You can reserve your slot online</p>
                        </div>

                        <div class="detail">
                            <i class="fa-solid fa-circle-check tick"></i>
                            <p>You can buy cricket equipments from our shop</p>
                        </div>

                        <div class="detail">
                            <i class="fa-solid fa-circle-check tick"></i>
                            <p>We have a large parking area</p>
                        </div>

                        <div class="detail">
                            <i class="fa-solid fa-circle-check tick"></i>
                            <p>We are open 7.00am to 10.00pm on weekdays and weekends</p>
                        </div>

                        <div class="detail">
                            <i class="fa-solid fa-circle-check tick"></i>
                            <p>Your can arange your one-to-one coaching session</p>
                        </div>   
                    </div>

                    <div class="prices">
                        <div class="tagrow">
                            <h2>prices of net Reservations</h2>
                        </div>
                        <div class="aboutDetails">
                            <div class="detail">
                                <i class="fa-solid fa-circle-check tick"></i>
                                <p>Rs. 1000 per hour for noemal net</p>
                            </div>
    
                            <div class="detail">
                                <i class="fa-solid fa-circle-check tick"></i>
                                <p>Rs. 1500 per hour for bowling machine net</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <img src="<?php echo URLROOT; ?>/images/logo3.png" alt="" class="footerlogo">
            </div>
            <div class="footer-content">
                <h3>Useful Links</h3>
                <ul class="footer-links">
                    <li>
                        <a href="#">About Us</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
                    <li>
                        <a href="#">FAQ</a>
                    </li>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#">Terms & Conditions</a>
                    </li>
                </ul>
            </div>

            <div class="footer-content">
                <div class="footer-item">
                    <i class="fa-solid fa-phone icon"></i>
                    <div class="item-des">
                        <a href="tel:0770722933">0770722933</a>
                        <br>
                        <a href="tel:0701184455">0701184455</a>
                    </div>
                </div>
                <div class="footer-item">
                    <i class="fa-regular fa-envelope icon"></i>
                    <div class="item-des">
                        <a href="mailto:caindoor44@gmail.com">caindoor44@gmail.com</a>
                    </div>
                </div>
                <div class="footer-item">
                    <i class="fa-solid fa-map-location-dot icon"></i>
                    <div class="item-des">
                        <address>
                            <a href="https://maps.app.goo.gl/TEsXxiHBK5fGkCkX6"> 
                                Singhepura,<br>
                                Battaramulla,<br>
                                10120,<br>
                                Sri Lanka.
                            </a>
                        </address>
                    </div>
                </div>
            </div>


            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul class="socials">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-instagram icon "></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter icon"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </footer>
            
            
    </section>




    <!-- side bar -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/userDashboard.js"></script>
</body>

</html>
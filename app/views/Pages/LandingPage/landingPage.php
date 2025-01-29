<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResponsiveLandingPage</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/UserLandingPageStyle.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
    <!-- NAVIGATION BAR -->
    <nav>
        <div class="logo">
            <img src="<?php echo URLROOT; ?>/images/logo.png" alt="">
        </div>
        <ul>
            <li>
            <a href="<?php echo URLROOT; ?>/Pages/LandingPage">Home</a>
            </li>
            <li>
            <a href="#services">Services</a>
            </li>
            <li>
            <a href="#advertisement">Advertisement</a>
            </li>
            <li>
            <a href="#about">About Us</a>
            </li>
            <li>
            <a href="<?php echo URLROOT; ?>/users/login" class="login">Login</a>
            </li>
            <li>
            <a href="<?php echo URLROOT; ?>/users/register" class="login">Register</a>
            </li>
            
        </ul>
        <div class="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </nav>
    <div class="menubar">
        <ul>
            <li>
            <a href="<?php echo URLROOT; ?>/Pages/LandingPage">Home</a>
            </li>
            <li>
            <a href="#services">Services</a>
            </li>
            <li>
            <a href="#advertisement">Advertisement</a>
            </li>
            <li>
                <a href="#about">About Us</a>
            </li>
            <li>
            <a href="<?php echo URLROOT; ?>/users/login" class="login">Login</a>
            </li>
            <li>
            <a href="<?php echo URLROOT; ?>/users/register" class="login">Register</a>
            </li>
        </ul>
    </div>



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
    <div class="sec-service" id="services">
        <div class="tagrow">
            <h2>OUR SERVICES</h2>
        </div>

        <div class="service-cards">
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <div class="cardName">Coaching Sessions</div>
                </div>    
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-globe"></i>
                </div>
                <div>
                    <div class="cardName">Online Reservations</div>
                </div>    
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div>
                    <div class="cardName">Buy Equipments</div>
                </div>    
            </div>
        </div>
    </div>

    <!-- Advertisement -->
    <section class="advertisement" id="advertisement">
        <div class="tagrow">
            <div class="tag"><h2>Advertisement</h2></div>
            <!-- <div><a href="http://localhost/C&A_Indoor_Project/Pages/View_Advertisement/user" class="btn">View All</a></div>   -->
        </div>
        <!-- <button class="adspre-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button> -->
        <!-- <button class="adsnxt-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button> -->
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
    <div class="sec-about" id="about">
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
                                <p>Rs. 1000 per hour for normal net</p>
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
    <?php
            require APPROOT . '/views/Components/footer.php';
        ?>
</body>

<script src="<?php echo URLROOT; ?>/js/landing.js"></script>

</html>
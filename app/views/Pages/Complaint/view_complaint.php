<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <title>Document</title> -->
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Complaint.css">
</head>
    <body>
    <?php
        $role = $_SESSION['user_role'];
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>
      <section class="home">
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                <?php foreach ($data["complaints"] as $complaints): ?>

                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>

                            <div class="card-image">
                               <img src="" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name"><?php echo $complaints->name ?></h2>
                            <p class="description"><?php echo $complaints->message ?></p>

                            <button class="button">View More</button>
                        </div>
                    </div>
                    <?php endforeach; ?>

                   
                  
                   
                </div>
            </div>

            <button class="adspre-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button>
            <button class="adsnxt-btn"><img src="<?php echo URLROOT; ?>/images/arrow.png" alt=""></button>
            <div class="swiper-pagination"></div>
        </div>
      </section> 
      <script src="<?php echo URLROOT; ?>/js/ViewComplaints.js"></script>
 
    </body>

    <!-- Swiper JS -->
   <!-- <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script> -->

    <!-- JavaScript -->
      <!--Uncomment this line-->
    <!-- <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script> -->
</html>



<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <title>Document</title> -->
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Complaint.css">
</head>
    <body>
    <?php
        $role = "Admin";
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>
      <section class="home">
  
    <div class="slider-container swiper">
      <div class="slider-content">
        <div class="card-wrapper swiper-wrapper">
        <?php foreach ($data["complaints"] as $complaints): ?>

          <div class="card swiper-slide">
            <div class="image-content">
              <span class="overlay"></span>
              <div class="card-image">

                <img src="" class="card-img" alt="" />
              </div>
            </div>
            <div class="card-content">
            <h2 class="name"><?php echo $complaints->name ?></h2>
            <p class="description"><?php echo $complaints->message ?></p>

            <!-- <div><a href="C&A_Indoor_Project/Pages/Coach/user" class="btn">View All</a></div>   -->

            <div><a href="<?php echo URLROOT; ?>/Complaint/ComplaintDetails/<?php echo $complaints->id ;?>" class="button1" >View</a></div>
            
            </div>
          </div>
          <?php endforeach; ?>

         
        </div>
      </div>
      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
      <div class="swiper-pagination"></div>
    </div>
      </section>
      <script src="<?php echo URLROOT; ?>/js/ViewComplaints.js"></script>

  </body>
</html>

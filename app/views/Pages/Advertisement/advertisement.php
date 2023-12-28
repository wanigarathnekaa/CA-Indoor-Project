<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>addvertisement slider</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Advertisement.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="script.js" defer></script>
  </head>
  <body>
    <div class="wrapper">
      <i id="left" class="fa-solid fa-angle-left"></i>
      <ul class="carousel">
        <li class="card">

          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad1.jpeg" /></div>
          <h2>Practice Session</h2>
          <span>Coach Bhanuka</span>
          
        <div class="btn1">
              <a href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
              View more
    </a>
</div>



        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad3.jpg" /></div>
          <h2>Interactive Workshop</h2>
          <span>Coach Lasantha</span>
          <button class="btn1">View more</button>

        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad2.jpeg" /></div>
          <h2>Team approach</h2>
          <span>Coach Kasun</span>
          <button class="btn1">View more</button>
        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad2.jpeg" /></div>
          <h2>Individual learning</h2>
          <span>Coach Shantha</span>
          <button class="btn1">View more</button>

        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad1.jpeg" /></div>
          <h2>Team approach</h2>
          <span>Coach Shantha</span>
          <button class="btn1">View more</button>

        </li>
        <li class="card">
          <div class="img">
          <img src="<?php echo URLROOT; ?>/images/ad3.jpg" /></div>
          <h2>Individual learning</h2>
          <span>Coach Shantha</span>
          <button class="btn1">View more</button>

        </li>
      </ul>
      <i id="right" class="fa-solid fa-angle-right"></i>
    </div>
    <script  src="<?php echo URLROOT; ?>/js/advertisement.js"></script>

  </body>
</html>
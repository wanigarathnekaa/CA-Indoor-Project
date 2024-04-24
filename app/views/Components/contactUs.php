<!DOCTYPE html>
<html>

<head>
  <title>Contact Us</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/contactUs.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <!-- side bar -->
  <?php

  $role = $_SESSION['user_role'];
  require APPROOT . '/views/Pages/Dashboard/header.php';
  require APPROOT . '/views/Components/Side Bars/sideBar.php';
  ?>

  <!-- content -->
  <section class="home">
    <div class="container">
      <div class="content">
        <div class="left-side">
          <div class="address details">
            <i class="fas fa-map-marker-alt"></i>
            <!-- <div class="topic">Address</div> -->
            <a href="https://maps.app.goo.gl/TEsXxiHBK5fGkCkX6">
              <div class="text-one">Singhepura,</div>
              <div class="text-two">Battaramulla</div>
            </a>
          </div>
          <div class="phone details">
            <i class="fas fa-phone-alt"></i>
            <!-- <div class="topic">Phone</div> -->
            <div class="text-one"><a href="tel:0770722933">0770722933</a></div>
            <div class="text-two"><a href="tel:0701184455">0701184455</a></div>
          </div>
          <div class="email details">
            <i class="fas fa-envelope"></i>
            <!-- <div class="topic">Email</div> -->
            <div class="text-one"><a href="mailto:caindoor44@gmail.com">caindoor44@gmail.com</a></div>
          </div>
        </div>
        <div class="right-side">
          <div class="topic-text">Send us a message</div>
          <p>If you have any help or any types of issues related our company, you can send me message from here. It's my
            pleasure to help you.</p>
          <form action="<?php echo URLROOT; ?>/Complaint/create" method="POST">
            <div class="input-box">
              <input type="text" id="name" name="name" placeholder="Enter your name"
                value="<?php echo $_SESSION['user_name']; ?>">
            </div>
            <div class="input-box">
              <input type="text" id="email" name="email" placeholder="Enter your email"
                value="<?php echo $_SESSION['user_email']; ?>">
            </div>
            <div class="input-box">
              <textarea id="message" name="message" placeholder="Enter your message" value=""></textarea>
              <!-- <input type="text" id="message" name="message" placeholder="Enter your message" value="" required> -->
              <span class="form-invalid"><?php echo $data['message_err']; ?></span>
            </div>
            <div class="button">
              <input type="submit" value="Send Now">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
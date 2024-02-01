<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <title>Document</title> -->
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coachcard.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/ComplaintDetails.css">

</head>

<body>
      <!-- Sidebar -->
      <?php
        $role = "Admin";
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">
            <div class="carddiv">
                  <div class="card">
                        <img src="" >
                        <div class="hasini">
                           <div class="right-side">
          <div class="topic-text">Reply to the Complaint</div>
          <form id="contact" action="<?php echo URLROOT; ?>/Complaint/sendEmail/<?php echo $data['complaint']->id; ?>" method="post">
            <div class="input-box">
                  <input type="text" id="name" name="name" placeholder="Enter your name" value="<?php echo $data['complaint']->name; ?>">
            </div>
            <div class="input-box">
                  <input type="text" id="email" name="email" placeholder="Enter your email" value="<?php echo $data['complaint']->email; ?>">
            </div>
            <div class="input-box">
            <label for="name">Complaint:</label>

                 <textarea id="message" name="message1" placeholder="Enter your message"><?php echo $data['complaint']->message; ?></textarea>
            </div>
           
            <div class="input-box" id="abc">

                  <textarea id="message" name="message" placeholder="Enter your Reply" value="" rows="6"></textarea>
            </div>
            <div class="button">
              <input type="submit" value="Send Now" name="send">
            </div>
          </form>
        </div>
                              
                        </div>
                  </div>
            </div>
      </section>
</body>

</html>
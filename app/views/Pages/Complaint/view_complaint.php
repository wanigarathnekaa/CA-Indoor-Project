<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Complaint.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/order.css">
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
                  <?php if ($complaints->img) : ?>
                    <img class="profile-image card-img" src="<?= URLROOT ?>/public/profilepic/<?php echo $complaints->img; ?>"
                      style="max-width: 100%; max-height: 100%;" alt="" />
                  <?php else : ?>
                    <img class="profile-image card-img" src="<?= URLROOT ?>/public/profilepic/avatar.jpg"
                      style="max-width: 100%; max-height: 100%;" alt="" />
                  <?php endif; ?>
                </div>
              </div>
              <div class="card-content">
                <h2 class="name"><?php echo $complaints->name ?></h2>
                <p class="description"><?php echo $complaints->message ?></p>

                <!-- <div><a href="C&A_Indoor_Project/Pages/Coach/user" class="btn">View All</a></div>   -->

                <div><a href="<?php echo URLROOT; ?>/Complaint/ComplaintDetails/<?php echo $complaints->id; ?>"
                    class="button1">View</a></div>

              </div>
            </div>
          <?php endforeach; ?>
          
          <div class="card swiper-slide">
            <div class="image-content">
              <span class="overlay"></span>
              <div class="card-image">
                <img class="profile-image card-img" src="<?= URLROOT ?>/public/profilepic/avatar.jpg"
                  style="max-width: 100%; max-height: 100%;" alt="" />
              </div>
            </div>
            <div class="card-content">

              <h2 class="name">Contact users</h2>
              <p class="description"></p>

              <div><a href="<?php echo URLROOT; ?>/Complaint/SendMessage" class="button2"><i
                    class="fas fa-plus"></i></a></div>

            </div>
          </div>


        </div>
      </div>
      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
      <div class="swiper-pagination"></div>
    </div>

    <div class="table-container">
      <table id="coachTable">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Complaint</th>
            <th>Created Date</th>
          </tr>
        </thead>
        <tbody id="orderTable">
          <?php foreach ($data['allComplaints'] as $complaint): ?>
            <tr>
              <td>
                <?php echo $complaint->user_id; ?>
              </td>
              <td>
                <?php echo $complaint->name; ?>
              </td>
              <td>
                <?php echo $complaint->email; ?>
              </td>
              <td>
                <?php echo $complaint->message; ?>
              </td>
              <td>
                <?php echo $complaint->create_at; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
  <script src="<?php echo URLROOT; ?>/js/ViewComplaints.js"></script>

</body>

</html>
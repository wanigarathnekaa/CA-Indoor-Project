<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>advertisement slider</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Advertisement.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="script.js" defer></script>
  </head>
  <body>
  <?php
      $role = "User";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>
  <section class="home">

    <div class="wrapper">
 
      <div>
        <h1>Advertisement</h1> 

        <?php if ($role != "User") { ?>
        <a   class="btn2" href="<?php echo URLROOT; ?>/Pages/Add_Advertisements/advertisement">ADD +</a>     
              <?php } ?>
      </div>
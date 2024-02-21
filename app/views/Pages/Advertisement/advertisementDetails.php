<?php
$advertisement_id = isset($_GET['advert_id']) ? urldecode($_GET['advert_id']) : 0;
// echo $advertisement_id;
// print_r($data['adverts']);

$advertisement = array();

foreach ($data['adverts'] as $advert) {
  // Check if the current object has the target advertisement_id
  if ($advert->advertisement_id == $advertisement_id) {
    $advertisement[] = $advert;
    break;
  }
}

// print_r($advertisement);

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AddMoreDetails</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/AdvertisementDetails.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />
</head>

<body>
  <!-- Sidebar -->
  <?php
   $role = $_SESSION['user_role'];
  require APPROOT . '/views/Pages/Dashboard/header.php';
  require APPROOT . '/views/Components/Side Bars/sideBar.php';
  ?>

  <!-- Content -->
  <section class="home">
    <div class="card-wrapper">
      <div class="card">
        <!-- card left -->
        <div class="add-imgs">
          <div class="img-display">
            <div class="img-showcase">
              <img src="<?php echo URLROOT; ?>/public/uploads/<?php echo $advertisement[0]->img; ?>" />
            </div>
          </div>
        </div>
        <!-- card right -->
        <div class="product-content">
          <h2 class="product-title">
            <?php echo $advertisement[0]->title; ?>
          </h2>
          <div class="date">
            <p class="event-date">Date: <span>
                <?php echo $advertisement[0]->date; ?>
              </span></p>
          </div>
          <div class="product-detail">
            <h2>about this event: </h2>
            <p>
              <?php echo $advertisement[0]->content; ?>
            </p>
          </div>

          <?php if ($advertisement[0]->email == $_SESSION['user_email'] || $data['flag'] || $role == 'Manager') { ?>
            <div class="event-info">
              <a href="<?php echo URLROOT?>/Advertisement/editAdvertisement/<?php echo $advertisement[0]->advertisement_id?>">
              <button type="button" class="btn">Edit</button>
              </a>
              <button type="button" class="btn" onclick="openDeletePopup()">Delete</button>
            </div>
          <?php } ?>

          <div class="social-links">
            <p>Share At: </p>
            <a href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#">
              <i class="fab fa-whatsapp"></i>
            </a>
            <a href="#">
              <i class="fab fa-pinterest"></i>
            </a>
          </div>
        </div>
      </div>
    </div>



    <!-- popup windows -->
    <div class="popupcontainer" id="popupcontainer">
      <!-- confirm delete popup window -->
      <div class="deletepopup" id=deletepopup>
        <span class="close" onclick="closeDeletePopup()"><i class="fa-solid fa-xmark"></i></span>
        <h2>confirm delete</h2>
        <form action="<?php echo URLROOT?>/Advertisement/deleteAdvertisement/<?php echo $advertisement[0]->advertisement_id?>" method="POST">
              <div class="btns">
                    <button type="submit" class="button">Delete</button>
                    <button type="button" onclick="closeDeletePopup()">Cancel</button>
              </div>
              <!-- <div hidden name="submit"><span class="pd_email"></span></div> -->
              <!-- <input hidden name='submit' id="hid_input"> -->
        </form>
      </div>
    </div>
  </section>


  <!-- javascript -->
  <script src="<?php echo URLROOT; ?>/js/AdvertisementDetails.js"></script>
</body>

</html>
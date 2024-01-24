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

  <!-- side bar -->
  <?php
      $role = "User";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

  <!-- content -->
    <section class="home">

        <div class="topicdiv">
            <h1>Advertisement</h1>
            <?php if ($role = "User") { ?>
                <a class="btn" href="<?php echo URLROOT; ?>/Pages/Add_Advertisements/coach"><i class="fa-solid fa-file-circle-plus icon"></i></a>
            <?php } ?>
        </div>

        <div class="advertisements">
            <div class="ads">
                <?php foreach ($data["adverts"] as $advert): ?>
                    <div class="ads-card">
                        <div class="img">
                            <img src="<?php echo URLROOT; ?>/public/uploads/<?php echo $advert->img; ?>" />
                        </div>
                        <div class="ads-info">
                            <h2>
                                <?php echo $advert->title ?>
                            </h2>

                            <h4>
                                <?php echo $advert->name ?>
                            </h4>
                            <div class="viewmore">
                                <a class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/coach?advert_id=<?php echo $advert->advertisement_id; ?>">View more</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>     
    </section>

<!-- <script src="<?php echo URLROOT; ?>/js/advertisment.js"></script> -->
</body>
</html>
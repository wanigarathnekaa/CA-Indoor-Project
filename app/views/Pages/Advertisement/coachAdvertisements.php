<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Advertisement</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Advertisement.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />

</head>

<body>
    <div class="adbar">
        <div class="ad">
            <div class="adblock">
                <img class="adimage" src="<?php echo URLROOT; ?>/images/ad1.jpeg" />
                <div class="btnmore">
                    <a type="button" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement">
                        <div class="more-details">more details</div>
                    </a>
                    <i class='bx bxs-chevrons-right'></i>
                </div>
            </div>

            <div class="adblock">
                <img class="adimage" src="<?php echo URLROOT; ?>/images/ad2.jpeg" />
                <div class="btnmore">
                    <div class="more-details">more details</div>
                    <i class='bx bxs-chevrons-right'></i>
                </div>
            </div>
            <div class="adblock">
                <img class="adimage" src="<?php echo URLROOT; ?>/images/ad3.jpg" />
                <div class="btnmore">
                    <div class="more-details">more details</div>
                    <i class='bx bxs-chevrons-right'></i>
                </div>
            </div>

            <div>
                <a type="button" href="<?php echo URLROOT; ?>/Pages/Add_Advertisements/coach">
                    <div class="more-details">Add Advertisements</div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
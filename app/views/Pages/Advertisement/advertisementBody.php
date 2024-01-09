<!-- <?php print_r($data); ?> -->

<i id="left" class="fa-solid fa-angle-left"></i>
<ul class="carousel">

    <?php foreach ($data["adverts"] as $advert): ?>
        <li class="card">
            <div class="img">
                <img src="<?php echo URLROOT; ?>/public/uploads/<?php echo $advert->img; ?>" width="200" height="200" />
            </div>
            <h2>
                <?php echo $advert->title ?>
            </h2>
            <span>
                <?php echo $advert->name ?>
            </span>
            <div>
                <a class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
                    View more
                </a>
            </div>
        </li>
    <?php endforeach; ?>




    <!-- <li class="card">
        <div class="img">
            <img src="<?php echo URLROOT; ?>/images/ad1.jpEg" />
        </div>
        <h2>Interactive Workshop</h2>
        <span>Coach Lasantha</span>
        <div>
            <a class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
                View more
            </a>
        </div>
    </li>
    <li class="card">
        <div class="img">
            <img src="<?php echo URLROOT; ?>/images/ad2.jpeg" />
        </div>
        <h2>Team approach</h2>
        <span>Coach Kasun</span>
        <div>
            <a class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
                View more
            </a>
        </div>
    </li>
    <li class="card">
        <div class="img">
            <img src="<?php echo URLROOT; ?>/images/ad2.jpeg" />
        </div>
        <h2>Individual learning</h2>
        <span>Coach Shantha</span>
        <div>
            <a class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
                View more
            </a>
        </div>
    </li>
    <li class="card">
        <div class="img">
            <img src="<?php echo URLROOT; ?>/images/ad1.jpeg" />
        </div>
        <h2>Team approach</h2>
        <span>Coach Shantha</span>
        <div>
            <a class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
                View more
            </a>
        </div>
    </li>
    <li class="card">
        <div class="img">
            <img src="<?php echo URLROOT; ?>/images/ad3.jpg" />
        </div>
        <h2>Individual learning</h2>
        <span>Coach Shantha</span>
        <div>
            <a class="btn1" href="<?php echo URLROOT; ?>/Pages/AdvertisementDetails/advertisement" class="more-details">
                View more
            </a>
        </div>
    </li> -->
</ul>
<i id="right" class="fa-solid fa-angle-right"></i>
</div>
<script src="<?php echo URLROOT; ?>/js/advertisment.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coaches.css">
</head>

<body>
    <div class="coaches">
        <div class="profiles">
            <?php foreach($data as $coach):?>
                <div class="coachcard">
                    <a href="<?php echo URLROOT?>/Pages/CoachCard/user"><img class="image" src="<?php echo URLROOT; ?>/images/image1.jpg" /></a>
                    <div class="Name"><?php echo "{$coach->name}"?></div>
                </div>
            <?php endforeach;?>

            <!-- <div class="coachcard">
                <img class="image" src="<?php echo URLROOT; ?>/images/image2.jpg" />
                <div class="Name">Kamal Gunarathne</div>
            </div>
            <div class="coachcard">
                <img class="image" src="<?php echo URLROOT; ?>/images/image3.jpg" />
                <div class="Name">Mahela Jayawardhana</div>
            </div>
            <div class="coachcard">
                <img class="image" src="<?php echo URLROOT; ?>/images/image4.jpg" />
                <div class="Name">Kamal Gunarathne</div>
            </div>
            <div class="coachcard">
                <img class="image" src="<?php echo URLROOT; ?>/images/image5.jpg" />
                <div class="Name">Mahela Jayawardhana</div>
            </div>
            <div class="coachcard">
                <img class="image" src="./coachesimage//image1.jpg" />
                <div class="Name">Kamal Gunarathne</div>
            </div>
            <div class="coachcard">
                <img class="image" src="./coachesimage//image2.jpg" />
                <div class="Name">Kamal Gunarathne</div>
            </div>
            <div class="coachcard">
                <img class="image" src="./coachesimage/image3.jpg" />
                <div class="Name">Mahela Jayawardhana</div>
            </div>
            <div class="coachcard">
                <img class="image" src="./coachesimage//image4.jpg" />
                <div class="Name">Kamal Gunarathne</div>
            </div>
            <div class="coachcard">
                <img class="image" src="./coachesimage/image5.jpg" />
                <div class="Name">Mahela Jayawardhana</div>
            </div> -->
        </div>
</body>

</html>
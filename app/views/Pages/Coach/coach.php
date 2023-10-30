<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coaches.css">
</head>

<body>
    <div class="topic">
            <h1>Coaches</h1>
    </div>
    <div class="coaches">
        <div class="profiles">
            <?php foreach($data as $coach):?>
                <div class="coachcard">
                    <a href="<?php echo URLROOT?>/Pages/CoachCard/user"><img class="image" src="<?php echo URLROOT; ?>/images/image1.jpg" /></a>
                    <div class="Name"><?php echo "{$coach->name}"?></div>
                </div>
            <?php endforeach;?>
          </div>
        </div>
</body>

</html>
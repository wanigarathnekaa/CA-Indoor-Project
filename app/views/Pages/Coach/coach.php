<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coaches.css">
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
                <h1>Coaches</h1>
        </div>
        <div class="coaches">
            <div class="profiles">
                <?php foreach($data as $coach):?>
                    <div class="coachcard">
                        <a href="<?php echo URLROOT?>/Pages/CoachCard/user?email=<?php echo $coach->email;?>">
                            <div class="coach-img">
                                <?php if($coach->img == NULL):?>
                                    <img class="image" src="<?php echo URLROOT; ?>/public/profilepic/avatar.jpg">
                                <?php else:?>
                                    <img class="image" src="<?php echo URLROOT; ?>/public/profilepic/<?php echo $coach->img;?>">
                                <?php endif;?>
    
                            </div>
                            <div class="Name"><?php echo "{$coach->name}" ?></div>
                        </a>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
</body>

</html>
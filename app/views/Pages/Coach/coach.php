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
                <?php $i=0;?>
                <?php foreach($data['coaches'] as $coach):?>
                    <div class="coachcard">
                        <a href="<?php echo URLROOT?>/Pages/CoachCard/user?email=<?php echo $coach->email;?>">
                            <div class="coach-img">
                                <img class="image" src="<?php echo URLROOT; ?>/public/coaches/<?php echo $coach->img;?>">
                            </div>
                            <div class="Name"><?php echo "{$data['userCoach'][$i]->name}" ?></div>
                        </a>
                    </div>
                    <?php $i++;?>
                <?php endforeach;?>
            </div>
        </div>
    </section>
</body>

</html>
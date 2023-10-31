<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/ownerDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>
    <!-- <div class="titlecontainer">
        <h2>Owner Dashboard</h2>
    </div> -->
    <div class="containers">
        <div class="cards">
            <a class="card" href="#">
                <i class="fa-solid fa-image-portrait"></i>
                <h2>Managers</h2>
                <p>Total Managers: 2</p>
            </a>
            <a class="card" href="#">
                <i class="fa-solid fa-image-portrait"></i>
                <h2>Coachers</h2>
                <p>Total Coaches: 5</p>
            </a>
            <a class="card" href="#">
                <i class="fa-solid fa-image-portrait"></i>
                <h2>Players</h2>
                <p>Total Players: 23</p>
            </a>
            <a class="card" href="#">
                <i class="fa-solid fa-file-image"></i>
                <h2>Advertisement</h2>
                <p>Total Advertisement: 10</p>
            </a>
        </div>
    </div>


    <section class="">
    </section>

</body>

</html>

<?php
$role = "Owner";
require APPROOT . '/views/Pages/Dashboard/header.php';
require APPROOT . '/views/Components/Side Bars/sideBar.php';
?>
<?php
require APPROOT . '/views/Pages/Dashboard/Footer.php';
?>
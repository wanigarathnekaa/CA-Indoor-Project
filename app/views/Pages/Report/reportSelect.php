

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/SelectReport.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>


<body>

    <!-- Sidebar -->
    <?php
        $role = "Admin";
        require APPROOT.'/views/Pages/Dashboard/header.php';
        require APPROOT.'/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">

    <!-- Cards -->
    <div class="cardBox">
        <a class="card" href="<?php echo URLROOT; ?>/Reports/SalesAmount">
        <div>
        <h1>Filter Bookings</h1>
        <p></p>
        </div>
        <div class="iconBx"></div>
        </a>
    </div>

    <div class="cardBox">
        <a class="card" href="<?php echo URLROOT; ?>/Reports/SalesMonthly">
        <div>
        <h1>Monthly Booking</h1>
        <p></p>
        </div>
        <div class="iconBx"></div>
        </a>
    </div>

    <div class="cardBox">
        <a class="card" href="<?php echo URLROOT; ?>/Reports/OrderReport">
        <div>
        <h1>Filter Orders</h1>
        <p></p>
        </div>
        <div class="iconBx"></div>
        </a>
    </div>
         
           


    </section>



    <!-- javascripts -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>

</body>
</html>
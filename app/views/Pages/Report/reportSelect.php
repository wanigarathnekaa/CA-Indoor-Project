

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
        $role = $_SESSION['user_role'];
        require APPROOT.'/views/Pages/Dashboard/header.php';
        require APPROOT.'/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">

    <!-- Cards -->
    <div class="cardBox">
        <a class="card" href="<?php echo URLROOT; ?>/Pages/SalesAmountt">
        <div>
        <div class="cardName">Filtered Booking Report</div>

        </div>
        <div class="iconBx">
                    <i class='bx bxs-report'></i>
        </div>  
        </a>

        <a class="card" href="<?php echo URLROOT; ?>/Pages/SalesMonthlyy">
        <div>
        <div class="cardName">Monthly Reports</div>

        </div>
        <div class="iconBx">
            <!-- <i class='bx bxs-report'></i> -->
            <!-- <i class="fa-solid fa-file-invoice-dollar"></i> -->
            <i class="fa-solid fa-hand-holding-dollar"></i>
        </div>  
        </a>
     
        <a class="card" href="<?php echo URLROOT; ?>/Pages/OrderReportt">
        <div>
        <div class="cardName">Order Filtering Report</div>

        </div>
        <div class="iconBx">
            <!-- <i class='bx bxs-report'></i> -->
            <i class="fa-solid fa-arrow-down-wide-short"></i>
        </div> 
        </a>

       

        <a class="card" href="<?php echo URLROOT; ?>/Pages/Userlogss">
        <div>
        <div class="cardName">User Account Activity Report</div>

        </div>
        <div class="iconBx">
            <!-- <i class='bx bxs-report'></i> -->
            <i class="fa-solid fa-user-clock"></i>
        </div> 
        </a>

        <a class="card" href="<?php echo URLROOT; ?>/Pages/Weekly_Reservationn">
        <div>
        <div class="cardName">Filtered Charts</div>

        </div>
        <div class="iconBx">
            <!-- <i class='bx bxs-report'></i> -->
            <i class="fa-solid fa-chart-area"></i>
        </div> 
        </a>
    </div>
         
           


    </section>



    <!-- javascripts -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>

</body>
</html>


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
        <div class="cardName">Filtered Booking Report</div>

        </div>
        <div class="iconBx">
                    <i class='bx bxs-report'></i>
        </div>  
        </a>

        <a class="card" href="<?php echo URLROOT; ?>/Reports/SalesMonthly">
        <div>
        <div class="cardName">Monthly Income Report: Booking Analysis</div>

        </div>
        <div class="iconBx">
            <i class='bx bxs-report'></i>
        </div>  
        </a>
     
        <a class="card" href="<?php echo URLROOT; ?>/Reports/OrderReport">
        <div>
        <div class="cardName">Order Filtering Report</div>

        </div>
        <div class="iconBx">
            <i class='bx bxs-report'></i>
        </div> 
        </a>

        <a class="card" href="<?php echo URLROOT; ?>/Reports/MonthlyOrderReport">
        <div>
        <div class="cardName">Monthly Income Report: Order Analysis</div>

        </div>
        <div class="iconBx">
            <i class='bx bxs-report'></i>
        </div> 
        </a>

        <a class="card" href="<?php echo URLROOT; ?>/Reports/Userlogs">
        <div>
        <div class="cardName">User Account Activity Report</div>

        </div>
        <div class="iconBx">
            <i class='bx bxs-report'></i>
        </div> 
        </a>

        <a class="card" href="<?php echo URLROOT; ?>/Reports/Weekly_Rservation">
        <div>
        <div class="cardName">Weekly Rservation Chart</div>

        </div>
        <div class="iconBx">
            <i class='bx bxs-report'></i>
        </div> 
        </a>
    </div>
         
           


    </section>



    <!-- javascripts -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>

</body>
</html>
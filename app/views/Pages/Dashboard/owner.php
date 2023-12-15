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

    <!-- Sidebar -->
    <?php
        $role = "Owner";
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">

        <!-- Cards -->
        <div class="cardBox">
            <a class="card" href="#">
                <div>
                    <div class="numbers">3</div>
                    <div class="cardName">Managers</div>
                </div>
                <div class="iconBx">
                <i class="fa-solid fa-user-tie"></i>
                </div>
            </a>

            <a class="card" href=#>
                <div>
                    <div class="numbers">15</div>
                    <div class="cardName">Coaches</div>
                </div>
                <div class="iconBx">
                    <i class="fa-solid fa-user-group"></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers">80</div>
                    <div class="cardName">Players</div>
                </div>
                <div class="iconBx">
                        <i class="fa-solid fa-users"></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers">284</div>
                    <div class="cardName">Advertisement</div>
                </div>
                <div class="iconBx">
                        <i class="fa-brands fa-adversal"></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Reports</div>
                </div>
                <div class="iconBx">
                    <i class='bx bxs-report'></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Registration</div>
                </div>

                <div class="iconBx">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Confirmation Fee</div>
                </div>

                <div class="iconBx">
                    <i class="fa-solid fa-comments-dollar"></i>
                </div>
            </a>
        </div>


    </section>

    <!-- javascripts -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>

</body>
</html>
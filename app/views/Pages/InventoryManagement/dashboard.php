<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/InventoryDashboard.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = "Manager";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <section class="working-panel">
            <div class="fluid-panel">
                <h1 class="display-4">C&A INDOOR CRICKET SHOP</h1>
            </div>
            <div class="image-text">
                <span class="image">
                    <img src="http://localhost/C&A_Indoor_Project/images/Logo3.png" alt="logo">
                </span>
            </div>
            <hr>
        </section>
        <!-- Cards -->
        <div class="cardBox">

            <a class="card" href="C&A_Indoor_Project/Pages/Brand/manager">
                <div>
                    <div class="numbers">10</div>
                    <div class="cardName">Brands</div>
                </div>
                <div class="iconBx">
                    <i class="fas fa-dolly-flatbed"></i>
                </div>
            </a>

            <a class="card" href="C&A_Indoor_Project/Pages/Category/manager">
                <div>
                    <div class="numbers">11</div>
                    <div class="cardName">Categories</div>
                </div>
                <div class="iconBx">
                    <i class="fas fa-dolly"></i>
                </div>
            </a>

            <a class="card" href="C&A_Indoor_Project/Pages/Product/manager">
                <div>
                    <div class="numbers">12</div>
                    <div class="cardName">Items</div>
                </div>

                <div class="iconBx">
                    <i class="fas fa-shopping-basket"></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers">13</div>
                    <div class="cardName">Orders</div>
                </div>
                <div class="iconBx">
                    <i class="fas fa-truck"></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers">14</div>
                    <div class="cardName">Deliveries</div>
                </div>
                <div class="iconBx">
                    <i class="fas fa-truck-loading"></i>
                </div>
            </a>
        </div>

        <!-- Table -->
        <div class="table-container">
            <h2>New Orders</h2>
            <hr>
            <table id="coachTable">
                <!-- table header -->
                <thead>
                    <tr>
                        <th>Order_ID</th>
                        <th>Order Name</th>
                        <th>Date</th>
                        <th>Paid Status</th>
                        <th>Order Status</th>
                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Order_01</td>
                        <td>2024-01-28</td>
                        <td>paid</td>
                        <td>complete</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Order_02</td>
                        <td>2024-01-28</td>
                        <td>Unpaid</td>
                        <td>Incomplete</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Order_03</td>
                        <td>2024-01-28</td>
                        <td>paid</td>
                        <td>complete</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Order_04</td>
                        <td>2024-01-28</td>
                        <td>paid</td>
                        <td>Incomplete</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Order_05</td>
                        <td>2024-01-28</td>
                        <td>Unpaid</td>
                        <td>complete</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Order_06</td>
                        <td>2024-01-28</td>
                        <td>Unpaid</td>
                        <td>complete</td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <ul class="pagination">
                    <li><a href="#" class="page-link">&laquo; Prev</a></li>
                    <li><a href="#" class="page-link">1</a></li>
                    <li><a href="#" class="page-link">2</a></li>
                    <li><a href="#" class="page-link">3</a></li>
                    <li><a href="#" class="page-link">4</a></li>
                    <li><a href="#" class="page-link">5</a></li>
                    <li><a href="#" class="page-link">Next &raquo;</a></li>
                </ul>
            </div>
    </section>


    <!-- javascripts -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/InventoryDashboard.js"></script>
</body>

</html>
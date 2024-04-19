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

            <a class="card" href="C&A_Indoor_Project/Pages/Order/manager">
                <div>
                    <div class="numbers">13</div>
                    <div class="cardName">Orders</div>
                </div>
                <div class="iconBx">
                    <i class="fas fa-truck"></i>
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
                    <?php foreach (array_reverse($data) as $order): ?>
                        <tr>
                            <td><?php echo $order->order_id; ?></td>
                            <td><?php echo $order->full_name; ?></td>
                            <td><?php echo $order->order_date; ?></td>
                            <td><?php echo $order->payment_status; ?></td>
                            <td><?php echo $order->order_status; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- OrderDetails -->
            <div id="orderDetailsModal" class="modal">
                <div class="modal-content">
                    <div class="title">
                        <h2 class="modal-title">Order Details</h2>
                    </div>
                    <hr>

                    <div class="customerDetails">
                        <h3>Customer Details</h3>
                        <div>
                            <span id="name" class="name"></span><br>
                            <span id="email" class="email"></span><br>
                            <span id="phone" class="phone"></span><br>
                            <span id="addr" class="addr"></span><br>
                        </div>
                    </div>

                    <div class="orderItems">
                        <h3>Order Items</h3>
                        <table id="orderItemsTable">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Price per Unit</th>
                                </tr>
                            </thead>
                            <tbody id="items">
                                <!-- Order items will be appended here -->
                            </tbody>
                        </table>
                    </div>


                    <div class="orderStatus">
                        <h3>Order Status</h3>
                        <span id="status" class="status"></span>
                        <button id="Change_Status">Change Status</button>
                    </div>

                    <hr>

                    <div class="btn">
                        <input type="hidden" id="form_type" name="form_type">
                        <!-- <button type="button">Okay</button> -->
                        <button type="button" onclick="closeModal()">Okay</button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <ul class="pagination">
                    <li><a href="#" class="page-link" id="prevLink">&laquo; Prev</a></li>
                    <li><a href="#" class="page-link">1</a></li>
                    <li><a href="#" class="page-link">2</a></li>
                    <li><a href="#" class="page-link">3</a></li>
                    <li><a href="#" class="page-link">4</a></li>
                    <li><a href="#" class="page-link">5</a></li>
                    <li><a href="#" class="page-link" id="nextLink">Next &raquo;</a></li>
                </ul>
            </div>
    </section>


    <!-- javascripts -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/InventoryDashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        //Select the table row when clicked
        $(document).ready(function () {
            $('#coachTable tbody tr').click(function () {
                $(this).addClass('selected').siblings().removeClass('selected');
                console.log($(this).find('td:first').text());
                $("#orderDetailsModal").css("display", "block");
                $.ajax({
                    url: "<?php echo URLROOT; ?>/Order/getOrderDetails",
                    type: "POST",
                    data: {
                        order_id: $(this).find('td:first').text()
                    },
                    success: function (response) {
                        console.log(response);
                        var order = response.order; // Access the order object from the response
                        var orderItems = response.orderItems; // Access the orderItems array from the response
                        $("#name").text("Name: " + order.full_name);
                        $("#email").text("Email: " + order.email);
                        $("#phone").text("Phone: " + order.mobile_number);
                        $("#addr").text("Address: " + order.address);
                        $("#status").text("Status: " + order.order_status);
                        // Loop through orderItems and append them to the items element
                        var itemsTable = $("#orderItemsTable tbody");
                        itemsTable.empty(); // Clear previous entries

                        for (var i = 0; i < orderItems.length; i++) {
                            var row = "<tr>" +
                                "<td>" + orderItems[i].product_id + "</td>" +
                                "<td>" + orderItems[i].quantity + "</td>" +
                                "<td>" + orderItems[i].price_per_unit + "</td>" +
                                "</tr>";
                            itemsTable.append(row);
                        }
                        $("#items").html(itemsText);
                    }
                });
            });

            $('#Change_Status').click(function () {
                $stat = "";
                if ($("#status").text() == "Status: Not Complete") {
                    $stat = "Complete";
                } else {
                    $stat = "Not Complete";
                }
                var orderId = $("#coachTable tbody tr.selected td:first").text();
                $.ajax({
                    url: "<?php echo URLROOT; ?>/Order/changeOrderStatus",
                    type: "POST",
                    data: {
                        order_id: orderId,
                        new_status: $stat
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status == "success") {
                            $("#status").text("Status: " + $stat);
                        } else {
                            alert("Status change failed");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
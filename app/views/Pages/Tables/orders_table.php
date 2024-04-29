<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Reservation_Table.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/notification.css">

    <title>Reservation</title>
</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = $_SESSION['user_role'];
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- <?php print_r($data); ?> -->

    <!-- Content -->
    <section class="home">

        <!-- Table Topic -->
        <div class="table-topic">
            <div class="topic-name">
                <h1>Orders :
                    <?php echo count($data); ?>
                </h1>
            </div>

            <?php if ($role == "Cashier"): ?>
                <div class="add-btn">
                    <a href="http://localhost/C&A_Indoor_Project/Pages/Order/Cashier">
                        <i class="fa-solid fa-cart-plus icon"></i>
                        Add Order
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Table Sort -->
        <div class="tableSort">
            <div class="sort">
                <label for="payfilter">Status :</label>
                <select name="filter" id="payfilter">
                    <option value="All">All</option>
                    <option value="Pending">Pending</option>
                    <option value="Paid">Paid</option>
                    <option value="Not Paid">Not Paid</option>
                </select>
            </div>
            <div class="sort">
                <label for="pickupModeFilter">Mode :</label>
                <select name="filter" id="pickupModeFilter"> <!-- Changed id to pickupModeFilter -->
                    <option value="All">All</option>
                    <option value="pickup at store">pickup at store</option>
                    <option value="online delivery">online delivery</option>
                </select>
            </div>
            <div class="sort">
                <label for="orderStatus">Order Status :</label>
                <select name="filter" id="orderStatus"> <!-- Changed id to orderStatus -->
                    <option value="All">All</option>
                    <option value="Complete">Complete</option>
                    <option value="Not Complete">Not Complete</option>
                </select>
            </div>
            <div class="sort">
                <label>Date :</label>
                <input type="date" id="date" name="date">
            </div>

            <div class="search">
                <label>
                    <input type="text" placeholder="Search here" id="searchInput">
                    <i class="fa-solid fa-magnifying-glass icon"></i>
                </label>
            </div>

        </div>

        <!-- Table -->
        <div class="table-container">
            <table id="coachTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Order Date</th>
                        <th>Pickup Mode</th>
                        <th>Payment Method</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    <?php foreach ($data as $order):
                        $payment_status_color = '';
                        if ($order->payment_status == 'Paid') {
                            $payment_status_color = '#30c030';
                        } else if ($order->payment_status == 'Not Paid') {
                            $payment_status_color = '#e03333';
                        } else if ($order->payment_status == 'Pending') {
                            $payment_status_color = '#ffcc00';
                        }


                        $order_status_color = '';
                        if ($order->order_status == 'Complete') {
                            $order_status_color = '#30c030';
                        } else if ($order->order_status == 'Not Complete') {
                            $order_status_color = '#e03333';
                        }
                        ?>
                        <tr>
                            <td>
                                <?php echo $order->order_id; ?>
                            </td>
                            <td>
                                <?php echo $order->full_name; ?>
                            </td>
                            <td>
                                <?php echo $order->email; ?>
                            </td>
                            <td>
                                <?php echo $order->mobile_number; ?>
                            </td>
                            <td>
                                <?php echo $order->order_date; ?>
                            </td>
                            <td>
                                <?php echo str_replace('_', ' ', $order->pickup_mode); ?>
                            </td>
                            <td>
                                <?php echo str_replace('_', ' ', $order->payment_method); ?>
                            </td>
                            <td>
                                <span class="status" style="background-color: <?php echo $order_status_color; ?>">
                                    <?php echo str_replace('_', ' ', $order->order_status); ?>
                                </span>
                            </td>
                            <td>
                                <span class="status" style="background-color: <?php echo $payment_status_color; ?>">
                                    <?php echo str_replace('_', ' ', $order->payment_status); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Popup message -->
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
                                <th>Product</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>
                        <tbody id="items">
                            <!-- Order items will be appended here -->
                        </tbody>
                    </table>
                </div>


                <div class="orderStatus">
                    <h3>Order Status</h3>
                    <span id="TotalAmount" class="TotalAmount"></span>
                    <div class="statusrow">
                        <span id="OrderStatus" class="OrderStatus"></span>
                        <button id="Change_Status">Change Status</button>
                    </div>
                    <div class="statusrow">
                        <span id="PaymentStatus" class="PaymentStatus"></span>
                        <button id="Change_Payment">Paid</button>
                    </div>

                </div>

                <hr>

                <div class="btn">
                    <input type="hidden" id="form_type" name="form_type">
                    <!-- <button type="button">Okay</button> -->
                    <button type="button" onclick="closeModal()">Okay</button>
                </div>
            </div>
        </div>
    </section>

    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var modal = document.getElementById("orderDetailsModal");
        function closeModal() {
            modal.style.display = "none";
            location.reload();
        }

        $(document).ready(function () {

            $("#payfilter").on("change", function () {
                var selectedValue = $(this).val();
                if (selectedValue != "All") {
                    $("table tbody tr").hide().filter(function() {
                        // Check if the row contains the selected value
                        return $(this).text().indexOf(selectedValue) > -1;
                    }).show();
                    // Hide rows with "Not Paid" if "Paid" is selected
                    if (selectedValue === "Paid") {
                        $("table tbody tr").filter(function() {
                            return $(this).text().indexOf("Not Paid") > -1;
                        }).hide();
                    }
                } else {
                    // Show all rows when "All" is selected
                    $("table tbody tr").show();
                }
            });

            $("#pickupModeFilter").on("change", function () { // Corrected ID here
                selectedValue = $(this).val();
                if (selectedValue != "All") {
                    $("table tbody tr").hide().filter(function () {
                        $(this).toggle($(this).text().indexOf(selectedValue) > -1);
                    }).show();
                } else {
                    $("table tbody tr").show();
                }
            });

            $("#orderStatus").on("change", function () { // Corrected ID here
                var selectedValue = $(this).val();
                if (selectedValue != "All") {
                    $("table tbody tr").hide().filter(function() {
                        
                        return $(this).text().indexOf(selectedValue) > -1;
                    }).show();
                    
                    if (selectedValue === "Complete") {
                        $("table tbody tr").filter(function() {
                            return $(this).text().indexOf("Not Complete") > -1;
                        }).hide();
                    }
                } else {
                    // Show all rows when "All" is selected
                    $("table tbody tr").show();
                }
            });


            $("#date").on("change", function () {
                selectedValue = $(this).val();
                if (selectedValue != "All") {
                    $("table tbody tr").filter(function () {
                        $(this).toggle($(this).text().indexOf(selectedValue) > -1);
                    });
                } else {
                    $("table tbody tr").show();
                }

            });
            $("#searchInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function () {
                    var rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(value) > -1);
                });
            });

            var orderId = "";
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
                        var products = response.products; // Access the products array from the response

                        $("#name").text("Name: " + order.full_name);
                        $("#email").text("Email: " + order.email);
                        $("#phone").text("Phone: " + order.mobile_number);
                        $("#addr").text("Address: " + order.address);
                        $("#TotalAmount").text("Total Amount: Rs." + order.price);
                        $("#OrderStatus").text("Status: " + order.order_status);
                        $("#PaymentStatus").text("Payment Status: " + order.payment_status);
                        orderId = order.order_id;

                        if (order.payment_status == "Paid") {
                            $("#Change_Payment").prop("disabled", true);
                        }

                        var itemsTable = $("#orderItemsTable tbody");
                        itemsTable.empty(); // Clear previous entries

                        for (var i = 0; i < orderItems.length; i++) {
                            var item = orderItems[i];
                            var product = products[i];
                            var row = '<tr>';
                            row += '<td><img width="60px" height="50px" src="<?= URLROOT ?>/CricketShop/' + product.product_thumbnail + '">' + '</td>';
                            row += '<td>' + product.product_title + '</td>';
                            row += '<td>' + item.quantity + '</td>';
                            row += '<td>' + item.price_per_unit + '</td>';
                            row += '</tr>';
                            itemsTable.append(row);
                        }
                        $("#items").html(itemsText);
                    }
                });
            });

            $('#Change_Status').click(function () {
                $stat = "";
                if ($("#OrderStatus").text() == "Status: Not Complete") {
                    $stat = "Complete";
                } else {
                    $stat = "Not Complete";
                }
                $.ajax({
                    url: "<?php echo URLROOT; ?>/Order/changeOrderStatus",
                    type: "POST",
                    data: {
                        order_id: $('#orderTable tr.selected td:first').text(),
                        new_status: $stat
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status == "success") {
                            $("#OrderStatus").text("Status: " + $stat);
                        } else {
                            // alert("Status change failed");
                            var notificationDiv = $('<div class="notification2"><div class="notification_body"><h3 class="notification_title">Status change failed</h3></div><div class="notification2_progress"></div></div>');
                            $('body').append(notificationDiv);
                            setTimeout(function() {
                                notificationDiv.remove();
                            }, 3000);
                        }
                    }
                });
            });

            $('#Change_Payment').click(function () {
                $.ajax({
                    url: "<?php echo URLROOT; ?>/Order/changePaymentStatus",
                    type: "POST",
                    data: {
                        order_id: $('#orderTable tr.selected td:first').text(),
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status == "success") {
                            $("#PaymentStatus").text("Payment Status: Paid");
                            $("#Change_Payment").prop("disabled", true);
                        } else {
                            // alert("Payment status change failed");
                            var notificationDiv = $('<div class="notification2"><div class="notification_body"><h3 class="notification_title">Payment status change failed</h3></div><div class="notification2_progress"></div></div>');
                            $('body').append(notificationDiv);
                            setTimeout(function() {
                                notificationDiv.remove();
                            }, 3000);
                        }
                    }
                });
            });
        });
    </script>
</body>
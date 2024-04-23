<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/order.css">

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
        <div class="header">
            <h2>Orders</h2>
            <button type="button" id="addOrder" onclick="openModal()">Add New Order</button>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <h2 class="modal-title">Add New Order</h2>
                    <form method="POST" id="orderForm">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <select name="category_name" id="category_name" class="form-control">
                                    <option value="0">Select Category</option>
                                    <?php foreach ($data['categories'] as $category): ?>
                                        <option value="<?php echo $category->category_id; ?>">
                                            <?php echo $category->category_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="form-invalid-2"></span>
                            </div>
                            <!-- Product Brand Name -->
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label>
                                <select name="brand_name" id="brand_name" class="form-control">
                                    <option value="0">Select a Category first</option>
                                </select>
                                <span class="form-invalid-3"></span>
                            </div>
                            <!-- Product Item Name -->
                            <div class="form-group">
                                <label for="brand_name">Select Item</label>
                                <select name="item_name" id="item_name" class="form-control">
                                    <option value="0">Select a Brand first</option>
                                </select>
                                <span class="form-invalid-3"></span>
                            </div>
                            <div class="btn">
                                <button type="button" id="addItem">Add</button>
                            </div>
                        </div>
                        <div class="btn">
                            <input type="hidden" id="form_type" name="form_type">
                            <button type="submit" id="submit">Save</button>
                            <button type="button" onclick="closeModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table id="coachTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Order Date</th>
                        <th>Payment Method</th>
                        <th>Pickup Mode</th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    <?php foreach ($data['orders'] as $order): ?>
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
                                <?php echo $order->order_date; ?>
                            </td>
                            <td>
                                <?php echo str_replace('_', ' ', $order->payment_method); ?>
                            </td>
                            <td>
                                <?php echo str_replace('_', ' ', $order->pickup_mode); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/order.js"></script>
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
                        var products =response.products;

                        $("#name").text("Name: " + order.full_name);
                        $("#email").text("Email: " + order.email);
                        $("#phone").text("Phone: " + order.mobile_number);
                        $("#addr").text("Address: " + order.address);
                        $("#status").text("Status: " + order.order_status);
                        // Loop through orderItems and append them to the items element
                        var itemsTable = $("#orderItemsTable tbody");
                        itemsTable.empty(); // Clear previous entries

                        for (var i = 0; i < orderItems.length; i++) {
                            var item = orderItems[i];
                            var product = products[i];
                            var row = '<tr>';
                            row += '<td><img width="60px" height="50px" src="<?= URLROOT ?>/CricketShop/'+ product.product_thumbnail +'">'+'</td>';                                 
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
                if ($("#status").text() == "Status: Not Complete") {
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
                            $("#status").text("Status: " + $stat);
                        } else {
                            alert("Status change failed");
                        }
                    }
                });
            });

            $("#category_name").change(function (e) {
                e.preventDefault();
                var id = $("#category_name").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Brand/getBrandCategoryById",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        $("#brand_name").html(response.output);
                    }
                })
            });

            $("#brand_name").change(function (e) {
                e.preventDefault();
                var id = $("#category_name").val();
                var brand_id=$("#brand_name").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Product/getItemByCategoryBrand",
                    data: {
                        cat_id: id,
                        brand_id: brand_id
                    },
                    dataType: 'json',
                    success: function (response) {
                        $("#item_name").html(response.output);
                    }
                })
            });
        });

    </script>
</body>

</html>
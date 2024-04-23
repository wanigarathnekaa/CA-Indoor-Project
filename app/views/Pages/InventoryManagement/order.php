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
                            </div>
                            <!-- Product Brand Name -->
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label>
                                <select name="brand_name" id="brand_name" class="form-control">
                                    <option value="0">Select a Category first</option>
                                </select>
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
                        <span id="invalid1" style="color:red;"></span>

                        <div style="margin-top:20px;" class="orderItems">
                            <h3>Added Items</h3>
                            <table id="orderItemsTable">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="items">
                                    <!-- Order items will be appended here -->
                                </tbody>
                            </table>
                        </div>
                        <span id="totPrice"></span>

                        <div class="col-50" id="customer_details" style="display: none;">
                            <h2 class="topic">Order Details</h2>

                            <div class="col-md-6">
                                <!-- Pickup mode -->
                                <div class="form-group">
                                    <label for="pickup">Pickup Mode</label>
                                    <select id="pickup" name="pickup">
                                        <option disabled selected>Select Pickup Mode</option>
                                        <option value="pickup_at_store">Pickup at the Store</option>
                                        <option value="online_delivery">Online Delivery</option>
                                    </select>
                                    <span id="invalid2" style="color:red;"></span>
                                </div>

                                <!-- Payment method -->
                                <div class="form-group">
                                    <label for="payment">Payment Method</label>
                                    <select id="payment" name="payment">
                                        <option disabled selected>Select Pickup Mode First</option>
                                    </select>
                                    <span id="invalid3" style="color:red;"></span>
                                </div>
                            </div>

                            <label for="fname">Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                            <span id="invalid4" style="color:red;"></span>

                            <label for="phone">Mobile Number</label>
                            <input type="text" id="phone" name="phone" placeholder="0712345678">
                            <span id="invalid5" style="color:red;"></span>

                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com">
                            <span id="invalid6" style="color:red;"></span>

                            <label for="adr">Address</label>
                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                            <span id="invalid7" style="color:red;"></span>

                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="New York">
                            <span id="invalid8" style="color:red;"></span>
                        </div>

                        <div class="btn">
                            <button type="button" style="display:none;" id="saveOrder">Save Order</button>
                            <button type="button" id="placeOrder">Place Order</button>
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
                        <span id="email1" class="email"></span><br>
                        <span id="phone1" class="phone"></span><br>
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
        var selectedItems = [];
        var total_price = 0;
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
                        var products = response.products;

                        $("#name").text("Name: " + order.full_name);
                        $("#email1").text("Email: " + order.email);
                        $("#phone1").text("Phone: " + order.mobile_number);
                        $("#addr").text("Address: " + order.address);
                        $("#status").text("Status: " + order.order_status);
                        // Loop through orderItems and append them to the items element
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
                var brand_id = $("#brand_name").val();

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

            $("#addItem").click(function (e) {
                e.preventDefault();

                var item_id = $("#item_name").val();
                console.log(item_id);
                if (item_id == 0 || item_id == null) {
                    $("#invalid1").text("Please select an item");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Product/getProductByID",
                    data: {
                        id: item_id
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        item_id = 0;
                        // Create a new row
                        var newRow = '<tr>';
                        newRow += '<td><img width="60px" height="50px" src="<?= URLROOT ?>/CricketShop/' + response.product_thumbnail + '">' + '</td>';
                        newRow += '<td>' + response.product_title + '</td>';
                        newRow += '<td><input type="number" class="quantity" value="1"></td>'; // Quantity input
                        newRow += '<td><span style="color:red"><i class="fa-solid fa-trash-can delete icon"></i></span></td>';
                        newRow += '</tr>';

                        total_price += response.selling_price * (1-(response.discount/100));
                        $("#totPrice").html('<p>Total Price: <b>Rs. ' + total_price + '</b></p>');
                        console.log(total_price);

                        select_item = {
                            p_id: response.product_id,
                            qty: 1,
                            product_price: response.selling_price,
                            discount: response.discount
                        }

                        selectedItems.push(select_item);
                        console.log(selectedItems);

                        // Append the new row to the items tbody
                        $("#items").append(newRow);

                        // Clear selected fields
                        $("#category_name").val('');
                        $("#brand_name").val('');
                        $("#item_name").val('');
                    }
                });
            });

            $("#pickup").change(function (e) {
                e.preventDefault();
                var pickupOption = $("#pickup").val();
                if (pickupOption == 'pickup_at_store') {
                    $("#payment").html('<option value="pay_at_store">Pay at the Store</option>');
                    $("#adr, #city").prop('disabled', true);
                } else if (pickupOption == 'online_delivery') {
                    $("#payment").html('<option value="pay_cash_on_delivery">Cash On Delivery</option>' +
                        '<option value="pay_at_store">Pay at the Store</option>');
                    $("#adr, #city").prop('disabled', false);
                }
            });

            $("#placeOrder").click(function (e) {
                e.preventDefault();
                $("#customer_details").css("display", "block");
                $("#placeOrder").css("display", "none");
                $("#saveOrder").css("display", "block");
                if(selectedItems.length == 0){
                    $("#invalid1").text("Please add items to the order");
                    return;
                }
            });

            $("#saveOrder").click(function (e) {
                e.preventDefault();
                var pickup = $('#pickup').val();
                var payment = $('#payment').val();
                var fname = $('#fname').val();
                var email = $('#email').val();
                var adr = $('#adr').val();
                var phone = $('#phone').val();
                var city = $('#city').val();
                var price = total_price;

                $.ajax({
                    type: "POST",
                    url: "<?= URLROOT; ?>/Order/saveOrder",
                    data: {
                        pickup: pickup,
                        payment: payment,
                        fname: fname,
                        email: email,
                        adr: adr,
                        phone: phone,
                        city: city,
                        price: price,
                        items: selectedItems
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.status == "success") {
                            alert("Order placed successfully");
                            location.reload();
                        } else {
                            $("#invalid2").text("response.pickup_err");
                            $("#invalid3").text(response.payment_err);
                            $("#invalid4").text(response.fname_err);
                            $("#invalid5").text(response.phone_err);
                            $("#invalid6").text(response.email_err);
                            $("#invalid7").text(response.adr_err);
                            $("#invalid8").text(response.city_err);
                        }
                    }
                });
            });
        });

        $(document).on("click", ".delete.icon", function () {
            var row = $(this).closest("tr");
            var index = row.index();
            row.remove();
            selectedItems.splice(index, 1);
            console.log(selectedItems);
        });

    </script>
</body>

</html>
<?php
include_once APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>

<div class="row">
    <div class="col-75">
        <div class="detailscontainer">
            <form action="" id="orderForm">
                <div class="col-50">
                    <h2 class="topic">Delivery Details</h2>

                    <div class="col-md-6">
                        <!-- Pickup mode -->
                        <div class="form-group">
                            <label for="pickup">Pickup Mode</label>
                            <select id="pickup" name="pickup">
                                <option disabled selected>Select Pickup Mode</option>
                                <option value="pickup_at_store">Pickup at the Store</option>
                                <option value="online_delivery">Online Delivery</option>
                            </select>
                        </div>

                        <!-- Payment method -->
                        <div class="form-group">
                            <label for="payment">Payment Method</label>
                            <select id="payment" name="payment">
                                <option disabled selected>Select Pickup Mode First</option>
                            </select>
                        </div>
                    </div>

                    <div class="notice">
                        <p>Enter Email If You Have Add Orders Previously!</p>
                    </div>

                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                    <span id="invalid-1" style="color:red; margin-bottom:13px;"></span>

                    <label for="phone">Mobile Number</label>
                    <input type="text" id="phone" name="phone" placeholder="0712345678">
                    <span id="invalid-2" style="color:red; margin-bottom:13px;"></span>

                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com">
                    <span id="invalid-3" style="color:red; margin-bottom:13px;"></span>

                    <label for="adr">Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                    <span id="invalid-4" style="color:red; margin-bottom:13px;"></span>

                    <label for="city">City</label>
                    <input type="text" id="city" name="city" placeholder="New York">
                    <span id="invalid-5" style="color:red; margin-bottom:13px;"></span>
                </div>
                <div class="check">
                    <input type="submit" value="Continue to checkout" class="btn">
                </div>
            </form>
        </div>
    </div>
    <?php
    $qty = 0;
    $total_price = 0;
    $product_total = 0;
    foreach ($data["cartItems"] as $item) {
        $product_total += $item->product_price * $item->qty;
        $qty += $item->qty;
        $total_price += $item->total_amount;
    }

    ?>


    <div class="col-25">
        <div class="prizecontainer">
            <h2 class="topic">Bill</h2>
            <p>Items <span class="price">
                    <?php echo $qty; ?>
                </span></p>
            <p>Delivery <span class="price">Free</span></p>
            <p>Total price <span class="price">LKR
                    <?php echo number_format($product_total); ?>
                </span></p>
            <p>Discount <span class="price">
                    <?php echo number_format((($product_total - $total_price) / $product_total) * 100, 2, '.', '') ?>%
                </span></p>
            <hr>
            <p class="tot">Total Bill <span class="price"><b>LKR
                        <?php echo number_format($total_price); ?>
                    </b></span></p>
        </div>
    </div>
</div>

<?php
include_once APPROOT . '/views/Pages/CricketShop/crickFooter.php';
?>
<script src="https://www.payhere.lk/lib/payhere.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var cartCount = '<?= count($data['cartItems']) ?>';
        if (cartCount == 0) {
            cartCount = 0;
        }
        $('#cartCount').html(cartCount);

        $("#pickup").change(function (e) {
            e.preventDefault();
            var pickupOption = $("#pickup").val();
            if (pickupOption == 'pickup_at_store') {
                $("#payment").html('<option value="pay_at_store">Pay at the Store</option>' +
                    '<option value="pay_online">Pay Online</option>');
                $("#adr, #city").prop('disabled', true);
            } else if (pickupOption == 'online_delivery') {
                $("#payment").html('<option value="pay_cash_on_delivery">Cash On Delivery</option>' +
                    '<option value="pay_online">Pay Online</option>');
                $("#adr, #city").prop('disabled', false);
            }
        });

        $('#orderForm').submit(function (e) {
            e.preventDefault();
            var pickup = $('#pickup').val();
            var payment = $('#payment').val();
            var fname = $('#fname').val();
            var email = $('#email').val();
            var adr = $('#adr').val();
            var phone = $('#phone').val();
            var city = $('#city').val();
            var price = '<?= $total_price; ?>';

            if(pickup == "pickup_at_store"){
                adr = "No 37, Rohina Mawatha, Palawatta";
                city = "Battaramulla";
            }

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
                    items: <?= json_encode($data["cartItems"]); ?>
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === "success") {
                        alert("Order placed successfully");
                        window.location.href = "http://localhost/C&A_Indoor_Project/Pages/Cricket_Shop/User";
                    } else if(response.status === "error") {
                        $("#invalid-1").html(response.fname_err);
                        $("#invalid-2").html(response.phone_err);
                        $("#invalid-3").html(response.email_err);
                        $("#invalid-4").html(response.adr_err);
                        $("#invalid-5").html(response.city_err);
                        alert(response.message);
                    } else {
                        console.log(response);
                        obj = response;
                        // Put the payment variables here
                        var payment = {
                            sandbox: true,
                            merchant_id: obj["merchant_id"],
                            return_url:
                                "http://localhost/C&A_Indoor_Project/Pages/Cricket_Shop/User", // Important
                            cancel_url:
                                "http://localhost/C&A_Indoor_Project/Pages/Cricket_Shop/User", // Important
                            notify_url: "http://sample.com/notify",
                            order_id: obj["order_id"],
                            items: obj["items"],
                            amount: obj["amount"],
                            currency: obj["currency"],
                            hash: obj["hash"], // *Replace with generated hash retrieved from backend
                            first_name: obj["first_name"],
                            last_name: obj["last_name"],
                            email: obj["email"],
                            phone: obj["phone"],
                            address: "No 37, Rohina Mawatha, Palawatta",
                            city: "Battaramulla",
                            country: "Sri Lanka",
                            delivery_address: obj["address"],
                            delivery_city: obj["city"],
                            delivery_country: "Sri Lanka",
                            custom_1: "",
                            custom_2: "",
                        };
                        console.log(payment);
                        payhere.startPayment(payment);

                        payhere.onCompleted = function onCompleted(orderId) {
                            console.log("Payment completed. OrderID:" + orderId);

                            var data = {
                                pickup: obj["pickup"],
                                payment: obj["payment"],
                                fname: obj["first_name"],
                                email: obj["email"],
                                adr: obj["address"],
                                phone: obj["phone"],
                                city: obj["city"],
                                price: obj["amount"],
                                items: <?= json_encode($data["cartItems"]); ?>
                            };

                            console.log(data); 

                            $.ajax({
                                type: "POST",
                                url: "<?= URLROOT; ?>/Order/onlinePaidOrder",
                                data: data,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === "success") {
                                        alert("Order placed successfully");
                                        window.location.href = "http://localhost/C&A_Indoor_Project/Pages/Cricket_Shop/User";
                                    } else {
                                        console.log(response);
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error("AJAX request failed:", error);
                                }
                            });
                        };

                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", error);
                }
            });
        });

        $("#email").change(function (e) {
                e.preventDefault();
                var email = $("#email").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Order/getOrderPersonDetails",
                    data: {
                        email: email
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        response = response.orderPersonDetails;
                        $("#fname").val(response.full_name);
                        $("#phone").val(response.mobile_number);
                        $("#adr").val(response.address);
                        $("#city").val(response.city);
                            
                    }
                })
            });
    });
</script>
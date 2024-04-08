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

                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="John M. Doe">

                    <label for="phone">Mobile Number</label>
                    <input type="text" id="phone" name="phone" placeholder="0712345678">

                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com">

                    <label for="adr">Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">

                    <label for="city">City</label>
                    <input type="text" id="city" name="city" placeholder="New York">
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
                        <?php echo (($product_total - $total_price) / $product_total) * 100; ?>%
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var cartCount = '<?= count($data['cartItems']) ?>';
        if (cartCount == 0) {
            cartCount = 0;
        }
        $('#cartCount').html(cartCount);

        $("#pickup").change(function(e) {
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

        $('#orderForm').submit(function(e) {
            e.preventDefault();
            var pickup = $('#pickup').val();
            var payment = $('#payment').val();
            var fname = $('#fname').val();
            var email = $('#email').val();
            var adr = $('#adr').val();
            var phone = $('#phone').val();
            var city = $('#city').val();

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
                    items: <?= json_encode($data["cartItems"]); ?>
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        alert("Order placed successfully");
                        location.reload();
                    } else {
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed:", error);
                }
            });
        });

    });
</script>

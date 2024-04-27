<?php
include APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>

<?php
$discount = 1 - ($data['SProduct']->discount / 100);
?>

<section class="product-details">
    <div class="image-slider">
        <div class="product-images">
            <img src="<?= URLROOT ?>/CricketShop/<?= $data['SProduct']->product_thumbnail; ?>" class="active" alt="">
        </div>
    </div>
    <div class="details">
        <h2 class="product-brand">
            <?= $data['SProduct']->product_title; ?>
        </h2>
        <p class="product-short-des">
            <?= $data['SProduct']->short_description; ?>
        </p>

        <span class="product-actual-price">LKR
            <?= number_format($data['SProduct']->selling_price, 2, '.', ''); ?>
        </span>
        <span class="product-discount">( <?php echo $data['SProduct']->discount; ?>% off )</span>
        <br>
        <span class="product-price">LKR
            <?= number_format($data['SProduct']->selling_price * $discount, 2, '.', ''); ?>
        </span>

        <div class="form-field form-field--increments">
            <label class="form-label form-label--alternate" for="qty[]">Quantity:</label>

            <div class="form-increment" data-quantity-change="">
                <button class="button button--icon" data-action="dec">
                    <span class="is-srOnly">-</span>
                </button>
                <input class="form-input form-input--incrementTotal" id="qty[]" name="qty[]" type="number" value="1"
                    data-quantity-min="0" data-quantity-max="0" min="1" pattern="[0-9]*" aria-live="polite">
                <button class="button button--icon" data-action="inc">
                    <span class="is-srOnly">+</span>
                </button>
            </div>
        </div>

        <button class="btn cart-btn" id="add">add to cart</button>
        <span id="quantity"></span>
    </div>
</section>

<?php
include APPROOT . '/views/Pages/CricketShop/crickFooter.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var cartCount = <?= count($data['cartItems']) ?>;
        if (cartCount === 0) {
            cartCount = 0;
        }
        $('#cartCount').html(cartCount);

        var discount = <?= $discount ?>; // Assigning PHP discount value to JavaScript variable

        $('#add').click(function () {
            var product_id = '<?= $data['SProduct']->product_id; ?>';
            var email = '<?= $_SESSION['user_email']; ?>';
            var product_title = '<?= $data['SProduct']->product_title; ?>';
            var product_price = '<?= $data['SProduct']->selling_price; ?>';
            var product_thumbnail = '<?= $data['SProduct']->product_thumbnail; ?>';
            var qty = parseInt($('#qty\\[\\]').val());
            var flag = 0;
            var cartId = 0;

            console.log('<?= $data['SProduct']->qty; ?>');
            console.log(qty);

            <?php foreach ($data['cartItems'] as $element): ?>
                // Check if the product is already in the cart
                if (product_id == <?= $element->p_id; ?>) {
                    // Increment the quantity
                    qty += parseInt(<?= $element->qty; ?>);
                    cartId = <?= $element->cart_id; ?>;
                    flag = 1;
                }
            <?php endforeach; ?>

            var totalAmount = product_price * qty * discount; 

            if (qty > '<?= $data['SProduct']->qty; ?>') {
                // $('#quantity').html("We don't have enough " + product_title + " stock on hand for the quantity you selected. Please try again.");
                var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">We don\'t have enough ' + product_title + ' stock on hand for the quantity you selected. Please try again.</h3></div><div class="notification_progress"></div></div>');
                $('body').append(notificationDiv);
                // Remove the notification after a certain time (e.g., 5 seconds)
                setTimeout(function() {
                    notificationDiv.remove();
                }, 5000);
            } else {
                $('#quantity').html("");
                if (flag == 0) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= URLROOT; ?>/CricketShop/addToCart',
                        data: {
                            product_id: product_id,
                            email: email,
                            product_title: product_title,
                            product_price: product_price,
                            product_thumbnail: product_thumbnail,
                            qty: qty,
                            totalAmount: totalAmount,
                        },
                        success: function (response) {
                            var jsonData = JSON.parse(response);
                            if (jsonData.status == 'success') {
                                // $('#quantity').html("Item added to cart");
                                var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Item added to cart</h3></div><div class="notification_progress"></div></div>');
                                $('body').append(notificationDiv);
                                // Remove the notification after a certain time (e.g., 5 seconds)
                                setTimeout(function() {
                                    notificationDiv.remove();
                                }, 5000);
                                var updatedCartCount = parseInt(cartCount) + 1;
                                $('#cartCount').html(updatedCartCount);
                            } else {
                                var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Item not added to cart</h3></div><div class="notification_progress"></div></div>');
                                $('body').append(notificationDiv);
                                // Remove the notification after a certain time (e.g., 5 seconds)
                                setTimeout(function() {
                                    notificationDiv.remove();
                                }, 5000);
                                // $('#quantity').html("Item not added to cart");
                            }
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= URLROOT; ?>/CricketShop/updateCart',
                        data: {
                            qty: qty,
                            cart_id: cartId,
                            product_price: product_price * discount,
                            p_id: product_id,
                        },
                        success: function (response) {
                            var jsonData = JSON.parse(response);
                            if (jsonData.status == 'success') {
                                // $('#quantity').html("Item added to cart");
                                var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Item added to cart</h3></div><div class="notification_progress"></div></div>');
                                $('body').append(notificationDiv);
                                // Remove the notification after a certain time (e.g., 5 seconds)
                                setTimeout(function() {
                                    notificationDiv.remove();
                                }, 5000);
                                var updatedCartCount = parseInt(cartCount) + 1;
                                $('#cartCount').html(updatedCartCount);
                                location.reload();
                            } else {
                                // $('#quantity').html("Item not added to cart");
                                var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Item not added to cart</h3></div><div class="notification_progress"></div></div>');
                                $('body').append(notificationDiv);
                                // Remove the notification after a certain time (e.g., 5 seconds)
                                setTimeout(function() {
                                    notificationDiv.remove();
                                }, 5000);
                            }
                        }
                    });
                }
            }
        });

        $("#qty\\[\\]").on('input', function () {
            var qty = parseInt($('#qty\\[\\]').val());
            if(qty < 1){
                $('#qty\\[\\]').val(1);
            }else if(qty == NaN){
                $('#qty\\[\\]').val(1);
            }
        });
    });
</script>
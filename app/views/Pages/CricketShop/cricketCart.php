<?php
include APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>

<!-- <?php print_r($data["cartItems"]); ?> -->

<section class="cart-section">
    <h2>Your Shopping Cart</h2>
    <div class="cart" id="cart">
        <div class="cart-item-heading">
            <div class="column">Image</div>
            <div class="column">Product</div>
            <div class="column">Price</div>
            <div class="column">Quantity</div>
            <div class="column">Total Amount</div>
            <div class="column">Action</div>
        </div>
        <div class="cart-items" id="cartItems">
            <?php $sum = 0; ?>
            <?php foreach ($data["cartItems"] as $cartItem): ?>
                <div class="cart-item">
                    <div class="column item-image"><img width="120px" height="100px"
                            src="<?= URLROOT ?>/CricketShop/<?= $cartItem->p_thumbnail ?>">
                    </div>
                    <div class="column item-name">
                        <?php echo $cartItem->product_title; ?>
                    </div>
                    <div class="column item-price">
                        LKR
                        <?php echo $cartItem->product_price ?>
                    </div>
                    <div class="column item-quantity">
                        <input id="qty<?php echo $cartItem->cart_id; ?>" class="qtyInput" name="qty" type="number" value="<?php echo $cartItem->qty; ?>" 
                        cart_id = "<?php echo $cartItem->cart_id; ?>" price = "<?php echo $cartItem->product_price*0.8 ?>" p_id="<?php echo $cartItem->p_id; ?>"  aria-live="polite">
                    </div>
                    <div class="column item-total">
                        LKR
                        <?php echo $cartItem->total_amount; ?>
                    </div>
                    <div class="column item-action">

                        <button class="remove-btn" cart_id ="<?php echo $cartItem->cart_id; ?>">Remove</button>

                    </div>
                </div>
                <?php $sum += $cartItem->total_amount; ?>
            <?php endforeach; ?>

            <div class="cart-total">
                <span>Total: LKR <span id="totalAmount">
                        <?= $sum ?>
                    </span></span>
            </div>
        </div>

        <div class="checkout">
            <button class="checkout-btn" onclick="window.location.href='<?php echo URLROOT; ?>/Pages/Checkout/user'">Proceed To Checkout</button>
        </div>

    </div>
</section>

<?php
include APPROOT . '/views/Pages/CricketShop/crickFooter.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var cartCount = '<?= count($data['cartItems']) ?>';
        if (cartCount == 0) {
            cartCount = 0;
        }
        $('#cartCount').html(cartCount);
    });
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.qtyInput').forEach(cartItem => {
            cartItem.addEventListener('change', function () {
                var qty = $(this).val();
                if(qty < 1){
                    qty = 1;
                    $(this).val(1);
                }
                var cart_id = $(this).attr('cart_id');
                var product_price = $(this).attr('price')
                var p_id = $(this).attr('p_id');

                $.ajax({
                    url: '<?= URLROOT ?>/CricketShop/updateCart',
                    type: 'POST',
                    data: {
                        qty: qty,
                        cart_id: cart_id,
                        product_price: product_price,
                        p_id: p_id
                    },
                    success: function (response) {
                        response = JSON.parse(response);
                        console.log(response);
                        if (response.status == 'error') {
                            alert(response.message);
                        }else{
                            location.reload();
                        }
                    }
                });
            });
        })

        document.querySelectorAll('.remove-btn').forEach(removeBtn => {
            removeBtn.addEventListener('click', function () {
                var cart_id = $(this).attr('cart_id');
                $.ajax({
                    url: '<?= URLROOT ?>/CricketShop/removeItem',
                    type: 'POST',
                    data: {
                        cart_id: cart_id
                    },
                    success: function (response) {
                        response = JSON.parse(response);
                        console.log(response);
                        if (response.status == 'error') {
                            alert(response.message);
                        }else{
                            alert(response.message);
                            location.reload();
                        }
                    }
                });
            });
        })
    });
</script>
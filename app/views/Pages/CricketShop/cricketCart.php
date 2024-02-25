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
            <?php $sum = 0;?>
            <?php foreach ($data["cartItems"] as $cartItem): ?>
                <div class="cart-item">
                    <div class="column item-image"  ><img width="120px" height="100px" src="<?= URLROOT ?>/CricketShop/<?=$cartItem->p_thumbnail?>">
                    </div>
                    <div class="column item-name">
                        <?php echo $cartItem->product_title; ?>
                    </div>
                    <div class="column item-price">
                        LKR
                        <?php echo $cartItem->product_price ?>
                    </div>
                    <div class="column item-quantity">
                        <?php echo $cartItem->qty; ?>
                    </div>
                    <div class="column item-total">
                        LKR
                        <?php echo $cartItem->total_amount; ?>
                    </div>
                    <div class="column item-action">
                        <button class="btn remove-btn" onclick="removeItem(<?php echo $cartItem->cart_id; ?>)">Remove</button>
                    </div>
                </div>
                <?php $sum += $cartItem->total_amount; ?>
            <?php endforeach; ?>

            <div class="cart-total">
                <span>Total: $<span id="totalAmount"><?=$sum?></span></span>
            </div>
        </div>

        <button class="btn checkout-btn" onclick="checkout()">Proceed to Checkout</button>
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
</script>
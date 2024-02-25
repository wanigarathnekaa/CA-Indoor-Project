<?php
include APPROOT . '/views/Pages/CricketShop/crickHeader.php';
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
        <span class="product-price">LKR
            <?= number_format($data['SProduct']->selling_price * 0.8, 2, '.', ''); ?>
        </span>
        <span class="product-actual-price">LKR
            <?= number_format($data['SProduct']->selling_price, 2, '.', ''); ?>
        </span>
        <span class="product-discount">( 20% off )</span>

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
        var cartCount = '<?= count($data['cartItems']) ?>';
        if (cartCount == 0) {
            cartCount = 0;
        }
        $('#cartCount').html(cartCount);
        $('#add').click(function () {
            var product_id = '<?= $data['SProduct']->product_id; ?>';
            var email = '<?= $_SESSION['user_email']; ?>';
            var product_title = '<?= $data['SProduct']->product_title; ?>';
            var product_price = '<?= $data['SProduct']->selling_price; ?>';
            var product_thumbnail = '<?= $data['SProduct']->product_thumbnail; ?>';
            var qty = $('#qty\\[\\]').val();
            var totalAmount = product_price * qty * 0.8;

            if (qty > '<?= $data['SProduct']->qty; ?>') {
                $('#quantity').html("We don't have enough " + product_title + " stock on hand for the quantity you selected. Please try again.");
            } else {
                $('#quantity').html("");
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
                            $('#quantity').html("Item added to cart");
                            var updatedCartCount = parseInt(cartCount) + 1;
                            $('#cartCount').html(updatedCartCount);
                        } else {
                            $('#quantity').html("Item not added to cart");
                        }
                    }
                });
            }
        });
    });

</script>
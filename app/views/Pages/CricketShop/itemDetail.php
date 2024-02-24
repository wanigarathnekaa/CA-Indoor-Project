<?php
include APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>

<section class="product-details">
    <div class="image-slider">
        <div class="product-images">
            <img src="<?= URLROOT ?>/CricketShop/<?= $data['SProduct']->product_thumbnail;?>" class="active" alt="">
        </div>
    </div>
    <div class="details">
        <h2 class="product-brand"><?= $data['SProduct']->product_title;?></h2>
        <p class="product-short-des"><?= $data['SProduct']->short_description;?></p>
        <span class="product-price">LKR <?= number_format($data['SProduct']->selling_price * 0.8,2,'.', '');?></span>
        <span class="product-actual-price">LKR <?= number_format($data['SProduct']->selling_price, 2, '.', ''); ?></span>
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

        <button class="btn cart-btn">add to cart</button>
    </div>
</section>

<?php
include APPROOT . '/views/Pages/CricketShop/crickFooter.php';
?>
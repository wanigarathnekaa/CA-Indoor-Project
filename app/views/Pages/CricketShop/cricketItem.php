<?php
include APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>
<main>
    <!--PRODUCT-->
    <?php

    // Split the string by '='
    $parts = explode('=', $data['name']);

    // Extract values
    $key = $parts[0]; // key (brand_id)
    $value = $parts[1]; // value (37)
    $title = "";
    if ($key == 'brand_id') {
        foreach ($data['brands'] as $brand) {
            if ($brand->brand_id == $value) {
                $title = $brand->brand_name;
            }
        }
    } else if ($key == 'cat_id') {
        foreach ($data['categories'] as $category) {
            if ($category->category_id == $value) {
                $title = $category->category_name;
            }
        }
    }

    ?>
    <div class="product-container">
        <div class="container">
            <!--SIDEBAR-->
            <div class="sidebar  has-scrollbar" data-mobile-menu>
                <div class="sidebar-category">
                    <div class="sidebar-top">
                        <h2 class="sidebar-title">Category</h2>
                        <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>
                    <ul class="sidebar-menu-category-list">
                        <?php foreach ($data['categories'] as $category): ?>
                            <li class="sidebar-menu-category">
                                <button class="sidebar-accordion-menu" data-accordion-btn>
                                    <div class="menu-title-flex">
                                        <img src="<?php echo URLROOT; ?>/Crick_Images/icons/bat.jpg" alt="clothes"
                                            width="20" height="20" class="menu-title-img">
                                        <p class="menu-title">
                                            <?php echo $category->category_name; ?>
                                        </p>
                                    </div>
                                    <div>
                                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                                    </div>
                                </button>
                                <ul class="sidebar-submenu-category-list" data-accordion>
                                    <?php
                                    foreach ($data['brands'] as $brand) {
                                        if ($brand->brand_category_name == $category->category_id) {
                                            ?>
                                            <li class="sidebar-submenu-category">
                                                <a class="sidebar-submenu-title">
                                                    <p class="product-name">
                                                        <?php echo $brand->brand_name; ?>
                                                    </p>
                                                    <data value="300" class="stock" title="Available Stock">300</data>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>

            <div class="product-box">
                <!--PRODUCT GRID -->
                <div class="product-main">
                    <h2 class="title">
                        <?php echo $title; ?>
                    </h2>
                    <div class="product-grid">

                        <?php foreach ($data['products'] as $product): ?>
                            <?php if ($key == 'brand_id' && $value == $product->brand_id) { ?>
                                <div class="showcase">
                                    <div class="showcase-banner">
                                        <img src="<?php echo URLROOT; ?>/CricketShop/<?php echo $product->product_thumbnail ?>"
                                            alt="bat01" width="300" class="product-img">
                                        <!-- <div class="showcase-actions">
                                            <button class="btn-action">
                                                <ion-icon name="heart-outline"></ion-icon>
                                            </button>
                                            <button class="btn-action">
                                                <ion-icon name="eye-outline"></ion-icon>
                                            </button>
                                            <button class="btn-action">
                                                <ion-icon name="bag-add-outline"></ion-icon>
                                            </button>
                                        </div> -->
                                    </div>
                                    <div class="showcase-content">
                                        <a href="http://localhost/C&A_Indoor_Project/Pages/Item_Detail/<?= $product->product_id;?>" class="showcase-category">
                                            <?php echo $product->product_title; ?>
                                        </a>
                                        <a href="http://localhost/C&A_Indoor_Project/Pages/Item_Detail/<?= $product->product_id;?>">
                                            <h3 class="showcase-title">
                                                <?php echo $product->product_title; ?>
                                            </h3>
                                        </a>
                                        <div class="showcase-rating">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star-outline"></ion-icon>
                                            <ion-icon name="star-outline"></ion-icon>
                                        </div>
                                        <div class="price-box">
                                            <p class="price">
                                                <?php echo $product->selling_price; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($key == 'cat_id' && $value == $product->category_id) { ?>
                                    <div class="showcase">
                                        <div class="showcase-banner">
                                            <img src="<?php echo URLROOT; ?>/CricketShop/<?php echo $product->product_thumbnail ?>"
                                                alt="bat01" width="300" class="product-img">
                                            <!-- <div class="showcase-actions">
                                                <button class="btn-action">
                                                    <ion-icon name="heart-outline"></ion-icon>
                                                </button>
                                                <button class="btn-action">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                </button>
                                                <button class="btn-action">
                                                    <ion-icon name="bag-add-outline"></ion-icon>
                                                </button>
                                            </div> -->
                                        </div>
                                        <div class="showcase-content">
                                            <a href="http://localhost/C&A_Indoor_Project/Pages/Item_Detail/<?= $product->product_id;?>" class="showcase-category">
                                            <?php echo $product->product_title; ?>
                                            </a>
                                            <a href="http://localhost/C&A_Indoor_Project/Pages/Item_Detail/<?= $product->product_id;?>">
                                                <h3 class="showcase-title">
                                                <?php echo $product->product_title; ?>
                                                </h3>
                                            </a>
                                            <div class="showcase-rating">
                                                <ion-icon name="star"></ion-icon>
                                                <ion-icon name="star"></ion-icon>
                                                <ion-icon name="star"></ion-icon>
                                                <ion-icon name="star-outline"></ion-icon>
                                                <ion-icon name="star-outline"></ion-icon>
                                            </div>
                                            <div class="price-box">
                                                <p class="price">
                                                <?php echo $product->selling_price; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
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
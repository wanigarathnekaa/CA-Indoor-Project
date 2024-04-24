<?php
include APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>

<!--MAIN........................................................................................................................................-->

<main>

  <!--BANNER-->
  <div class="banner">
    <div class="container">
      <div class="slider-container has-scrollbar">
        <div class="slider-item">
          <img src="<?php echo URLROOT; ?>/Crick_Images/banner-1.jpg" alt="banner01" class="banner-img">
          <div class="banner-content">
            <!-- <p class="banner-subtitle">Trending item</p> -->
            <!-- <h2 class="banner-title">Women's latest fashion sale</h2> -->
            <p class="banner-text">
              Nobody goes undefeated all the time. If you can pickup after a crushing defeat, and go on to win again,
              you are going to be a champion someday!!!
            </p>
            <!-- <a href="#" class="banner-btn">Shop now</a> -->
          </div>
        </div>
        <div class="slider-item">
          <img src="<?php echo URLROOT; ?>/Crick_Images/banner-2.jpg" alt="modern sunglasses" class="banner-img">
          <div class="banner-content">
            <!-- <p class="banner-subtitle">Trending accessories</p>
              <h2 class="banner-title">Modern sunglasses</h2> -->
            <p class="banner-text">
              starting at &dollar; <b>15</b>.00
            </p>
            <!-- <a href="#" class="banner-btn">Shop now</a> -->
          </div>
        </div>
        <div class="slider-item">
          <img src="<?php echo URLROOT; ?>/Crick_Images/banner-3.jpg" alt="new fashion summer sale" class="banner-img">
          <div class="banner-content">
            <!-- <p class="banner-subtitle">Sale Offer</p> -->
            <!-- <h2 class="banner-title">New fashion summer sale</h2> -->
            <p class="banner-text">
              starting at &dollar; <b>29</b>.99
            </p>
            <!-- <a href="#" class="banner-btn">Shop now</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--PRODUCT-->
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
                    <img src="<?php echo URLROOT; ?>/Crick_Images/icons/bat.jpg" alt="clothes" width="20" height="20"
                      class="menu-title-img">
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
                          <?php
                          $quantity = 0;
                          $brandId = $brand->brand_id;
                          $cat_Id = $category->category_id;
                          foreach ($data['products'] as $product) {
                            if ($product->brand_id == $brandId && $product->category_id == $cat_Id) {
                              $quantity = $product->qty;
                              break;
                            }
                          }
                          ?>
                          <data value="300" class="stock" title="Available Stock"><?=$quantity;?></data>
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
          <h2 class="title">New Products</h2>
          <div class="product-grid">

            <?php foreach (array_reverse($data['products']) as $product): ?>
              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/CricketShop/<?php echo $product->product_thumbnail ?>" alt="bat01"
                    width="300" class="product-img">
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
                      <?php
                      $shortDescription = $product->short_description;
                      echo strlen($shortDescription) > 25 ? substr($shortDescription, 0, 25) . '...' : $shortDescription;
                      ?>
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
            <?php endforeach ?>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <!--SERVICE-->
    <div class="service">
      <h2 class="title">Our Services</h2>
      <div class="service-container">

        <a href="#" class="service-item">
          <div class="service-icon">
            <ion-icon name="boat-outline"></ion-icon>
          </div>
          <div class="service-content">
            <h3 class="service-title">Island wide Delivery</h3>
            <p class="service-desc">For Order Over 10000 LKR</p>
          </div>
        </a>

        <a href="#" class="service-item">
          <div class="service-icon">
            <ion-icon name="rocket-outline"></ion-icon>
          </div>
          <div class="service-content">
            <h3 class="service-title">Next Day delivery</h3>
            <p class="service-desc">Around Colombo</p>
          </div>
        </a>

        <a href="#" class="service-item">
          <div class="service-icon">
            <ion-icon name="call-outline"></ion-icon>
          </div>
          <div class="service-content">
            <h3 class="service-title">Best Online Support</h3>
            <p class="service-desc">Hours: 8AM - 9PM</p>
          </div>
        </a>

        <a href="#" class="service-item">
          <div class="service-icon">
            <ion-icon name="arrow-undo-outline"></ion-icon>
          </div>
          <div class="service-content">
            <h3 class="service-title">Return Policy</h3>
            <p class="service-desc">Easy & Free Return</p>
          </div>
        </a>

        <a href="#" class="service-item">
          <div class="service-icon">
            <ion-icon name="ticket-outline"></ion-icon>
          </div>
          <div class="service-content">
            <h3 class="service-title">30% money back</h3>
            <p class="service-desc">For Order Over 10000 LKR</p>
          </div>
        </a>

      </div>
    </div>
  </div>
  </div>
</main>

<?php
include APPROOT . '/views/Pages/CricketShop/crickFooter.php';
?>
<script>
    $(document).ready(function () {
        var cartCount = '<?= count($data['cartItems']) ?>';
        if (cartCount == 0) {
            cartCount = 0;
        }
        $('#cartCount').html(cartCount);
    });

    $(document).ready(function(){
        $("#searchField").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".showcase-content").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
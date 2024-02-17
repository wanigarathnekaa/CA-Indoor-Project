<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C&A - eCommerce Website</title>

  <!--custom css link-->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style-prefix.css">

</head>

<body>
  <div class="overlay" data-overlay></div>

  <!--MODAL-->


  <!-- <div class="modal" data-modal>
    <div class="modal-close-overlay" data-modal-overlay></div>
    <div class="modal-content">
      <button class="modal-close-btn" data-modal-close> -->
  <!-- <ion-icon name="close-outline"></ion-icon> -->
  <!-- </button> -->
  <!-- <div class="newsletter-img">
        <img src="./assets/images/newsletter.png" alt="subscribe newsletter" width="400" height="400">
      </div> -->

  <!-- <div class="newsletter">

        <form action="#">

          <div class="newsletter-header">

            <h3 class="newsletter-title">Subscribe Newsletter.</h3>

            <p class="newsletter-desc">
              Subscribe the <b>Anon</b> to get latest products and discount update.
            </p>

          </div>

          <input type="email" name="email" class="email-field" placeholder="Email Address" required>

          <button type="submit" class="btn-newsletter">Subscribe</button>

        </form>

      </div> -->

  <!-- </div>

  </div> -->


  <!--NOTIFICATION TOAST-->
  <!-- <div class="notification-toast" data-toast>
    <button class="toast-close-btn" data-toast-close> -->
  <!-- <ion-icon name="close-outline"></ion-icon> -->
  <!-- </button> -->
  <!-- <div class="toast-banner">
      <img src="./assets/images/products/jewellery-1.jpg" alt="Rose Gold Earrings" width="80" height="70">
    </div> -->
  <!-- <div class="toast-detail">
      <p class="toast-message">
        Someone in new just bought
      </p>
      <p class="toast-title">
        Rose Gold Earrings
      </p>
      <p class="toast-meta">
        <time datetime="PT2M">2 Minutes</time> ago
      </p>

    </div> -->

  <!-- </div> -->



  <!--HEADER-->
  <header>
    <div class="header-main">
      <div class="container">
        <a href="#" class="header-logo">
          <img src="<?php echo URLROOT; ?>/Crick_Images/logo/logo.png" alt="Anon's logo" width="120" height="36">
        </a>

        <div class="header-search-container">
          <input type="search" name="search" class="search-field" placeholder="Enter your product name...">
          <button class="search-btn">
            <ion-icon name="search-outline"></ion-icon>
          </button>
        </div>

        <div class="header-user-actions">
          <button class="action-btn" id="personBtn">
            <ion-icon name="person-outline"></ion-icon>
            <div class="dropdown-content">
              <a href="#">Profile</a>
              <a href="#">Your Orders</a>
              <a href="#">Logout</a>
            </div>
          </button>
          <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="count">0</span>
          </button>
          <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count">0</span>
          </button>
        </div>
      </div>
    </div>

    <nav class="desktop-navigation-menu">
      <div class="container">
        <ul class="desktop-menu-category-list">
          <li class="menu-category">
            <a href="./index.html" class="menu-title">Home</a>
          </li>
          <li class="menu-category">
            <a href="#" class="menu-title">Categories</a>
            <div class="dropdown-panel">
              <?php foreach ($data['categories'] as $category): ?>
                <ul class="dropdown-panel-list">
                  <li class="menu-title">
                    <a href="./bats.html">
                      <?php echo $category->category_name; ?>
                    </a>
                  </li>
                  <?php
                  foreach ($data['brands'] as $brand) {
                    if ($brand->brand_category_name == $category->category_id) {
                      ?>
                      <li class="panel-list-item">
                        <a href="./#">
                          <?php echo $brand->brand_name; ?>
                        </a>
                      </li>
                      <?php
                    }
                  }
                  ?>
                </ul>
              <?php endforeach ?>
            </div>
          </li>

          <?php foreach ($data['categories'] as $category): ?>
            <li class="menu-category">
              <a href="#" class="menu-title">
                <?php echo $category->category_name; ?>
              </a>
              <ul class="dropdown-list">
                <?php
                foreach ($data['brands'] as $brand) {
                  if ($brand->brand_category_name == $category->category_id) {
                    ?>
                    <li class="dropdown-item">
                      <a href="#">
                        <?php echo $brand->brand_name; ?>
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
    </nav>

    <!-- responsive menu ........................................................................................................-->
    <div class="mobile-bottom-navigation">
      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>
      <button class="action-btn">
        <ion-icon name="bag-handle-outline"></ion-icon>
        <span class="count">0</span>
      </button>
      <button class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </button>
      <button class="action-btn">
        <ion-icon name="heart-outline"></ion-icon>
        <span class="count">0</span>
      </button>
      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>
    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>

        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">

        <li class="menu-category">
          <a href="#" class="menu-title">Home</a>
        </li>

        <?php foreach ($data['categories'] as $category): ?>
          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">
                <?php echo $category->category_name; ?>
              </p>

              <div>
                <ion-icon name="add-outline" class="add-icon"></ion-icon>
                <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
              </div>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <?php
              foreach ($data['brands'] as $brand) {
                if ($brand->brand_category_name == $category->category_id) {
                  ?>
                  <li class="submenu-category">
                    <a href="#" class="submenu-title">
                      <?php echo $brand->brand_name; ?>
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
    </nav>
  </header>


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
            <img src="<?php echo URLROOT; ?>/Crick_Images/banner-3.jpg" alt="new fashion summer sale"
              class="banner-img">
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
                          <a href="./EnglishWillowBats.html" class="sidebar-submenu-title">
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
            <h2 class="title">New Products</h2>
            <div class="product-grid">

              <?php foreach ($data['products'] as $product): ?>
                <div class="showcase">
                  <div class="showcase-banner">
                    <img src="<?php echo URLROOT; ?>/CricketShop/<?php echo $product->product_thumbnail ?>" alt="bat01"
                      width="300" class="product-img">
                    <div class="showcase-actions">
                      <button class="btn-action">
                        <ion-icon name="heart-outline"></ion-icon>
                      </button>
                      <button class="btn-action">
                        <ion-icon name="eye-outline"></ion-icon>
                      </button>
                      <button class="btn-action">
                        <ion-icon name="bag-add-outline"></ion-icon>
                      </button>
                    </div>
                  </div>
                  <div class="showcase-content">
                    <a href="#" class="showcase-category">
                      <?php echo $product->product_title; ?>
                    </a>
                    <a href="#">
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


  <!--FOOTER-->
  <footer>
    <div class="footer-nav">
      <div class="container">
        <ul class="footer-nav-list">
          <li class="footer-nav-item">
            <h2 class="nav-title">Categories</h2>
          </li>
          <?php foreach ($data['categories'] as $category): ?>
            <li class="footer-nav-item">
              <a href="./bats.html" class="footer-nav-link"><?php echo $category->category_name; ?></a>
            </li>
          <?php endforeach ?>
        </ul>

        <ul class="footer-nav-list">
          <li class="footer-nav-item">
            <h2 class="nav-title">Our Company</h2>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Delivery</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Legal Notice</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Terms and conditions</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">About us</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Secure payment</a>
          </li>
        </ul>

        <ul class="footer-nav-list">
          <li class="footer-nav-item">
            <h2 class="nav-title">Services</h2>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Prices drop</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">New products</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Best sales</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Contact us</a>
          </li>
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Sitemap</a>
          </li>
        </ul>

        <ul class="footer-nav-list">
          <li class="footer-nav-item">
            <h2 class="nav-title">Contact</h2>
          </li>
          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="location-outline"></ion-icon>
            </div>
            <address class="content">
              No 37, Rohina Mawatha, Palawatta, Battramulla, Sri Lanka.
            </address>
          </li>
          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="call-outline"></ion-icon>
            </div>
            <a href="tel:077-072-2933" class="footer-nav-link">077 072 2933</a>
          </li>
          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="mail-outline"></ion-icon>
            </div>
            <a href="mailto:example@gmail.com" class="footer-nav-link">ktpcayodanu@gmail.com</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>

  <!--custom js link-->
  <script src="<?php echo URLROOT; ?>/js/crick_shop.js"></script>

  <!--ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
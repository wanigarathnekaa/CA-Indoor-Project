<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&A - eCommerce Website</title>

    <!--custom css link-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style-prefix.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/cricketitem.css">

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
                    <img src="<?php echo URLROOT; ?>/Crick_Images/logo/logo.png" alt="Anon's logo" width="120"
                        height="36">
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
                        <a href="http://localhost/C&A_Indoor_Project/Pages/Cricket_Shop/manager"
                            class="menu-title">Home</a>
                    </li>
                    <li class="menu-category">
                        <a class="menu-title">Categories</a>
                        <div class="dropdown-panel">
                            <?php foreach ($data['categories'] as $category): ?>
                                <ul class="dropdown-panel-list">
                                    <li class="menu-title">
                                        <a
                                            href="http://localhost/C&A_Indoor_Project/Pages/Cricket_Item/cat_id=<?php echo $category->category_id; ?>">
                                            <?php echo $category->category_name; ?>
                                        </a>
                                    </li>
                                    <?php
                                    foreach ($data['brands'] as $brand) {
                                        if ($brand->brand_category_name == $category->category_id) {
                                            ?>
                                            <li class="panel-list-item">
                                                <a
                                                    href="http://localhost/C&A_Indoor_Project/Pages/Cricket_Item/brand_id=<?php echo $brand->brand_id; ?>">
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
                            <a href="http://localhost/C&A_Indoor_Project/Pages/Cricket_Item/cat_id=<?php echo $category->category_id; ?>"
                                class="menu-title">
                                <?php echo $category->category_name; ?>
                            </a>
                            <ul class="dropdown-list">
                                <?php
                                foreach ($data['brands'] as $brand) {
                                    if ($brand->brand_category_name == $category->category_id) {
                                        ?>
                                        <li class="dropdown-item">
                                            <a
                                                href="http://localhost/C&A_Indoor_Project/Pages/Cricket_Item/brand_id=<?php echo $brand->brand_id; ?>">
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
                    <a href="http://localhost/C&A_Indoor_Project/Pages/Cricket_Shop/manager" class="menu-title">Home</a>
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
                                        <a href="http://localhost/C&A_Indoor_Project/Pages/Cricket_Item/brand_id=<?php echo $brand->brand_id; ?>"
                                            class="submenu-title">
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&A - eCommerce Website</title>

    <!--custom css link-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style-prefix.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/cricketitem.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/ItemDetail.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/cart.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/checkout.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/orders.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

</head>

<body>

    <!-- side bar -->
    <?php
        $role = $_SESSION['user_role'];
        $linkRole = "";
            if($role == "User"){
                $linkRole = "user";
            }
            else if($role == "Coach"){
                $linkRole = "coach";
            }
    ?>

    <div class="overlay" data-overlay></div>



    <!--HEADER-->
    <header>
        <div class="header-main">
            <div class="container">
                <a href="<?php echo URLROOT; ?>/Pages/Dashboard/<?php echo $linkRole?>" class="header-logo">
                    <img src="<?php echo URLROOT; ?>/Crick_Images/logo/logo.png" alt="Anon's logo" width="120"
                        height="36">
                </a>

                <div class="header-search-container">
                    <input type="search" name="search" id="searchField" class="search-field" placeholder="Enter your product name...">
                    <button class="search-btn">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                </div>

                <div class="header-user-actions">
                    <button class="action-btn" id="personBtn"onclick="window.location.href='<?php echo URLROOT; ?>/Pages/Orders/<?php echo $_SESSION['user_email']; ?>'">
                        <ion-icon name="bag-handle"></ion-icon>
                    </button>
                    <button class="action-btn" onclick="window.location.href='<?php echo URLROOT; ?>/Pages/Cricket_Cart/cart'">
                        <!-- <ion-icon name="bag-handle-outline"></ion-icon> -->
                        <ion-icon name='cart'></ion-icon>
                        <span class="count" id="cartCount"></span>
                    </button>
                </div>
            </div>
        </div>

        <nav class="desktop-navigation-menu">
            <div class="container">
                <ul class="desktop-menu-category-list">
                    <li class="menu-category">
                        <a href="<?php echo URLROOT; ?>/Pages/Cricket_Shop/User"
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
            <button class="action-btn" onclick="window.location.href='<?php echo URLROOT; ?>/Pages/Cricket_Shop/User'">
                <ion-icon name='home'></ion-icon>
            </button>
            <button class="action-btn" onclick="window.location.href='<?php echo URLROOT; ?>/Pages/Cricket_Cart/cart'">
                <ion-icon name='cart'></ion-icon>
                <!-- <span class="count">0</span> -->
                <span class="count" id="cartCount"></span>
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
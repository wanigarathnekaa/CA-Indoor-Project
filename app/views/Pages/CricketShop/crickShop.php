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
              <ul class="dropdown-panel-list">
                <li class="menu-title">
                  <a href="./bats.html">Bats</a>
                </li>
                <li class="panel-list-item">
                  <a href="./EnglishWillowBats.html">English Willow Bats</a>
                </li>
                <li class="panel-list-item">
                  <a href="./KashmirWillowBats.html">Kashmir Willow Bats</a>
                </li>
                <li class="panel-list-item">
                  <a href="./JuniorBats.html">Junior Bats</a>
                </li>
              </ul>

              <ul class="dropdown-panel-list">
                <li class="menu-title">
                  <a href="./balls.html">Balls</a>
                </li>
                <li class="panel-list-item">
                  <a href="./Redballs.html">Red Cricket Balls</a>
                </li>
                <li class="panel-list-item">
                  <a href="./whiteballs.html">White Cricket Balls</a>
                </li>
                <li class="panel-list-item">
                  <a href="./practiceballs.html">Practice Balls</a>
                </li>
              </ul>

              <ul class="dropdown-panel-list">
                <li class="menu-title">
                  <a href="./ProtectiveGear.html">Protective Gear</a>
                </li>
                <li class="panel-list-item">
                  <a href="./helmets.html">Helmets</a>
                </li>
                <li class="panel-list-item">
                  <a href="./battingpads.html">Batting Pads</a>
                </li>
                <li class="panel-list-item">
                  <a href="./BattingGloves.html">Batting Gloves</a>
                </li>
                <li class="panel-list-item">
                  <a href="./ThighGuards.html">Thigh Guards</a>
                </li>
                <li class="panel-list-item">
                  <a href="./ChestGuards.html">Chest Guards</a>
                </li>
              </ul>

              <ul class="dropdown-panel-list">
                <li class="menu-title">
                  <a href="./Accessories.html">Accessories</a>
                </li>
                <li class="panel-list-item">
                  <a href="./Bags.html">Bags</a>
                </li>
                <li class="panel-list-item">
                  <a href="./Footwear.html">Footwear</a>
                </li>
                <li class="panel-list-item">
                  <a href="./Clothing.html">Clothing</a>
                </li>
                <li class="panel-list-item">
                  <a href="./Caps.html">Caps</a>
                </li>
            </div>
          </li>

          <li class="menu-category">
            <a href="./bats.html" class="menu-title">Bats</a>
            <ul class="dropdown-list">
              <li class="dropdown-item">
                <a href="./EnglishWillowBats.html">English Willow Bats</a>
              </li>
              <li class="dropdown-item">
                <a href="./KashmirWillowBats.html">Kashmir Willow Bats</a>
              </li>
              <li class="dropdown-item">
                <a href="./JuniorBats.html">Junior Bats</a>
              </li>
            </ul>
          </li>


          <li class="menu-category">
            <a href="./balls.html" class="menu-title">Balls</a>
            <ul class="dropdown-list">
              <li class="dropdown-item">               
                <a href="./Redballs.html">Red Cricket Balls</a>
              </li>
              <li class="dropdown-item">
                <a href="./whiteballs.html">White Cricket Balls</a>
              </li>
              <li class="dropdown-item">
                <a href="./practiceballs.html">Practice Balls</a>
              </li>
            </ul>
          </li>

          <li class="menu-category">
            <a href="./ProtectiveGear.html" class="menu-title">Protective Gear</a>
            <ul class="dropdown-list">
              <li class="dropdown-item">
                <a href="./helmets.html">Helmets</a>
              </li>
              <li class="dropdown-item">
                <a href="./battingpads.html"> Batting Pads</a>
              </li>
              <li class="dropdown-item">
                <a href="./BattingGloves.html">Batting Gloves</a>
              </li>
              <li class="dropdown-item">
                <a href="./ThighGuards.html">Thigh Guards</a>
              </li>
              <li class="dropdown-item">
                <a href="./ChestGuards.html">Chest Guards</a>
              </li>
              <li class="dropdown-item">
                <a href="#">Abdominal Guards</a>
              </li>
            </ul>
          </li>

          <li class="menu-category">
            <a href="./Accessories.html" class="menu-title">Accessories</a>
            <ul class="dropdown-list">
              <li class="dropdown-item">
                <a href="./Bags.html">Bags</a>
              </li>
              <li class="dropdown-item">
                <a href="./Footwear.html">Footwear</a>
              </li>
              <li class="dropdown-item">
                <a href="./Clothing.html">Clothing</a>
              </li>
              <li class="dropdown-item">
                <a href="./Caps.html">Cap</a>
              </li>
            </ul>
          </li>
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

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Bats</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="./EnglishWillowBats.html" class="submenu-title">English Willow Bats</a>
            </li>
             <li class="submenu-category">
              <a href="./KashmirWillowBats.html" class="submenu-title">Kashmir Willow Bats</a>
            </li>
            <li class="submenu-category">
              <a href="./JuniorBats.html" class="submenu-title">Junior Bats</a>
            </li>
          </ul>
        </li>

        <li class="menu-category">
          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Balls</p>
            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>
          <ul class="submenu-category-list" data-accordion>
            <li class="submenu-category">
              <a href="./Redballs.html" class="submenu-title">Red Cricket Balls</a>
            </li>
            <li class="submenu-category">
              <a href="./whiteballs.html" class="submenu-title">White Cricket Balls</a>
            </li>
            <li class="submenu-category">
              <a href="./practiceballs.html" class="submenu-title">Practice Balls</a>
            </li>
          </ul>
        </li>

        <li class="menu-category">
          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Protective gear</p>
            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>
          <ul class="submenu-category-list" data-accordion>
            <li class="submenu-category">
              <a href="./helmets.html" class="submenu-title">Helmets</a>
            </li>
            <li class="submenu-category">
              <a href="./battingpads.html" class="submenu-title">Batting Pads</a>
            </li>
            <li class="submenu-category">
              <a href="./ThighGuards.html" class="submenu-title">Thigh Guards</a>
            </li>
            <li class="submenu-category">
              <a href="./ChestGuards.html" class="submenu-title">Chest Guards</a>
            </li>
            <li class="submenu-category">
              <a href="#" class="submenu-title">Abdominal Guards</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">
          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Accessories</p>
            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>
          <ul class="submenu-category-list" data-accordion>
            <li class="submenu-category">
              <a href="./Bags.html" class="submenu-title">Bag</a>
            </li>
            <li class="submenu-category">
              <a href="./Footwear.html" class="submenu-title">Footwear</a>
            </li>
            <li class="submenu-category">
              <a href="./Clothing.html" class="submenu-title">Clothing</a>
            </li>
            <li class="submenu-category">
              <a href="./Caps.html" class="submenu-title">Cap</a>
            </li>
          </ul>
        </li>
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
                Nobody goes undefeated all the time. If you can pickup after a crushing defeat, and go on to win again, you are going to be a champion someday!!!
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
              <li class="sidebar-menu-category">
                <button class="sidebar-accordion-menu" data-accordion-btn>
                  <div class="menu-title-flex">
                    <img src="<?php echo URLROOT; ?>/Crick_Images/icons/bat.jpg" alt="clothes" width="20" height="20" class="menu-title-img">
                    <p class="menu-title">Bats</p>
                  </div>
                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>
                </button>
                <ul class="sidebar-submenu-category-list" data-accordion>
                  <li class="sidebar-submenu-category">
                    <a href="./EnglishWillowBats.html" class="sidebar-submenu-title">
                      <p class="product-name">English Willow Bats</p>
                      <data value="300" class="stock" title="Available Stock">300</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./KashmirWillowBats.html" class="sidebar-submenu-title">
                      <p class="product-name">Kashmir Willow Bats</p>
                      <data value="60" class="stock" title="Available Stock">60</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./JuniorBats.html" class="sidebar-submenu-title">
                      <p class="product-name">Junior Bats</p>
                      <data value="50" class="stock" title="Available Stock">50</data>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="sidebar-menu-category">
                <button class="sidebar-accordion-menu" data-accordion-btn>
                  <div class="menu-title-flex">
                    <img src="<?php echo URLROOT; ?>/Crick_Images/icons/ball.png" alt="footwear" class="menu-title-img" width="20"
                      height="20">
                    <p class="menu-title">Balls</p>
                  </div>
                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>
                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>
                  <li class="sidebar-submenu-category">
                    <a href="./Redballs.html" class="sidebar-submenu-title">
                      <p class="product-name">Red Cricket Balls</p>
                      <data value="45" class="stock" title="Available Stock">45</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./whiteballs.html" class="sidebar-submenu-title">
                      <p class="product-name">White Cricket Balls</p>
                      <data value="75" class="stock" title="Available Stock">75</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./practiceballs.html" class="sidebar-submenu-title">
                      <p class="product-name">Practice Balls</p>
                      <data value="35" class="stock" title="Available Stock">35</data>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="sidebar-menu-category">
                <button class="sidebar-accordion-menu" data-accordion-btn>
                  <div class="menu-title-flex">
                    <img src="<?php echo URLROOT; ?>/Crick_Images/icons/ProtectiveGear.png" alt="clothes" class="menu-title-img" width="20"
                      height="20">
                    <p class="menu-title">Protective Gear</p>
                  </div>
                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>
                </button>
                <ul class="sidebar-submenu-category-list" data-accordion>
                  <li class="sidebar-submenu-category">
                    <a href="./helmets.html" class="sidebar-submenu-title">
                      <p class="product-name">Helmets</p>
                      <data value="46" class="stock" title="Available Stock">46</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./battingpads.html" class="sidebar-submenu-title">
                      <p class="product-name">Batting Pads</p>
                      <data value="73" class="stock" title="Available Stock">73</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./BattingGloves.html" class="sidebar-submenu-title">
                      <p class="product-name">Batting Gloves</p>
                      <data value="61" class="stock" title="Available Stock">61</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./ThighGuards.html" class="sidebar-submenu-title">
                      <p class="product-name">Thigh Guards</p>
                      <data value="49" class="stock" title="Available Stock">49</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./ChestGuards.html" class="sidebar-submenu-title">
                      <p class="product-name">Chest Guards</p>
                      <data value="70" class="stock" title="Available Stock">70</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Abdominal Guards</p>
                      <data value="55" class="stock" title="Available Stock">55</data>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="sidebar-menu-category">
                <button class="sidebar-accordion-menu" data-accordion-btn>
                  <div class="menu-title-flex">
                    <img src="<?php echo URLROOT; ?>/Crick_Images/icons/Accessories.jpg" alt="perfume" class="menu-title-img" width="20" height="20">
                    <p class="menu-title">Accessories</p>
                  </div>
                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>
                </button>
                <ul class="sidebar-submenu-category-list" data-accordion>
                  <li class="sidebar-submenu-category">
                    <a href="./Bags.html" class="sidebar-submenu-title">
                      <p class="product-name">Bag</p>
                      <data value="12" class="stock" title="Available Stock">12 pcs</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./Footwear.html" class="sidebar-submenu-title">
                      <p class="product-name">Footwear</p>
                      <data value="60" class="stock" title="Available Stock">60 pcs</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./Clothing.html" class="sidebar-submenu-title">
                      <p class="product-name">Clothing</p>
                      <data value="50" class="stock" title="Available Stock">50 pcs</data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="./Caps.html" class="sidebar-submenu-title">
                      <p class="product-name">Cap</p>
                      <data value="87" class="stock" title="Available Stock">87 pcs</data>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="product-box">
          <!--PRODUCT GRID -->
          <div class="product-main">
            <h2 class="title">New Products</h2>
            <div class="product-grid">

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Bats/bat01.jpg" alt="bat01" width="300" class="product-img">
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
                  <a href="./EnglishWillowBats.html" class="showcase-category">English Willow Bat</a>
                  <a href="#">
                    <h3 class="showcase-title">SS English Willow Bat</h3>
                  </a>
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>
                  <div class="price-box">
                    <p class="price">23000 LKR</p>
                  </div>
                </div>
              </div>

              <div class="showcase">             
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Balls/rball01.jpg" alt="rball01" class="product-img" width="300">
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
                  <a href="./Redballs.html" class="showcase-category">Red Cricket Balls</a>
                  <h3>
                    <a href="#" class="showcase-title">Red  Leather Cricket Ball - 4 3/4 Oz</a>
                  </h3>
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>
                  <div class="price-box">
                    <p class="price">2250 LKR</p>
                  </div>
                </div>             
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Balls/wball2.jpg" alt="wball2" class="product-img" width="300">
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
                  <a href="./whiteballs.html" class="showcase-category">White Cricket Balls</a>             
                  <h3>
                    <a href="#" class="showcase-title">White Leather Cricket Ball - 156g(5 1/2 Oz)</a>
                  </h3>              
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>
                  <div class="price-box">
                    <p class="price">2350 LKR</p>
                  </div>
                </div>
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Bats/kbat04.jpg" alt="kbat04" class="product-img" width="300">
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
                  <a href="./KashmirWillowBats.html" class="showcase-category">Kashmir Willow Bat</a>             
                  <h3>
                    <a href="#" class="showcase-title">IBIS 77 Kashmir Willow Bat</a>
                  </h3>             
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>              
                  <div class="price-box">
                    <p class="price">18000 LKR</p>
                  </div>             
                </div>             
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/protectiveGear/helmet1.jpg" alt="helmet1" class="product-img" width="300">
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
                  <a href="./helmets.html" class="showcase-category">Helmets </a>            
                  <h3>
                    <a href="#" class="showcase-title">Masuri C-line Plus Senior Helmet (Size-M)</a>
                  </h3>            
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>           
                  <div class="price-box">
                    <p class="price">44500 LKR</p>
                  </div>     
                </div>             
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/protectiveGear/battingpad1.jpeg" alt="battingpad1" class="product-img" width="300">
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
                  <a href="./battingpads.html" class="showcase-category">Batting Pads</a>             
                  <h3>
                    <a href="#" class="showcase-title">Speed Blade Batting Pads</a>
                  </h3>              
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>             
                  <div class="price-box">
                    <p class="price">14960 LKR</p>
                  </div> 
                </div>       
              </div>

              <div class="showcase"> 
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Balls/pball1.jpg" alt="pball1" class="product-img" width="300">
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
                  <a href="./practiceballs.html" class="showcase-category">Practice Balls</a>             
                  <h3>
                    <a href="#" class="showcase-title">Atlas Ptactice Ball</a>
                  </h3>             
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>
                  <div class="price-box">
                    <p class="price">100 LKR</p>
                  </div>             
                </div>             
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/protectiveGear/battinggloves2.jpg" alt="battinggloves2" class="product-img" width="300">
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
                  <a href="./BattingGloves.html" class="showcase-category">Batting Gloves</a>             
                  <h3>
                    <a href="#" class="showcase-title">DSC Intense Attitude Leather Cricket Batting Gloves</a>
                  </h3>             
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>             
                  <div class="price-box">
                    <p class="price">8600 LKR</p>
                  </div>              
                </div>             
              </div>

              <div class="showcase">             
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Accesseries/footware2.jpg" alt="footware2" class="product-img" width="300">
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
                  <a href="./Footwear.html" class="showcase-category">Footware</a>            
                  <h3>
                    <a href="#" class="showcase-title">Kookaburra KC Players Spike Cricket Shoe</a>
                  </h3>          
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>              
                  <div class="price-box">
                    <p class="price">17000 LKR</p>
                  </div>              
                </div>
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Accesseries/shirt1.jpg" alt="shirt1" class="product-img" width="300">
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
                  <a href="./Clothing.html" class="showcase-category">Clothing</a>
                  <h3>
                    <a href="#" class="showcase-title">TYKA Median Cricket Shirts</a>
                  </h3>   
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>              
                  <div class="price-box">
                    <p class="price">3000 LKR</p>
                  </div>
                </div>
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/Accesseries/bag1.jpg" alt="bag1" class="product-img" width="300">
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
                  <a href="./Bags.html" class="showcase-category">Bags</a>
                  <h3>
                    <a href="#" class="showcase-title">Wheel Bags</a>
                  </h3>             
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>             
                  <div class="price-box">
                    <p class="price">17000 LKR</p>
                  </div>
                </div>
              </div>

              <div class="showcase">
                <div class="showcase-banner">
                  <img src="<?php echo URLROOT; ?>/Crick_Images/products/protectiveGear/thighpad1.jpeg" alt="thighpad1"  class="product-img" width="300">
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
                  <a href="./ThighGuards.html" class="showcase-category">Thigh Guards</a>
                  <h3>
                    <a href="#" class="showcase-title">ED Sports Ultimate Cricket Thigh Pads</a>
                  </h3>
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>
                  <div class="price-box">
                    <p class="price">10000 LKR</p>
                  </div>
                </div>
              </div>

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
          <li class="footer-nav-item">
            <a href="./bats.html" class="footer-nav-link">Bats</a>
          </li>
          <li class="footer-nav-item">
            <a href="./balls.html" class="footer-nav-link">Balls</a>
          </li>
          <li class="footer-nav-item">
            <a href="./ProtectiveGear.html" class="footer-nav-link">Protective Gear</a>
          </li>
          <li class="footer-nav-item">
            <a href="./Accessories.html" class="footer-nav-link">Accessories</a>
          </li>
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
            <a href="tel:+607936-8058" class="footer-nav-link">077 072 2933</a>
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
<script src="./assets/js/script.js"></script>

<!--ionicon link-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
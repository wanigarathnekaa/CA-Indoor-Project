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
              <a href="" class="footer-nav-link"><?php echo $category->category_name; ?></a>
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="<?php echo URLROOT; ?>/js/crick_shop.js"></script>
  <script src="<?php echo URLROOT; ?>/js/ItemDetail.js"></script>
  <script src="<?php echo URLROOT; ?>/js/cart.js"></script>

  <!--ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
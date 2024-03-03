<?php
include APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>

<div class="row">
      <div class="col-75">
            <div class="detailscontainer">
                  <form action="/action_page.php">
                        <div class="col-50">
                              <h2 class="topic">Delivery Details</h2>

                              <div class="col-md-6">
                                    <!-- Pickup mode -->
                                    <div class="form-group">
                                          <label for="pickup">Pickup Mode</label>
                                          <select id="pickup" name="pickup">
                                                <option value="pickup_at_store">Pickup at the Store</option>
                                                <option value="online_delivery">Online Delivery</option>
                                          </select>
                                    </div>

                                    <!-- Payment method -->
                                    <div class="form-group">
                                          <label for="payment">Payment Method</label>
                                          <select id="payment" name="payment">
                                                <option value="pay_online">Online Payment</option>
                                                <option value="pay_cash_on_delivery">Cash On Delivery</option>
                                                <option value="pay_at_store">Pay at the Store</option>
                                          </select>
                                    </div>
                              </div>

                              <label for="fname">Full Name</label>
                              <input type="text" id="fname" name="firstname" placeholder="John M. Doe">

                              <label for="phone">Mobile Number</label>
                              <input type="text" id="phone" name="phone" placeholder="0712345678">

                              <label for="email">Email</label>
                              <input type="text" id="email" name="email" placeholder="john@example.com">

                              <label for="adr">Address</label>
                              <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">

                              <label for="city">City</label>
                              <input type="text" id="city" name="city" placeholder="New York">
                        </div>
                        <div class="check">
                              <input type="submit" value="Continue to checkout" class="btn">
                        </div>
                  </form>
            </div>
      </div>

      <div class="col-25">
            <div class="prizecontainer">
                  <h2 class="topic">Bill</h2>
                  <p>Items <span class="price">4</span></p>
                  <p>Delivery <span class="price">Free</span></p>
                  <p>Total price <span class="price">$30</span></p>
                  <p>Discount <span class="price">0</span></p>
                  <p>Discount Code <span class="price">0</span></p>
                  <hr>
                  <p class="tot">Total Bill <span class="price"><b>$30</b></span></p>
            </div>
      </div>
</div>

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
</script>
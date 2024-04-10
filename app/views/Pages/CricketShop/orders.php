<?php
include_once APPROOT . '/views/Pages/CricketShop/crickHeader.php';
?>

<div class="order-container">
      <h1>Your Order Details</h1>
      <div class="orders" id="orders">
            <div class="order-item-heading">
                  <div class="column">Order Id</div>
                  <div class="column">Order Date</div>
                  <div class="column">Order Status</div>
                  <div class="column">Payment Method</div>
                  <div class="column">Pickup Method</div>
            </div>

            <div class="order-items" id="orderItems">
                  <?php foreach ($data["orders"] as $order): ?>
                        <div class="order-item">
                              <div class="column order-id">
                                    <?php echo $order->order_id; ?>
                              </div>
                              <div class="column order-date">
                                    <?php echo $order->order_date; ?>
                              </div>
                              <div class="column order-status">
                                    <?php echo $order->order_status; ?>
                              </div>
                              <div class="column order-payment">
                                    <?php echo str_replace('_',' ',$order->payment_method); ?>
                              </div>
                              <div class="column order-pickup">
                                    <?php echo str_replace('_',' ',$order->pickup_mode); ?>
                              </div>
                        </div>
                  <?php endforeach; ?>
            </div>
      </div>
</div>


<?php
include_once APPROOT . '/views/Pages/CricketShop/crickFooter.php';
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
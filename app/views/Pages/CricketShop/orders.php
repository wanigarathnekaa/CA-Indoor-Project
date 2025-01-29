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



<!-- OrderDetails popup -->
<div id="orderDetailsModal" class="modal">
      <div class="modal-content">
            <div class="title">
                  <h2 class="modal-title">Order Details</h2>
                  <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <hr>

            <div class="orderItems">
                  <table id="orderItemsTable">
                        <thead>
                              <tr>
                                    <th>Product</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                              </tr>
                        </thead>
                        <tbody id="items">
                              <!-- Order Items will be displayed here -->
                        </tbody>
                  </table>
            </div>
            <hr>
            
      </div>
</div>


<?php
include_once APPROOT . '/views/Pages/CricketShop/crickFooter.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="<?php echo URLROOT; ?>/js/orders.js"></script>
<script>
    $(document).ready(function () {
        var cartCount = '<?= count($data['cartItems']) ?>';
        if (cartCount == 0) {
            cartCount = 0;
        }
        $('#cartCount').html(cartCount);
    });


      $(document).ready(function () {
            $('#orders #orderItems .order-item').click(function () {
                  $(this).addClass('selected').siblings().removeClass('selected');
                  console.log($(this).find('.order-id').text());
                  $('#orderDetailsModal').css('display', 'block');
                  $.ajax({
                        url : "<?php echo URLROOT; ?>/Order/getOrderDetails",
                        type : 'POST',
                        data : {
                              order_id : $(this).find('.order-id').text()
                        },
                        success : function (response) {
                              console.log(response);
                              var orderItems = response.orderItems;
                              var products =response.products;
                              

                              var itemsTable = $('#orderItemsTable tbody');
                              itemsTable.empty();

                              for (var i = 0; i < orderItems.length; i++) {
                                    var item = orderItems[i];
                                    var product = products[i];
                                    var row = '<tr>';
                                    row += '<td><img width="120px" height="100px" src="<?= URLROOT ?>/CricketShop/'+ product.product_thumbnail +'">'+'</td>';                                 
                                    row += '<td>' + product.product_title + '</td>';
                                    row += '<td>' + item.quantity + '</td>';
                                    row += '<td>' + item.price_per_unit + '</td>';
                                    row += '</tr>';
                                    $('#items').append(row);
                              }
                              // $("#items").html(itemsText);
                        }
                  });
            });
      });
</script>
<!DOCTYPE html>
<html>
<head>
  <title>Terms and Condition</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/termsCondition.css">
</head>
<body>

<div class="wrapper flex_align_justify">
   <div class ="tc_wrap">
       <div class="tabs_list">
         <ul>
           <li data-tc="tab_item_1" class="active">Reservations</li>
           <li data-tc="tab_item_2">Payment </li>
           <li data-tc="tab_item_3">Cricket Shop </li>  
         </ul>
       </div>

       <div class="tabs_content">
          <div class="tab_head">
            <h2>Terms & Conditions</h2>
          </div>

          <div class="tab_body">
            <div class="tab_item tab_item_1">
                <h3>Reservations</h3>
                <h4>Customer</h4>


                <p>Customers cannot cancel a reservation within the last two days before the time slot. and the customer cannot reschedule the reservation for another available time slot within the last two days before the time slot. In case of a cancellation, confirmation payment will NOT be refunded. If the customer has done full payment, confirmation payment got redacted and the remaining amount will be refunded.</p> 
                  
                <p>A confirmation payment must be made online at that time to make the reservation. Alternatively, you can confirm your reservation by making the physical payment on-site.</p>
                  
                <p>When refunding, it will charge 5% of the refunded amount as the transaction cost.</p>
                  
                  
                <h4>C&A Indoor Cricket Net</h4>
                  
                <p> In less than two weeks, reservations can be made by any customer.</p>
                  
                <p>The company cannot cancel or reschedule a reservation after being confirmed.</p>
                  
                <p>The company can reserve free available time slots and the company is responsible for collecting the physical payment and updating the system.</p>
                  
                <p>Only a limited number of reservations are allowed for a single day.</p>
                  
        
                <input type="checkbox" id="checkbox" name="vehicle1" value="Bike" required>
                <label for="agree1"> I agree for above conditions</label>
                
                <div class="tab_foot flex_align_justify">
                  <button class="agree1" >Next</button>
                </div> 
                      <!-- <script>
                        function checkAgreement() {
                          var checkbox = document.getElementById('checkbox');
                          
                          if (checkbox.checked) {
                            // Checkbox is checked, proceed to the next step or action
                            alert('Agreement accepted. Moving to the next step.');
                            // Add your logic here to perform the next action
                          } else {
                            // Checkbox is not checked, display an error message or take appropriate action
                            alert('Please agree to the conditions before proceeding.');
                          }
                        }
                      </script> -->
            </div>

            <div class="tab_item tab_item_2" style="display: none;">
                <h3>Payment</h3>
                <h4>Customer</h4>

                <p>The minimum payment amount selected by the business's owner is the amount of the confirmation payment. The reservation must be confirmed by that payment. Otherwise in order to confirm the reservation customer can make the full payment at once.</p>
                <p>If a customer wishes to cancel a time slot, he or she should cancel the reservation any day prior to two days before the reserved time slot in order to receive the complete payment.</p>
                <p>If a customer fails to do so, then the confirmation payment will be charged and the remaining amount will be refunded.</p>
                <p>When refunding, it will charge 5% of the refunded amount as the transaction cost.</p>
                <p>If the reservation cancellation happens from the Company side, the complete payment(Confirmation payment or Full payment) will be transferred back.</p>
                <p>Customers must pay the full payment at the end of the booking before leaving the premises.</p>

                <h4>Company</h4>
                <P>The Company can collect a minimum amount chosen by the owner as the confirmation payment to reserve the time slot and collect full payment at the end of the reservation. </P>
                <P>The Payment process will be handled only by the manager and the owner. </P>
                <P>The manager and the owner are responsible for refunding process.</P>

                <input type="checkbox" id="checkbox" name="vehicle1" value="Bike" required>
                <label for="vehicle1"> I agree for above conditions</label>

                  <div class="tab_foot flex_align_justify">
                    <div class="button-container">
                      <button class="agree2">Back</button>
                      <button class="agree3">Next</button>
                    </div>
                  </div> 
            </div>

            <div class="tab_item tab_item_3"  style="display: none;">
              <h3> Cricket Shop </h3>
              
              <h4>Company</h4>

              <p>The company utilizes reputable courier services to deliver your purchased cricket equipment to the specified shipping address.</p>
              <p>Delivery times may vary based on location, availability, and external factors. We aim to provide accurate delivery estimates during the checkout process.</p>
              <p>Once your order is dispatched, we will provide a tracking number that allows you to monitor the delivery progress. You can track your order through the provided courier service's website.</p>
              <p>The Company shall not be held responsible for delays or failures in delivery due to circumstances beyond the company's control, including natural disasrs, strikes, or other unforeseen events.</p>
              <p>Can contact the manager for the more information.</p>

              <h4>Customer</h4>
              <p>Customers should make the full payment(including delivery charges) in order to purchase the cricket items. Otherwise, you must go to the cricket shop physically.</p>
              <p>Select the delivery method.</p>
              <p>Pick up at the indoor cricket shop premises. (No delivery charges.)</p>
              <p>Courier.</p>
              <p>Customers are responsible for providing accurate and complete shipping information during the checkout process. Any errors or omissions may result in delays or unsuccessful deliveries.</p>
              <p>Failed delivery attempts due to Customer unavailability may result in additional delivery charges.</p>
              <p>Upon receiving the delivery, the Customer is responsible for inspecting the package for any visible damage or discrepancies. If there are any issues with the delivered items, the Customer should contact the manager within 2 days.</p>
              <p>If a delivery attempt is missed, the Customer may be required to re-schedule delivery with the courier service directly.</p>

              <input type="checkbox" id="checkbox" name="vehicle1" value="Bike" required>
              <label for="agree5"> I agree for above conditions</label>

              <div class="tab_foot flex_align_justify">
                <div class="button-container">
                  <button class="agree4">Back</button>
                  <button class="agree5">Agree</button>
                </div>
              </div> 
            </div>
           
          <!-- <div >
        
            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
            <label for="vehicle1"> I agree for above conditions</label>
            </div>
            <div>
          <div class="tab_foot flex_align_justify">
            <button class="agree">
              Next
            </button>
          </div> -->
       </div>
   </div>
</div>


<!-- javascript -->
<script src="<?php echo URLROOT; ?>/js/termsCondition.js"></script>

</body>
</html>
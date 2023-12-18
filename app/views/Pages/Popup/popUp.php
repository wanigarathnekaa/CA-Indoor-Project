<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Popup message</title>
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/PopupStyle.css">

</head>
<body>
      <div class="container">
            <button type="submit" class="btn" onclick="openPopup()">Submit</button>

            <div class="popup" id="popup">
            <img src="<?php echo URLROOT; ?>/images/tick.png" alt="tick">
                  <h2>Confirmation is successful!</h2>
                  <p>Your Confirmation has been recorded Successfully.</p>
                  <button type="button" onclick="closePopup()">OK</button> 
            </div>
      </div>
      
      <script  src="<?php echo URLROOT; ?>/js/PopupScript.js"></script>
      
</body>
</html>
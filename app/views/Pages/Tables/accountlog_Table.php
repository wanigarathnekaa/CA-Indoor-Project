<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width = device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coachsessions.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
      <title>Personal_Reservations</title>
</head>

<body>
      <div class="maindiv">
            <h2>Users Account Logs</h2>
            <div class="recentSessions">
                  <div class="session-item-heading">
                        <div class="column">Name</div>
                        <div class="column">Email</div>
                        <div class="column">Creation Date</div>
                        <div class="column">Last-login</div>
                        <div class="column">Last-logout</div>
                  </div>
                  
                <div class="session-items">
                
                <?php foreach ($data['logs'] as $log): ?>
                  <div class="session-item" onclick="openPopupCoachSession(<?php echo htmlspecialchars(json_encode($log)); ?>)">
                  <div class="column"><?php echo $log->user_name; ?></div>
                  <div class="column"><?php echo $log->email; ?></div>
                  <div class="column"><?php echo $log->create_date; ?></div>
                  <div class="column"><?php echo $log->last_login; ?></div>
                  <div class="column"><?php echo $log->last_logout; ?></div>
                 </div>
                <?php endforeach; ?>

                </div>
            </div>
      </div>

      <!-- Popup -->
      <div class="popupcontainer3" id="popupcontainer3">
            <div class="coachpopup" id="coachpopup">
                  <span class="close" onclick="closePopupCoachSession()">&times;</span>
                  <h2>Account Details</h2>
                  <hr>
                  <div class="popupdetails">
                        <div class="popupdetail">
                              <h2><b>Date : </b><span class="c_date"></span></h2>
                        </div>
                        <div class="popupdetail">
                              <h2><b>Time : </b><span class="c_time"></span></h2>
                        </div>
                        <div class="popupdetail">
                              <h2><b>Customer : </b><span class="c_customer"></span></h2>
                        </div>
                        <div class="popupdetail">
                              <h2><b>Customer Email : </b><span class="c_email"></span></h2>
                        </div>
                        <div class="popupdetail">
                              <h2><b>Customer PhoneNumber: </b><span class="c_phone"></span></h2>
                        </div>
                        <div class="popupdetail">
                              <h2><b>Net Type : </b><span class="c_net"></span></h2>
                        </div>
                  </div>
            </div>
      </div>

      <script src="<?php echo URLROOT; ?>/js/coachsession.js"></script>
</body>
</html>


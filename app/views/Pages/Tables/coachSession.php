<?php
$filter_date = date('Y-m-d');
$coach = $_SESSION['user_name'];

$coach_sessions = array_filter($data['bookings'], function ($item) use ($coach, $filter_date) {
      // Assuming $item->reservation_date contains the reservation date
      $reservation_date = date('Y-m-d', strtotime($item->date));

      return $item->coach === $coach && $reservation_date >= $filter_date;
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width = device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coachsessions.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
      <title>Personal_Reservations</title>
</head>

<body>
      <div class="maindiv">
            <h2>Coach Sessions</h2>
            <div class="recentSessions">
                  <div class="session-item-heading">
                        <div class="column">Date</div>
                        <div class="column">Time</div>
                        <div class="column">Customer</div>
                        <div class="column">Net Type</div>
                  </div>
                  
                  <div class="session-items">
                        <?php foreach ($coach_sessions as $session): ?>
                              <div class="session-item">
                                    <div class="column">
                                          <?php echo $session->date; ?>
                                    </div>
                                    <div class="column">
                                          <?php echo $session->timeSlot; ?>
                                    </div>
                                    <div class="column">
                                          <?php echo $session->name; ?>
                                    </div>
                                    <div class="column">
                                          <?php echo $session->netType; ?>
                                    </div>
                              </div>
                        <?php endforeach; ?>
                  </div>
            </div>
      </div>
</body>
</html>
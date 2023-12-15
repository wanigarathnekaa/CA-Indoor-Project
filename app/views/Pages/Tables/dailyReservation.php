<?php
$filter_date = date('Y-m-d');
$new_data = array_filter($data, function ($data) use ($filter_date) {
      return $data->date === $filter_date;
});
?>

<html>

<head>
      <meta name="viewport" content="width = device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dailyReservation_Table_Style.css">
</head>

<body>
      <div class="recentOrders">
            <div class="cardHeader">
                  <!-- date -->
                  <h2><?php echo date('Y-m-d');?></h2>
                  <!-- veiw all button -->
                  <a href="#" class="btn">View All</a>
            </div>

            <div class="table-container">
                  <table>
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <td>Customer</td>
                                    <td>Time Slot</td>
                                    <td>Net</td>
                                    <td>Status</td>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php
                              foreach ($new_data as $reservation) {
                                    ?>
                                    <tr>
                                          <td>
                                                <?php echo $reservation->name; ?>
                                          </td>
                                          <td><?php echo $reservation->timeSlot; ?></td>
                                          <td><?php echo $reservation->net; ?></td>
                                          <td><span class="status paid">Paid</span></td>
                                    </tr>
                                    <?php
                              }
                              ?>
                              <!-- <tr>
                                    <td>Milan Bhanuka</td>
                                    <td>07AM-09AM</td>
                                    <td>A</td>
                                    <td><span class="status paid">Paid</span></td>
                              </tr>

                              <tr>
                                    <td>Kaveesha Wanigarathne</td>
                                    <td>10AM-12PM</td>
                                    <td>Machine</td>
                                    <td><span class="status confirmation">confirmation fee</span></td>
                              </tr>

                              <tr>
                                    <td>Hasini Hewa</td>
                                    <td>02PM-04PM</td>
                                    <td>Paid</td>
                                    <td><span class="status canceled">Canceled</span></td>
                              </tr>

                              <tr>
                                    <td>Milan Bhanuka</td>
                                    <td>07AM-09AM</td>
                                    <td>A</td>
                                    <td><span class="status paid">Paid</span></td>
                              </tr>

                              <tr>
                                    <td>Kaveesha Wanigarathne</td>
                                    <td>10AM-12PM</td>
                                    <td>Machine</td>
                                    <td><span class="status confirmation">confirmation fee</span></td>
                              </tr>

                              <tr>
                                    <td>Hasini Hewa</td>
                                    <td>02PM-04PM</td>
                                    <td>Paid</td>
                                    <td><span class="status canceled">Canceled</span></td>
                              </tr>

                              <tr>
                                    <td>Milan Bhanuka</td>
                                    <td>07AM-09AM</td>
                                    <td>A</td>
                                    <td><span class="status paid">Paid</span></td>
                              </tr>

                              <tr>
                                    <td>Kaveesha Wanigarathne</td>
                                    <td>10AM-12PM</td>
                                    <td>Machine</td>
                                    <td><span class="status confirmation">confirmation fee</span></td>
                              </tr>

                              <tr>
                                    <td>Hasini Hewa</td>
                                    <td>02PM-04PM</td>
                                    <td>Paid</td>
                                    <td><span class="status canceled">Canceled</span></td>
                              </tr>
                              <tr>
                                    <td>Milan Bhanuka</td>
                                    <td>07AM-09AM</td>
                                    <td>A</td>
                                    <td><span class="status paid">Paid</span></td>
                              </tr>

                              <tr>
                                    <td>Kaveesha Wanigarathne</td>
                                    <td>10AM-12PM</td>
                                    <td>Machine</td>
                                    <td><span class="status confirmation">confirmation fee</span></td>
                              </tr>

                              <tr>
                                    <td>Hasini Hewa</td>
                                    <td>02PM-04PM</td>
                                    <td>Paid</td>
                                    <td><span class="status canceled">Canceled</span></td>
                              </tr> -->

                        </tbody>
                  </table>
            </div>
      </div>
</body>
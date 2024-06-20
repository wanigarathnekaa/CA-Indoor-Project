<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- css -->
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Player_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
      <title>Players</title>
</head>

<body>
      <!-- Sidebar -->
      <?php
      $role = $_SESSION['user_role'];
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';

      ?>

      <?php
      // Extract emails from the coaches
      $emailsArray1 = array_map(function ($item) {
            return $item->email;
      }, $data1['Coaches']);

      // Filter the Players from users table
      $players = array_filter($data, function ($item) use ($emailsArray1) {
            return !in_array($item->email, $emailsArray1);
      });

      ?>


      <!-- Content -->
      <section class="home">

            <!-- Table Topic -->
            <div class="table-topic">
                  <div class="topic-name">
                        <h1>Players :
                              <?php echo count($players) ?>
                        </h1>
                  </div>
            </div>



            <!-- Table Sort -->
            <div class="tableSort">
                  <div class="search">
                        <label>
                              <input type="text" placeholder="Search here" id="searchInput" >
                              <i class="fa-solid fa-magnifying-glass icon"></i>
                        </label>
                  </div>
            </div>



            <!-- Table -->
            <div class="table-container">
                  <table id="playerTable">
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <th>Player ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Player Status</th>
                                    <?php if($role == 'Admin' || $role == 'Manager'){?>
                                    <th></th>
                                    <?php }?>
                                    <!-- <th></th> -->
                              </tr>
                        </thead>
                        <!-- table body -->
                        <tbody>
                              <?php foreach ($players as $player):
                                    $status_color = '';
                                    if ($player->is_blacklist == 0) {
                                          $status_color = '#30c030';
                                    } else {
                                          $status_color = '#e03333';
                                    }
                                    ?>
                                    <tr>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($player)); ?>)">
                                                <?php echo $player->uid ?>      
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($player)); ?>)">
                                                <?php echo $player->name ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($player)); ?>)">
                                                <?php echo $player->email ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($player)); ?>)">
                                                <?php echo $player->phoneNumber ?>
                                          </td>
                                          <?php if($player->is_blacklist == 0){?>
                                                <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($player)); ?>)"><span class="status" style="background-color: <?php echo $status_color; ?>;">Activated</span></td>
                                          <?php }else{?>
                                                <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($player)); ?>)"> <span class="status" style="background-color: <?php echo $status_color; ?>;">Deactivated</span></td>
                                          <?php }?>
                                          <?php if($role == 'Admin' || $role == 'Manager'){?>
                                          <td onclick="openDeletePopup(<?php echo htmlspecialchars(json_encode($player)); ?>)"><i class="fa-solid fa-rotate edit icon"></i></td>
                                          <?php }?>
                                          </td>
                                    </tr>
                                    <?php
                              endforeach; ?>
                        </tbody>
                  </table>
            </div>


            <!-- popup windows -->
            <div class="popupcontainer" id="popupcontainer">

                  <!-- details popup window-->
                  <div class="popup" id="popup">
                        <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Player Info</h2>
                        <hr>
                        <div class="popupdetails">
                              <div class="popupdetail">
                                    <h2><b>Player ID : </b><span class="p_id"></span></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Name : </b><span class="p_name"></span></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Email : </b><span class="p_email"></span></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Mobile Number : </b><span class="p_number"></span></h2>
                              </div>
                        </div>
                  </div>


                  <!-- confirm delete popup window -->
                  <div class="deletepopup" id=deletepopup>
                        <span class="close" onclick="closeDeletePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Change the Status</h2>
                        <form action="<?php echo URLROOT; ?>/Users/delete" method="POST">
                              <div class="btns">
                                    <button type="submit" class="button">Change Status</button>
                                    <button type="button" onclick="closeDeletePopup()">Cancel</button>
                              </div>
                              <!-- <div hidden name="submit"><span class="pd_email"></span></div> -->
                              <input hidden name='submit' id="hid_input">
                        </form>
                  </div>
            </div>


            </div>
      </section>


      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/playerDetails_popup.js"></script>
      <!-- <script src="<?php echo URLROOT; ?>/js/player_table.js"></script> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script>
            $(document).ready(function () {
                  $("#searchInput").on("keyup", function () {
                        var value = $(this).val().toLowerCase();
                        $("table tbody tr").filter(function () {
                              var rowText = $(this).text().toLowerCase();
                              $(this).toggle(rowText.indexOf(value) > -1);
                        });
                  });
            });
      </script>
</body>
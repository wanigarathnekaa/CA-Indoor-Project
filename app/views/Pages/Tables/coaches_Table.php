<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coach_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
      <title>Coaches</title>
</head>

<body>

</body>

</html>
<html>


<body>
      <!-- Sidebar -->
      <?php
      $role = $_SESSION['user_role'];
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">

            <!-- Table Topic -->
            <div class="table-topic">
                  <div class="topic-name">
                        <h1>Coachers :
                              <?php echo $data["CoachCount"] ?>
                        </h1>
                  </div>
            
                  <div class="add-btn">
                        <a href="<?php echo URLROOT; ?>/Coach/register"><i class="fa-solid fa-user-plus  icon"></i></a>
                  </div>
            </div>

            <!-- Table Sort -->
            <div class="tableSort">
                  <!-- <div class="sort">
                        <label>Status :</label>
                        <select name="filter" id="filter">
                              <option value="all">All</option>
                              <option value="paid">Paid</option>
                              <option value="unpaid">Unpaid</option>
                              <option value="cancelled">Cancelled</option>
                        </select>
                  </div> -->
                  
                  <div class="search">
                        <label>
                              <input type="text" placeholder="Search here" id="searchInput" onkeyup="search()">
                              <i class="fa-solid fa-magnifying-glass icon"></i>
                        </label>
                  </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                  <table id="coachTable">
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Experience</th>
                                    <th>Speciality</th>
                                    <th>Certificate</th>
                                    <th></th>
                                    <!-- <th></th> -->
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php $i = 0; ?>
                              <?php foreach ($data['users'] as $coach): ?>
                                    <tr>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($coach)); ?>, <?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><?php echo $data1[$i]->name ?></td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($coach)); ?>, <?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><?php echo $data1[$i]->email ?></td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($coach)); ?>, <?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><?php echo $data1[$i]->phoneNumber ?></td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($coach)); ?>, <?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><?php echo $coach->srtAddress . ', ' . $coach->city ?></td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($coach)); ?>, <?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><?php echo $coach->experience ?></td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($coach)); ?>, <?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><?php echo $coach->specialty ?></td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($coach)); ?>, <?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><?php echo $coach->certificate?></td>
                                          <td onclick="openDeletePopup(<?php echo htmlspecialchars(json_encode($data1[$i])); ?>)"><i class="fa-solid fa-user-slash delete icon"></i></td>
                                    </tr>
                                    <?php $i = $i + 1;
                              endforeach; ?>
                        </tbody>
                  </table>
            </div>


            <!-- popup -->
            <div class="popupcontainer" id="popupcontainer">
                  <!-- details popup -->
                  <div class="popup" id="popup">
                        <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2><span class="c_name"></span></h2>
                        <hr>
                        <div class="popupdetails">
                              <div class="popupdetail">
                                    <h2><b>Email : </b><span class="c_email"></span> </h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Mobile : </b><span class="c_mobile"></span> </h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Experience : </b><span class="c_exp"></span> </h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Speciality : </b><span class="c_spl"></span> </h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Certificate : </b><span class="c_cert"></span> </h2>
                              </div>
                        </div>
                  </div>

                  
                  <!-- delete message -->
                  <div class="deletepopup" id=deletepopup>
                        <span class="close" onclick="closeDeletePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>confirm delete</h2>

                        <form action="<?php echo URLROOT; ?>/Coach/delete" method="POST">
                              <div class="btns">
                                    <button type="submit" class="button">Delete</button>
                                    <button type="button" onclick="closeDeletePopup()">Cancel</button>
                              </div>
                              <!-- <div hidden name="submit"><span class="pd_email"></span></div> -->
                              <input hidden name='submit' id="hid_input">
                        </form>
                  </div>
            </div>

      </section>

      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/coachDetails_popup.js"></script>
      <script src="<?php echo URLROOT; ?>/js/coach_Table.js"></script>
</body>
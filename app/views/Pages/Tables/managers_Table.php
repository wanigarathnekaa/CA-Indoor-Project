<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coach_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
      <title>Managers</title>
</head>

<body>

</body>

</html>
<html>


<body>
      <!-- Sidebar -->
      <?php
      $role = "Manager";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">

            <!-- Table Topic -->
            <div class="table-topic">
                  <div class="topic-name">
                        <h1>Managers :
                              <?php echo $data["ManagerCount"] ?>
                        </h1>
                  </div>
            
                  <!-- <div class="add-btn">
                        <a href="<?php echo URLROOT; ?>/Coach/register"><i class="fa-solid fa-user-plus  icon"></i></a>
                  </div> -->
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
                                    <th>phoneNumber</th>
                                    <th>NIC</th>
                                    <th></th>
                                    <th></th>

                                    
                                   
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php $i = 0; ?>
                              <?php foreach ($data['users'] as $manager): ?>
                                    <tr>
                                           <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($manager)); ?>)">
                                                <?php echo $manager->name; ?>
                                           </td>
                                           <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($manager)); ?>)">
                                                <?php echo $manager->email; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($manager)); ?>)">
                                                <?php echo $manager->phoneNumber; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($manager)); ?>)">
                                                <?php echo $manager->nic; ?>
                                          </td>
                                          
                                          <td><a href="#"><i class="fa-solid fa-user-pen edit icon"></i></a></td>
                                          <td onclick="openDeletePopup()"><i class="fa-solid fa-user-slash delete icon"></i></td>
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
                              <!-- <div class="popupdetail">
                                    <h2><b>Experience : </b><span class="c_exp"></span> </h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Speciality : </b><span class="c_spl"></span> </h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Certificate : </b><span class="c_cert"></span> </h2>
                              </div> -->
                        </div>

                        <!-- <div class="btns">
                              <button type="button">Reshedule</button>
                              <button type="button">Cancel</button>
                        </div> -->
                  </div>



                  
                  <!-- delete message -->
                  <div class="deletepopup" id=deletepopup>
                        <span class="close" onclick="closeDeletePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>confirm delete</h2>

                        <div class="btns">
                              <button type="button">Delete</button>
                              <button type="button" onclick="closeDeletePopup()">Cancel</button>
                        </div>
                  </div>
            </div>

      </section>

      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/coachDetails_popup.js"></script>
      <script src="<?php echo URLROOT; ?>/js/coach_Table.js"></script>
</body>
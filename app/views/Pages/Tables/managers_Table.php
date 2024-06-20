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
      $role = $_SESSION['user_role'];
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
            
                  <?php if ($role == 'Owner'): ?>
                  <div class="add-btn">
                  <a href="<?php echo URLROOT; ?>/Pages/Manager_Registration/manager"><i class="fa-solid fa-user-plus  icon"></i></a>
                 </div>
                 <?php endif; ?>
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
                                    <th>Address</th>
                                    <th></th>
                                    <!-- <th></th> -->

                                    
                                   
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
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($manager)); ?>)">
                                                <?php echo $manager->strAddress; ?>, <?php echo $manager->city; ?>
                                          </td>
                                          <td onclick="openDeletePopup(<?php echo htmlspecialchars(json_encode($manager)); ?>)"><i class="fa-solid fa-user-slash delete icon"></i></td>
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
                        <h2><span class="m_name"></span></h2>

                        <hr>
                        <div class="popupdetails">
                              <div class="popupdetail">
                                    <h2><b>Email : </b><span class="m_email"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Contact Number : </b><span class="m_number"></span></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>NIC : </b><span class="m_nic"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Address : </b><span class="m_address"></span></h2>
                              </div>
                        </div>

                        
                  </div>


                  
                  <!-- delete message -->
                  <div class="deletepopup" id=deletepopup>
                        <span class="close" onclick="closeDeletePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>confirm delete</h2>

                        <form action="<?php echo URLROOT; ?>/Manager/delete" method="POST">     
                              <div class="btns">                        
                                    <button type="submit" class="button">Delete</button>
                                    <button type="button" onclick="closeDeletePopup()">Cancel</button>
                              </div>                 
                              <input hidden name='submit' id="hid_input">
                        </form>
                  </div>
            </div>

      </section>

      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/managerDetails_Popup.js"></script>
      <script src="<?php echo URLROOT; ?>/js/coach_Table.js"></script>
</body>
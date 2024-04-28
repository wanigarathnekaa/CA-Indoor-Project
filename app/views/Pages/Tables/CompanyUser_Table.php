<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coach_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
      <title>Company Users</title>
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
                        <h1>Company Users :
                              <?php echo $data["CompanyUserCount"] ?>
                        </h1>
                        
                  </div>
            
                  <<div class="add-btn">
                        <a href="<?php echo URLROOT; ?>/Pages/Cashier_Registration/cashier"><i class="fa-solid fa-user-plus  icon"></i></a>
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
                                    <th>Role</th>                                   <th>Email</th>
                                    <th>phoneNumber</th>
                                    <th>NIC</th>
                                    <th></th>
                                    <th></th>

                                    
                                   
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php $i = 0; ?>
                              <?php foreach ($data['CompanyUsers'] as $CompanyUser): ?>
                                    <tr>
                                           <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($CompanyUser)); ?>)">
                                                <?php echo $CompanyUser->name; ?>
                                           </td>
                                           <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($CompanyUser)); ?>)">
                                           <?php
                                                if ($CompanyUser->role == 1) {
                                                      echo "Owner";
                                                  } elseif ($CompanyUser->role == 2) {
                                                      echo "Admin";
                                                  } elseif ($CompanyUser->role == 3) {
                                                      echo "Cashier";
                                                  } else {
                                                      // Handle other roles if necessary
                                                      echo "Unknown role";
                                                  }

                                          ?>
                                           </td>
                                          
                                           <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($CompanyUser)); ?>)">
                                                <?php echo $CompanyUser->email; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($CompanyUser)); ?>)">
                                                <?php echo $CompanyUser->phoneNumber; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($CompanyUser)); ?>)">
                                                <?php echo $CompanyUser->nic; ?>
                                          </td>
                                          <!-- <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($CompanyUser)); ?>)">
                                                <?php echo $CompanyUser->address; ?>
                                          </td> -->
                                          
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
                        <h2><span class="m_name"></span></h2>

                        <hr>
                        <div class="popupdetails">
           
                             
                              <div class="popupdetail">
                                    <h2><b>Role :</b><span class="m_role"></span></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Email :</b><span class="m_email"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Contact Number :</b><span class="m_number"></span></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>NIC :</b><span class="m_nic"></span></h2>
                              </div>

                              

                             
                        </div>

                        
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
      <script src="<?php echo URLROOT; ?>/js/managerDetails_Popup.js"></script>
      <script src="<?php echo URLROOT; ?>/js/coach_Table.js"></script>
</body>
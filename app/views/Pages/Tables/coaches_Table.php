<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coach_Table_Style.css">
      <title>Coaches</title>
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
                        <h1>Coachers :
                              <?php echo $data["CoachCount"] ?>
                        </h1>
                  </div>
                  <div class="search">
                        <label>
                              <input type="text" placeholder="Search here">
                              <i class="fa-solid fa-magnifying-glass icon"></i>
                        </label>
                  </div>
                  <div class="add-btn">
                        <a href="<?php echo URLROOT; ?>/Coach/register"><i class="fa-solid fa-user-plus  icon"></i></a>
                  </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                  <table>
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Mobile</td>
                                    <td>Experience</td>
                                    <td>Speciality</td>
                                    <td>Certificate</td>
                                    <td></td>
                                    <td></td>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php $i = 0; ?>
                              <?php foreach ($data['users'] as $coach): ?>
                                    <tr onclick="window.location.href='#';">
                                          <td><?php echo $data1[$i]->name ?></td>
                                          <td><?php echo $data1[$i]->email ?></td>
                                          <td><?php echo $data1[$i]->phoneNumber ?></td>
                                          <td><?php echo $coach->experience ?></td>
                                          <td><?php echo $coach->specialty ?></td>
                                          <td><?php echo $coach->certificate?></td>
                                          <td><a href="#"><i class="fa-solid fa-user-pen edit icon"></i></a></td>
                                          <td><a href="#"><i class="fa-solid fa-user-slash delete icon"></i><a></td>

                                    </tr>
                                    <?php $i = $i + 1;
                              endforeach; ?>
                        </tbody>
                  </table>
            </div>
      </section>
</body>
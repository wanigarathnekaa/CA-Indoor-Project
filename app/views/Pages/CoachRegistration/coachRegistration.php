<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coachRegistration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Coach Registration</title>
   </head>
<body>

  <!-- Sidebar -->
  <?php
      $role = $_SESSION['user_role'];
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
  ?>

    <!-- Content -->
    <section class="home registerformhome">
      <div class="container">
        <div class="title">Coach Registration Form</div>
        
        
        <div class="content">
          <form action="<?php echo URLROOT;?>/Coach/register" method="POST" enctype="multipart/form-data">
          <div class="upload">
          <!-- <button class=" btn"> -->
            <!-- <i class="fa fa-upload"></i>Upload File -->
            <input type="file" name="file">
          <!-- </button> -->
          </div>
            <div class="user-details">
              <div class="input-box">
                <span class="details">Full Name</span>
                <input type="text" placeholder="Enter your name"  name="name" required >
                <span class="form-invalid"><?php echo $data['name_err']; ?></span>
              </div>
            
              <div class="input-box">
                <span class="details">Email</span>
                <input type="email" placeholder="Enter your email" name="email" required>
                <span class="form-invalid"><?php echo $data['email_err']; ?></span>
              </div>
              <div class="input-box">
                <span class="details">Phone Number</span>
                <input type="tel" placeholder="Enter your number" name="phoneNumber" required>
                <span class="form-invalid"><?php echo $data['phoneNumber_err']; ?></span>
              </div>
              <div class="input-box">
                <span class="details">NIC</span>
                <input type="text" placeholder="Enter your NIC number" name="nic" required>
                <span class="form-invalid"><?php echo $data['nic_err']; ?></span>
              </div>
            
              <div class="input-box">
                <span class="details">Expeience</span>
                <input type="text" placeholder="Enter your Expeience" name="experience" required>
                <span class="form-invalid"><?php echo $data['experience_err']; ?></span>
              </div>
              <div class="input-box">
                <span class="details">Speciality</span>
                <input type="text" placeholder="Enter your Speciality" name="specialty" required>
                <span class="form-invalid"><?php echo $data['specialty_err']; ?></span>
              </div>
              <div class="input-box">
                <span class="details">Certificates</span>
                <input type="text" placeholder="Enter your Certificates" name="certificate" required>
                <span class="form-invalid"><?php echo $data['certificate_err']; ?></span>
              </div>
            
              
              <div class="input-box">
                  <span class="details">Achivements</span>
                  <input type="text" name="achivements" placeholder="Enter your Achivements" required> 
                  <span class="form-invalid"><?php echo $data['achivements_err']; ?></span>             
              </div>

              <!-- <label>Address</label> -->
              <div class="input-box">
                <label for="address">Street Address</label>
                <div>
                  <input type="text" name="srtAddress"  placeholder="Enter Your Street Address" required>
                  <span class="form-invalid"><?php echo $data['srtAddress_err']; ?></span>
                </div>
              </div>
              <div class="input-box">
                <label for="address">City</label>
                <div>
                  <input type="text" name="city"  placeholder="Enter Your City" required>
                  <span class="form-invalid"><?php echo $data['city_err']; ?></span>
                </div>
              </div>
            </div>
            
            <div class="button">
              <input type="submit" value="Register" >
            </div>       
          </form>
        </div>
      </div>
    </section>
</body>
</html>
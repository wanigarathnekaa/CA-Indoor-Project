<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coachRegistration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Registration Form</title>
   </head>
<body>

  <!-- Sidebar -->
  <<?php
      $role = "Manager";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
  ?>

    <!-- Content -->
    <section class="home registerformhome">
      <div class="container">
        <div class="title">Registration Form</div>
        <div class="upload">
          <button class=" btn">
            <i class="fa fa-upload"></i>Upload File
            <input type="file">
          </button>
        </div>
        
        <div class="content">
          <form action="<?php echo URLROOT;?>/Coach/register" method="POST">
            <div class="user-details">
              <div class="input-box">
                <span class="details">Full Name</span>
                <input type="text" placeholder="Enter your name"  name="name" required>
              </div>
            
              <div class="input-box">
                <span class="details">Email</span>
                <input type="text" placeholder="Enter your email" name="email" required>
              </div>
              <div class="input-box">
                <span class="details">Phone Number</span>
                <input type="text" placeholder="Enter your number" name="phoneNumber" required>
              </div>
              <div class="input-box">
                <span class="details">NIC</span>
                <input type="text" placeholder="Enter your NIC number" name="nic" required>
              </div>
            
              <div class="input-box">
                <span class="details">Expeience</span>
                <input type="text" placeholder="Confirm your Expeience" name="experience" required>
              </div>
              <div class="input-box">
                <span class="details">Speciality</span>
                <input type="text" placeholder="Enter your Speciality" name="speciality" required>
              </div>
              <div class="input-box">
                <span class="details">Certificates</span>
                <input type="text" placeholder="Enter your Certificates" name="certificate" required>
              </div>
            
              <!-- <label>Address</label> -->
              <div class="input-box">
                <label for="address">Achivements</label>
                <div>
                  <input type="text" name="achivements" id="address" placeholder="Enter your Achivements" required>
                </div>
              </div>
              <!-- <div class="input-box">
                <div class="topic">Address</div>
              </div>
              <div></div>
              <div></div> -->
              
              <div class="input-box">
                <label for="address">Street Address</label>
                <div>
                  <input type="text" name="srtAddress" id="address" placeholder="Enter your Address" required>
                </div>
              </div>
              <div class="input-box">
                <label for="address">city</label>
                <div>
                  <input type="text" name="city" id="address" placeholder="Enter your Address" required>
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
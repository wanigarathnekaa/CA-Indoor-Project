<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coachRegistration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Manage Registration</title>
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
            <div class="title">Manage Registration Form</div>

            <div class="content">
                <form action="<?php echo URLROOT;?>/Manager/register" method="POST">
                    <div class="upload">
                        <input type="file" name="file">
                    </div>
                    
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Full Name</span>
                            <input type="text" placeholder="Enter Your Name"  name="name" required >
                            <span class="form-invalid"><?php echo $data['name_err']; ?></span>
                        </div>

                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" placeholder="Enter Your Email" name="email" required>
                            <span class="form-invalid"><?php echo $data['email_err']; ?></span>
                        </div>

                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input type="tel" placeholder="Enter Your Phone Number" name="phoneNumber" required>
                            <span class="form-invalid"><?php echo $data['phoneNumber_err']; ?></span>
                        </div>

                        <div class="input-box">
                            <span class="details">NIC</span>
                            <input type="text" placeholder="Enter Your NIC Number" name="nic" required>
                            <span class="form-invalid"><?php echo $data['nic_err']; ?></span>
                        </div>

                        <div class="input-box">
                            <span class="details">Street Address</span>
                            <input type="text" placeholder="Enter Your Street Address" name="strAddress" required>
                            <span class="form-invalid"><?php echo $data['strAddress_err']; ?></span>
                        </div>

                        <div class="input-box">
                            <span class="details">City</span>
                            <input type="text" placeholder="Enter Your City" name="city" required>
                            <span class="form-invalid"><?php echo $data['city_err']; ?></span>
                        </div>
                    </div>

                    <div class="button">
                        <input type="submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
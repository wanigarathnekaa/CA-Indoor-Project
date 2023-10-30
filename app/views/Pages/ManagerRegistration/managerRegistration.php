<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Responsive Registration Form</title>
    <meta name="viewport" content="width=device-width,
      initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coachRegistration.css" />
</head>

<body>
    <div class="container">
        <h1 class="form-title">REGISTRATION FORM</h1>
        <form action="<?php echo URLROOT;?>/Manager/register" method="POST">
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Full Name" />
                </div>

                <div class="user-input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" />
                </div>
                <div class="user-input-box">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" />
                </div>
                <div class="user-input-box">
                    <label for="NIC">NIC</label>
                    <input type="text" id="nic" name="nic" placeholder="Enter NIC" />
                </div>
                <div class="user-input-box">
                    <label for="Address">Address</label>
                    <input type="Address" id="address" name="address" placeholder="Enter Address" />
                </div>

            </div>
            <div class="gender-details-box">
                <span class="gender-title">Gender</span>
                <div class="gender-category">
                    <input type="radio" name="gender" id="male">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="female">
                    <label for="female">Female</label>
                    <input type="radio" name="gender" id="other">
                    <label for="other">Other</label>
                </div>
            </div>
            <div class="form-submit-btn">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>
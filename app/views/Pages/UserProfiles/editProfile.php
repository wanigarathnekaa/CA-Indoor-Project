<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/editProfileStyle.css">
</head>

<body>
    <div class="container">
        <h1 class="form-title">Edit profile</h1>
        <form action="#">
            <img src="<?php echo URLROOT;?>/images/user.png" class="picture"><button class="btn1"><u>Change/Delete Profile Picture</u></button>
            <?php
                if($role == "User" || $role == "Coach"){
                        echo '<div class="main-user-info">
                <div class="user-input-box">
                    <label for="fullName">Name:</label>
                    <input type="text" id="fullName" name="fullName" placeholder="Enter Name" />
                </div>
                <div class="user-input-box">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" />
                </div>
                <div class="user-input-box">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" />
                </div>
                <div class="user-input-box">
                    <label for="NIC">NIC:</label>
                    <input type="NIC" id="NIC" name="NIC" placeholder="Enter NIC" />
                </div>
                <div class="user-input-box">
                    <label for="Address">Address:</label>
                    <input type="Address" id="Address" name="Address" placeholder="Enter Address" />
                </div>';
                    }
                if($role == "Coach"){
                        echo '<div class="user-input-box">
                    <label for="Specialization">Specialization:</label>
                    <input type="Specialization" id="Specialization" name="Specialization"
                        placeholder="Specialization" />
                </div>
                <div class="user-input-box">
                    <label for="Certification">Certification:</label>
                    <input type="Certification" id="Certification" name="Certification" placeholder="Certification" />
                </div>
                <div class="user-input-box">
                    <label for="Experience">Experience:</label>
                    <input type="Experience" id="Experience" name="Experience" placeholder="Experience" />
                </div>
                
                </div>';
                    }
                    
                
            
                if($role == "User" || $role == "Coach"){
                     echo '<div class="form-submit-btn">
                     <input type="submit" class="btn2" value="Save">
                     <input type="submit" class="btn3" value="Delete profile">

                </div>

                <div class="line-1"></div>
                <div class="edit-profile3">
                <div class="delete-profile">Change password</div>
                </div>
                <div class="group-138">
                <div class="group-135">
                    <label for="CurrentPaaword">Current Paaword:</label>
                    <input type="CurrentPaaword" id="CurrentPaaword" name="CurrentPaaword" />
                </div>
                <div class="group-136">
                    <label for="NewPaaword">New Paaword:</label>
                    <input type="NewPaaword" id="NewPaaword" name="NewPaaword" />
                </div>
                <div class="group-137">
                    <label for="ConfirmPaaword">Confirm New Paaword:</label>
                    <input type="ConfirmPaaword" id="ConfirmPaaword" name="ConfirmPaaword" />
                </div>
                <div class="form-submit1-btn">
                    <input type="submit" class="btn4" value="Change">


                </div>
            </div>';
        }
        ?>
        </form>
    </div>
</body>

</html>
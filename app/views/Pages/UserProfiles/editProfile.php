<?php $role = "Coach";?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/editProfileStyle.css">
</head>

<body>
    <div class="container">
        <h1 class="form-title">Edit profile</h1>
        <form action="<?php echo URLROOT . "/" . $role; ?>/edit" method="POST">
            <img src="<?php echo URLROOT; ?>/images/user.png" class="picture"><button class="btn1"><u>Change/Delete
                    Profile Picture</u></button>

            <?php if ($role == "User" || $role == "Coach"): ?>
                <div class="main-user-info">
                    <div class="user-input-box">
                        <label for="fullName">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name" value="<?=$data["name"]?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter Email" value="<?=$data["email"]?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" value="<?=$data["phoneNumber"]?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="NIC">NIC:</label>
                        <input type="NIC" id="nic" name="nic" placeholder="Enter NIC" value="<?=$data["nic"]?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="Address">Address:</label>
                        <input type="Address" id="address" name="address" placeholder="Enter Address" value="<?=$data["address"]?>"/>
                    </div>
                <?php endif ?>


                <?php if ($role == "Coach"): ?>
                    <div class="user-input-box">
                        <label for="Specialization">Specialization:</label>
                        <input type="Specialization" id="specialty" name="specialty" placeholder="Specialization" value="<?=$data["specialty"]?>" />
                    </div>
                    <div class="user-input-box">
                        <label for="Certification">Certification:</label>
                        <input type="Certification" id="certificate" name="certificate" placeholder="Certification" value="<?=$data["certificate"]?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="Experience">Experience:</label>
                        <input type="Experience" id="experience" name="experience" placeholder="Experience" value="<?=$data["experience"]?>"/>
                    </div>

                </div>
            <?php endif ?>


            <?php if ($role == "User" || $role == "Coach"): ?>
                <div class="form-submit-btn">
                    <input type="submit" name="submit" class="btn2" value="Save">
                    <a href="<?php echo URLROOT; ?>/Pages/Delete_Profile/coach"><input name="submit" class="btn3" value="Delete profile"></a>

                </div>

                <div class="line-1"></div>
                <div class="edit-profile3">
                    <div class="delete-profile">Change password</div>
                </div>
                <div class="group-138">
                    <div class="group-135">
                        <label for="CurrentPassword">Current Password:</label>
                        <input type="CurrentPassword" id="pwd" name="pwd" />
                    </div>
                    <div class="group-136">
                        <label for="NewPassword">New Password:</label>
                        <input type="NewPassword" id="pwd" name="pwd" />
                    </div>
                    <div class="group-137">
                        <label for="ConfirmPassword">Confirm New Password:</label>
                        <input type="ConfirmPassword" id="ConfirmPassword" name="ConfirmPassword" />
                    </div>
                    <div class="form-submit1-btn">
                        <input type="submit" name="submit" class="btn4" value="Change">
                    </div>
                </div> 
            <?php endif ?>
        </form>
    </div>
</body>

</html>
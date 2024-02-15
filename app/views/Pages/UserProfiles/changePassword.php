
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/changePassword.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
      <?php
        $role = $_SESSION['user_role'];
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
        $linkRole = "";
            if($role == "User"){
                  $linkRole = "Users";
            }
            else if($role == "Coach"){
                  $linkRole = "Coach";
            }
    ?>


      <!-- content -->
      <section class="home">
            <div class="container">
                  <div class="head">
                        <h1 class="form-title">Change Password</h1> 
                  </div>

                  <!-- form details -->
                  <div class="formbox">
                        <form action="<?php echo URLROOT . "/" . $linkRole; ?>/changePassword" method="POST" enctype="multipart/form-data">

                              <!-- profile details -->
                              <div class="profileDetails">
                                    <?php if ($role == "User" || $role == "Coach"): ?>
                                          <div class="box">
                                                <label for="name">Current Password</label>
                                                <input type="text" id="old_password" name="old_password"  value=""/>
                                          </div>
                                          <div class="box">
                                                <!-- <label for="user_name">New Password</label>
                                                <input type="text" name='user_name' id="user_name" value=""/> -->
                                          </div>
                                          <div class="box">
                                                <label for="user_name">New Password</label>
                                                <input type="text" name='new_password' id="new_password" value=""/>
                                          </div>
                                          <div class="box">
                                                <!-- <label for="user_name">New Password</label>
                                                <input type="text" name='user_name' id="user_name" value=""/> -->
                                          </div>
                                          <div class="box">
                                                <label for="email">Confirm Password</label>
                                                <input type="text" id="confirm_password" name="confirm_password" value=""/>
                                                <?php if (isset($errorMessage)): ?>
                                                <div class="text-danger"><?php echo $errorMessage; ?></div>
                                                <?php endif; ?>
                                          </div>
                                          <div class="buttons">
                                          <input type="submit" name="submit" class="button" value="Update" href="<?php echo URLROOT;?>/Pages/Profile/user">
                                          <a href="<?php echo URLROOT;?>/Pages/Profile/user" type="button" class="button">Cancel</a>
                                          </div>

                                    <?php endif ?>
                  
                              </div>
                                   
                        </form>
                  </div>    
            </div>
      </section>

      <script>
            var loadFile = function (event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
            };
      </script>
</body>
</html>



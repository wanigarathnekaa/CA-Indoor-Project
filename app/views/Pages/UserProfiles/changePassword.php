
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
                              <!-- profile picture
                              <div class="profilepic">
                                    <label for="file" class="propiclabel">
                                          <div class="profile-pic">
                                                <span class="camicon"><i class="fa-solid fa-camera"></i></span>
                                                <?php
                                                      if($data["img"] == null){
                                                            echo '<img class="profile-image" id="output" src="'.URLROOT.'/public/profilepic/avatar.jpg" width="150">' ;
                                                      }
                                                      else{
                                                            echo '<img class="profile-image" id="output" src="'.URLROOT.'/public/profilepic/'.$data["img"].'" width="150">'; 
                                                      }
                                                ?>
                                          </div>
                                    </label>
                                    <input type="file" hidden name="file" id="file" onchange="loadFile(event)" value="<?= URLROOT ?>/public/profilepic/<?= $data["img"] ?>" />     
                              </div> -->

                              <!-- profile details -->
                              <div class="profileDetails">
                                    <?php if ($role == "User" || $role == "Coach"): ?>
                                          <div class="box">

                                          
                                                <label for="name">Current Password</label>
                                                <input type="password" id="old_password" name="old_password"  value="" required/>
                                                <span class="form-invalid" style="color: #2e8a99" ><?php echo isset($data['old_password_err']) ? $data['old_password_err'] : ''; ?></span>

                                          </div>
                                          <div class="box">
                                                <!-- <label for="user_name">New Password</label>
                                                <input type="text" name='user_name' id="user_name" value=""/> -->
                                          </div>
                                          <div class="box">
                                                <label for="user_name">New Password</label>
                                                <input type="password" name='new_password' id="new_password" value="" required/>
                                                <span class="form-invalid"style="color: #2e8a99"><?php echo isset($data['new_password_err']) ? $data['new_password_err'] : ''; ?></span>


                                          </div>
                                          <div class="box">
                                                <!-- <label for="user_name">New Password</label>
                                                <input type="text" name='user_name' id="user_name" value=""/> -->
                                          </div>
                                          <div class="box">
                                                <label for="email">Confirm Password</label>
                                                <input type="password" id="confirm_password" name="confirm_password" value="" required/>
                                                <span class="form-invalid" style="color: #2e8a99"><?php echo isset($data['confirm_password_err']) ? $data['confirm_password_err'] : ''; ?></span>


                                          </div>
                                          

                                    <?php endif ?>
                  

                              </div>
                              <?php if ($role == "User" || $role == "Coach"): ?>
                              <div class="buttons">
                                    <input type="submit" name="submit" class="button" value="Update" href="<?php echo URLROOT;?>/Pages/Profile/user">
                                    <a href="<?php echo URLROOT;?>/Pages/Profile/user" type="button" class="button">Cancel</a>
                              </div>
                              <?php endif ?>     
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



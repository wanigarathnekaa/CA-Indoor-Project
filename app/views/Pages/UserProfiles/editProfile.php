
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/editProfileStyle.css">
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
                        <h1 class="form-title">Edit profile</h1> 
                  </div>

                  <!-- form details -->
                  <div class="formbox">
                        <form action="<?php echo URLROOT . "/" . $linkRole; ?>/edit" method="POST" enctype="multipart/form-data">
                              <!-- profile picture -->
                              <div class="profilepic">
                                    <label for="file" class="propiclabel">
                                          <div class="profile-pic">
                                                <!-- <span class="camicon"><i class="fa-solid fa-camera"></i></span> -->
                                                <span class="camicon"><i class='bx bxs-camera-plus'></i></span>
                                                <?php
                                                      if($data["img"] == null){
                                                            echo '<img class="profile-image" id="output" src="'.URLROOT.'/public/profilepic/avatar.jpg">' ;
                                                      }
                                                      else{
                                                            echo '<img class="profile-image" id="output" src="'.URLROOT.'/public/profilepic/'.$data["img"].'">'; 
                                                      }
                                                ?>
                                          </div>
                                    </label>
                                    <input type="file" hidden name="file" id="file" onchange="loadFile(event)" value="<?= URLROOT ?>/public/profilepic/<?= $data["img"] ?>" />     
                              </div>

                              <!-- profile details -->
                              <div class="profileDetails">
                                    <?php if ($role == "User" || $role == "Coach"): ?>
                                          <div class="box">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" name="name"  value="<?=$data["name"]?>"/>
                                                <span class="form-invalid"><?php echo $data['name_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="user_name">User Name</label>
                                                <input type="text" name='user_name' id="user_name" value="<?=$data["user_name"]?>"/>
                                                <span class="form-invalid"><?php echo $data['user_name_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" value="<?=$data["email"]?>" />
                                                <span class="form-invalid"><?php echo $data['email_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" id="phoneNumber" name="phoneNumber"  value="<?=$data["phoneNumber"]?>"/>
                                                <span class="form-invalid"><?php echo $data['phoneNumber_err']; ?></span>
                                          </div>

                                    <?php endif ?>
                  
                                    <?php if ($role == "Coach"): ?>
                                          <div class="box">
                                                <label for="nic">NIC</label>
                                                <input type="text" id="nic" name="nic" placeholder="Enter NIC" value="<?=$data["nic"]?>"/>
                                                <span class="form-invalid"><?php echo $data['nic_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="experience">Experience</label>
                                                <input type="text" id="experience" name="experience" value="<?=$data["experience"]?>"/>
                                                <span class="form-invalid"><?php echo $data['experience_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="srtAddress">Street Address</label>
                                                <input type="text" id="srtAddress" name="srtAddress" value="<?=$data["srtAddress"]?>"/>
                                                <span class="form-invalid"><?php echo $data['srtAddress_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="city">City</label>
                                                <input type="text" id="city" name="city" value="<?=$data["city"]?>"/>
                                                <span class="form-invalid"><?php echo $data['city_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="pecialty">Specialization</label>
                                                <input type="text" id="specialty" name="specialty" placeholder="Specialization" value="<?=$data["specialty"]?>" />
                                                <span class="form-invalid"><?php echo $data['specialty_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="certificate">Certification</label>
                                                <input type="text" id="certificate" name="certificate"  value="<?=$data["certificate"]?>"/>
                                                <span class="form-invalid"><?php echo $data['certificate_err']; ?></span>
                                          </div>
                                          <div class="box">
                                                <label for="achivements">Achivements</label>
                                                <input type="text" id="achivements" name="achivements" value="<?=$data["achivements"]?>"/>
                                                <span class="form-invalid"><?php echo $data['achivements_err']; ?></span>
                                          </div>
                                    <?php endif ?>
                              </div>
                              <?php if ($role == "User" || $role == "Coach"): ?>
                              <div class="buttons">
                                    <input type="submit" name="submit" class="button" value="Update">
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



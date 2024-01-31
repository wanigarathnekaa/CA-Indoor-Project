
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
    ?>


      <!-- content -->
      <section class="home">
            <div class="container">
                  <div class="head">
                        <h1 class="form-title">Edit profile</h1> 
                  </div>

                  <!-- form details -->
                  <div class="formbox">
                        <form action="<?php echo URLROOT . "/" . $role; ?>/edit" method="POST" enctype="multipart/form-data">
                              <!-- profile picture -->
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
                              </div>

                              <!-- profile details -->
                              <div class="profileDetails">
                                    <?php if ($role == "User" || $role == "Coach"): ?>
                                          <div class="box">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" name="name"  value="<?=$data["name"]?>"/>
                                          </div>
                                          <div class="box">
                                                <label for="user_name">User Name</label>
                                                <input type="text" name='user_name' id="user_name" value="<?=$data["user_name"]?>"/>
                                          </div>
                                          <div class="box">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" value="<?=$data["email"]?>"/>
                                          </div>
                                          <div class="box">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" id="phoneNumber" name="phoneNumber"  value="<?=$data["phoneNumber"]?>"/>
                                          </div>

                                    <?php endif ?>
                  
                                    <?php if ($role == "Coach"): ?>
                                          <div class="box">
                                                <label for="nic">NIC</label>
                                                <input type="text" id="nic" name="nic" placeholder="Enter NIC" value="<?=$data["nic"]?>"/>
                                          </div>
                                          <div class="box">
                                                <label for="experience">Experience</label>
                                                <input type="text" id="experience" name="experience" value="<?=$data["experience"]?>"/>
                                          </div>
                                          <div class="box">
                                                <label for="srtAddress">Street Address</label>
                                                <input type="text" id="srtAddress" name="srtAddress" value="<?=$data["srtAddress"]?>"/>
                                          </div>
                                          <div class="box">
                                                <label for="city">City</label>
                                                <input type="text" id="city" name="city" value="<?=$data["city"]?>"/>
                                          </div>
                                          <div class="box">
                                                <label for="pecialty">Specialization</label>
                                                <input type="text" id="specialty" name="specialty" placeholder="Specialization" value="<?=$data["specialty"]?>" />
                                          </div>
                                          <div class="box">
                                                <label for="certificate">Certification</label>
                                                <input type="text" id="certificate" name="certificate"  value="<?=$data["certificate"]?>"/>
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



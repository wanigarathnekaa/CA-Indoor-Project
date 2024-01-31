<?php $role = $data['role'];?>


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
    
      <div class="container">
            <div class="head">
                  <h1 class="form-title">Edit profile</h1>
            
            </div>

            <!-- form details -->
            <div class="formbox">
                  <form action="<?php echo URLROOT . "/" . $role; ?>/edit" method="POST" enctype="multipart/form-data">
                    <div class="profilepic">
                            <label for="fileToUpload">
                                <div class="profile-pic">
                                    <?php
                                    if($data["img"] == null){
                                          echo '<img class="profile-image" id="output" src="'.URLROOT.'/public/profilepic/avatar.jpg">';
                                    }
                                    else{
                                     echo '<img class="profile-image" src="'.URLROOT.'/public/profilepic/'.$data["img"].'">'; 
                                    }
                                    ?>
                                </div>
                            </label>
                            
                            <input type="file" name="file" id="file" onchange="loadFile(event)" value="<?= URLROOT ?>/public/profilepic/<?= $data["img"] ?>" />

                    </div>
                    
                    <!-- <div class="profile-pic">
                        <label class="-label" for="file">
                            <span class="glyphicon glyphicon-camera"></span>
                            <span>Change Image</span>
                        </label>
                        <input id="file" type="file" onchange="loadFile(event)" id="file" value="<?=$data["img"]?>"/>
                        <?php echo '<img  src="'.URLROOT.'/public/profilepic/'.$data["img"].'" id="output" width="200">'; ?>
                    </div> -->





                    <?php if ($role == "Users" || $role == "Coach"): ?>
                        <div class="bowrow">
                              <div class="box">
                                <label for="fullName">Name</label>
                                <input type="text" id="name" name="name"  value="<?=$data["name"]?>"/>
                              </div>
                              <div class="box">
                                    <label for="lname">User Name</label>
                                    <input type="text" name='user_name' id="user_name" value="<?=$data["user_name"]?>"/>
                              </div>
                        </div>
                        <div class="bowrow">
                              <div class="box">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?=$data["email"]?>"/>
                              </div>
                              <div class="box">
                              <label for="phoneNumber">Phone Number</label>
                                <input type="text" id="phoneNumber" name="phoneNumber"  value="<?=$data["phoneNumber"]?>"/>
                              </div>
                        </div>
                        <?php endif ?>
    
                        <?php if ($role == "Coach"): ?>
                        <div class="bowrow">
                              <div class="box">
                                <label for="NIC">NIC</label>
                                <input type="text" id="nic" name="nic" placeholder="Enter NIC" value="<?=$data["nic"]?>"/>
                              </div>
                              <div class="box">
                                    <label for="Experience">Experience:</label>
                                    <input type="text" id="experience" name="experience" value="<?=$data["experience"]?>"/>
                              </div>
                        </div>
                        <div class="bowrow">
                              <div class="box">
                                    <label for="fname">Street Address</label>
                                    <input type="text" id="srtAddress" name="srtAddress" value="<?=$data["srtAddress"]?>"/>
                              </div>
                              <div class="box">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" value="<?=$data["city"]?>"/>
                              </div>
                        </div>
                        <div class="bowrow">
                              <div class="box">
                              <label for="Specialization">Specialization</label>
                            <input type="text" id="specialty" name="specialty" placeholder="Specialization" value="<?=$data["specialty"]?>" />
                              </div>
                              <div class="box">
                                <label for="Certification">Certification</label>
                                <input type="text" id="certificate" name="certificate"  value="<?=$data["certificate"]?>"/>
                              </div>
                        </div>
                        <?php endif ?>

                        <?php if ($role == "Users" || $role == "Coach"): ?>
                            <div class="buttons">
                                <input type="submit" name="submit" class="button" value="Update">
                                <a href="<?php echo URLROOT;?>/Pages/Profile/user" type="button" class="button">Cancel</a>
                            </div>
                        <?php endif ?>
                            
                  </form>
            </div>    
      </div>

      <script>
            var loadFile = function (event) {
                var image = document.getElementById("output");
                image.src = URL.createObjectURL(event.target.files[0]);
            };
      </script>
</body>
</html>



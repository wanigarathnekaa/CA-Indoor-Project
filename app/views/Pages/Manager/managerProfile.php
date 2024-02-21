<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>profile</title>
      <link rel="stylesheet" href="<?php echo URLROOT;?>/css/profile.css">
      
</head>
<body>

    <!-- side bar -->
    <?php
        $role = $_SESSION['user_role'];
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>


    <!-- content -->
    <section class="home">
      <div class="profilecontainer">
            <div class="profile-block">
                  <div class="profile-pic">

                        <div class="imgBox">
                              <?php
                                    // if($data->img == null){
                                          echo '<img class="profile-image" src="'.URLROOT.'/public/profilepic/avatar.jpg">';
                                    // }
                                    // else{
                                    //       echo '<img class="profile-image" src="'.URLROOT.'/public/profilepic/'.$data->img.'">';
                                    // }
                              ?>
                        </div>
                        <?php if ($data !== null): ?>
                            <div class="name"><?php echo $data->name ?></div>
                        <?php endif; ?>
                        <div class="role"><?php echo $role ?></div>
                  </div>
                  <div class="details-block">
                        <div class="details">
                                <div class="infor"><b>Name</b> : <?php echo $data->name ?></div>
                                <div class="infor"><b>Email</b> : <?php echo $data->email?> </div>
                                <div class="infor"><b>Mobile Number</b> : <?php echo $data->phoneNumber?></div> 
                                <div class="infor"><b>nic</b> : <?php echo $data->nic?></div>
                                <div class="infor"><b>Address</b> : <?php echo $data->address?></div>                             
                        </div>
                        <div class="btnrow">
                            <a href="<?php echo URLROOT;?>/Pages/Manager_Edit_Profile/manager" type="button" class="button">Edit Profile</a>
                            <div class="Change Password">
                                <a class="button" href="<?php echo URLROOT; ?>/Pages/changePassword/user">Change Password</a>
                            </div>
                              <!-- <button type="button" class="button">Change Password</button> -->
                              <button type="button" class="button">Delete Profile</button>
                        </div>
                        
                  </div>
            </div>
      </div>
    </section>
</body>
</html>




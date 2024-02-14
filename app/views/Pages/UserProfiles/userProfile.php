<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>profile</title>
      <link rel="stylesheet" href="<?php echo URLROOT;?>/css/profile.css">
      <link rel="stylesheet" href="<?php echo URLROOT;?>/css/popup_coaches.css">
      
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
            <!-- profile container -->
            <div class="profilecontainer">
                  <div class="profile-block">
                        <div class="profile-pic">

                              <div class="imgBox">
                                    <?php
                                          if($data->img == null){
                                                echo '<img class="profile-image" src="'.URLROOT.'/public/profilepic/avatar.jpg">';
                                          }
                                          else{
                                                echo '<img class="profile-image" src="'.URLROOT.'/public/profilepic/'.$data->img.'">';
                                          }
                                    ?>
                              </div>
                              <div class="name"><?php echo $data->name ?></div>
                              <div class="role"><?php echo $role ?></div>
                        </div>
                        <div class="details-block">
                              <div class="details">
                                    <div class="infor"><b>Name</b> : <?php echo $data->name ?></div>
                                    <div class="infor"><b>User Name</b> : <?php echo $data->user_name ?></div>
                                    <div class="infor"><b>Email</b> : <?php echo $data->email?> </div>
                                    <div class="infor"><b>Mobile Number</b> : <?php echo $data->phoneNumber?></div>                              
                              </div>
                              <div class="btnrow">
                              <a href="<?php echo URLROOT;?>/Pages/editProfile/user" type="button" class="button">Edit Profile</a>
                                    <button type="button" class="button">Change Password</button>
                                    <button type="button" class="button" onclick="openDeletePopup()">Delete Profile</button>
                              </div>
                              
                        </div>
                  </div>
            </div>


            <!-- popup windows -->
            <div class="popupcontainer" id="popupcontainer">
                  <!-- confirm delete popup window -->
                  <div class="deletepopup" id=deletepopup>
                        <span class="close" onclick="closeDeletePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Are you sure you want to delete your account ?</h2>
                        <form action="<?php echo URLROOT; ?>/Coach/delete" method="POST">
                              <div class="btns">
                                    <button type="submit" class="button">Delete</button>
                                    <button type="button" onclick="closeDeletePopup()">Cancel</button>
                              </div>
                              <!-- <div hidden name="submit"><span class="pd_email"></span></div> -->
                              <input hidden name='submit' id="hid_input" value="<?=$data->email;?>">
                        </form>
                  </div>
            </div>
    </section>

    <!-- javascript -->
    <script src="<?php echo URLROOT; ?>/js/playerDetails_popup.js"></script>
</body>
</html>

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
                <form action="<?php echo URLROOT; ?>/CompanyUsers/edit" method="POST" enctype="multipart/form-data">
                    <!-- profile picture -->
                    <div class="profilepic">
                        <label for="file" class="propiclabel">
                            <div class="profile-pic">
                                <!-- <span class="camicon"><i class="fa-solid fa-camera"></i></span> -->
                                <span class="camicon"><i class='bx bxs-camera-plus'></i></span>
                                <?php
                                    if($data["image"] == null){
                                        echo '<img class="profile-image" id="output" src="'.URLROOT.'/public/profilepic/avatar.jpg">' ;
                                    }
                                    else{
                                        echo '<img class="profile-image" id="output" src="'.URLROOT.'/public/profilepic/'.$data["image"].'">'; 
                                    }
                                ?>
                            </div>
                        </label>
                        <input type="file" hidden name="file" id="file" onchange="loadFile(event)" value="<?= URLROOT ?>/public/profilepic/<?= $data["image"] ?>" />     
                    </div>

                    <!-- profile details -->
                    <div class="profileDetails">
                        <div class="box">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name"  value="<?=$data["name"]?>" required/>
                        </div>
                        <div class="box">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?=$data["email"]?>" />
                        </div>
                        <div class="box">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" id="phoneNumber" name="phoneNumber"  value="<?=$data["phoneNumber"]?>"/>
                        </div>
                        <div class="box">
                            <label for="nic">NIC</label>
                            <input type="text" id="nic" name="nic" placeholder="Enter NIC" value="<?=$data["nic"]?>"/>
                        </div>        
                    </div>
                    <div class="buttons">
                        <input type="submit" name="submit" class="button" value="Update">
                        <a href="<?php echo URLROOT;?>/Pages/CompanyUser_Profile/<?php echo $role ?>" type="button" class="button">Cancel</a>
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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!-- ===== ===== Custom Css ===== ===== -->
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/style.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <link rel="stylesheet" href="responsive.css"> -->

    <!-- ===== ===== Remix Font Icons Cdn ===== ===== -->
    <!-- <link rel="stylesheet" href="fonts/remixicon.css"> -->
</head>

<body>
    <!-- ===== ===== Body Main-Background ===== ===== -->
    <span class="main_bg"></span>


    <!-- ===== ===== Main-Container ===== ===== -->
    <div class="container">



        <!-- ===== ===== User Main-Profile ===== ===== -->
        <section class="userProfile card">
            <div class="profile">
                <figure><img src="<?php echo URLROOT;?>/images/user.png"  alt="profilepic" width="250px" height="500px"></figure>
            </div>
            <br>
            <div>
                
            </div>
        </section>


        

        <!-- ===== ===== Timeline & About Sections ===== ===== -->
        <section class="timeline_about card">
            

            <div class="contact_Info">
                <ul><br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <li class="name">
                        <span class="info"><b>Name</b> : <?php echo $data->name ?></span>
                    </li>
                    <br>
                    <li class="email">
                        <span class="info"><b>Email</b>: <?php echo $data->email?> </span>
                    </li>
                    <br>

                    <li class="mobile">
                        <span class="info"><b>Mobile Number</b>:<?php echo $data->phoneNumber?></span>
                    </li>
                    <br>
                    <li class="Address">
                        <span class="info"><b>Address</b> : <?php echo $data->uid?></span>
                    </li>
                    <br>
                    <br>
                    <li class="gender">
                        <span class="info"><b>Gender</b> :Male</span>
                    </li>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <a href="<?php echo URLROOT;?>/Pages/editProfile/user" class="btn" type="button">Edit Profile</a>
                   
                </ul>
            </div>

        </section>
    </div>

</body>

</html>

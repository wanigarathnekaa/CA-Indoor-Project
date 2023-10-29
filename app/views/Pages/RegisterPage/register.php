<?php require APPROOT.'/views/Pages/RegisterPage/RHeader.php';?>

        <form action="<?php echo URLROOT;?>/Users/register" method="POST">
            <div class="container">
                <?php //print_r($data) ?>
                <h1>Register</h1>
                <div class="input-box">
                    <label for="name"><b>Name</b></label>
                    <input type="text" id="name" name="name" placeholder = "<?php echo $data['name_err']?>" >
                    <!-- <span class="form-invalid"></span> -->
                    
                </div>

                <div class="input-box">
                    <label for="user_name"><b>Username</b></label>
                    <input type="text" name="user_name" id="user_name" placeholder= "<?php echo $data['user_name_err']?>">                   
                    <!-- <span class="form-invalid"></span> -->
                   
                </div>

                <div class="input-box">
                    <label for="email"><b>Email</b></label>
                    <input type="text"  name="email" id="email" placeholder = "<?php echo $data['email_err']?>">   
                    <!-- <span class="form-invalid"></span> -->

                </div>

                <div class="input-box">
                    <label for="phoneNumber"><b>Phone Number</b></label>
                    <input type="tel" name="phoneNumber" id="phoneNumber" placeholder= "<?php echo $data['phoneNumber_err']?>">                  
                    <!-- <span class="form-invalid"></span> -->

                </div>
                
                <div class="input-box">
                    <label for="pwd"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pwd" id="pwd" placeholder = "<?php echo $data['pwd_err']?>">
                    <!-- <span class="form-invalid"></span> -->

                </div>

                <div class="input-box">
                    <label for="confirmPwd"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Re-enter Password" name="confirmPwd" id="confirmPwd" placeholder = "<?php echo $data['confirmPwd_err']?>">
                    <!-- <span class="form-invalid"></span> -->
                </div>
                                          
                          
                <button class="btn" type="submit">Register</button>

<?php require APPROOT.'/views/Pages/RegisterPage/RFooter.php';?>
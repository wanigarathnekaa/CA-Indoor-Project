<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/registerStyles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Registration Page</title>
</head>
<body>
    <div  class="loginContainer" >
    <!-- Modal Container -->
        <form action="#">
            <div class="imgcontainer">
                <img src="<?php echo URLROOT;?>/images/Logo3.png" alt="Avatar" class="logo">
            </div>
            <div class="imgcontainer1">
                <img src="<?php echo URLROOT;?>/images/Group 89.png" alt="Avatar" class="sidepic1">
            </div>
            <div class="imgcontainer2">
                <img src="<?php echo URLROOT;?>/images/Frame 8.png" alt="Avatar" class="sidepic2">
            </div>

            <div class="container">
                <h1>Register</h1>
                <div class="input-box">
                    <label for="name"><b>Name</b></label>
                    <input type="text" name="name" required>
                    
                </div>

                <div class="input-box">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" name="uname" required>
                   
                </div>

                <div class="input-box">
                    <label for="email"><b>Email</b></label>
                    <input type="text"  name="email" required>
                    
                </div>

                <div class="input-box">
                    <label for="phone"><b>Phone Number</b></label>
                    <input type="tel" name="phone" required>
                   
                </div>
                
                <div class="input-box">
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    
                </div>

                <div class="input-box">
                    <label for="psw"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Re-enter Password" name="psw" required>
                    
                </div>
                                          
                          
                <button class="btn" type="submit">Register</button>

                <div class="loginLink">
                    <p>Already have an account?</p>
                    <a href="#">Sign in</a>
                </div>
            </div>
        </form>
    </div> 
</body>
</html>
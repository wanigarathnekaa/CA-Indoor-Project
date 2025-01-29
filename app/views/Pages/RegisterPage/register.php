<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/registerStyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Registration Page</title>
</head>
<body>
      <!-- <script src="https://kit.fontawesome.com/f9275dded9.js" crossorigin="anonymous"></script> -->

           
      <div class="container" id="container">
            <div class="sign-in-container">
                  <form action="<?php echo URLROOT;?>/Users/register" method="POST">
                        <h2>Register</h2>
                        <div class="input-box">
                              <input type="text" id="name" name="name" value="<?php echo $data['name']?>">
                              <label>Name</label>
                              <span class="form-invalid"><?php echo $data['name_err']; ?></span>
                        </div>
                        <div class="input-box">
                              <input type="text" name="user_name" id="user_name" value= "<?php echo $data['user_name'];?>">
                              <label>User Name</label>
                              <span class="form-invalid"><?php echo $data['user_name_err']; ?></span>
                        </div>
                        <div class="input-box">
                              <input type="text" name="email" id="email" value="<?php echo $data['email'];?>">
                              <label>Email</label>
                              <span class="form-invalid"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="input-box">
                              <input type="text" name="phoneNumber" id="phoneNumber" value= "<?php echo $data['phoneNumber'];?>">
                              <label>Phone Number</label>
                              <span class="form-invalid"><?php echo $data['phoneNumber_err']; ?></span>
                        </div>
                        <div class="input-box">
                              <input type="password" name="pwd" id="pwd" value = "<?php echo $data['pwd']?>">
                              <label>Password</label>
                              <span class="form-invalid"><?php echo $data['pwd_err']; ?></span>
                        </div>
                        <div class="input-box">
                              <input type="password" name="confirmPwd" id="confirmPwd" value = "<?php echo $data['confirmPwd']?>">
                              <label>Confirm Password</label>
                              <span class="form-invalid"><?php echo $data['confirmPwd_err']; ?></span>
                        </div>
                        <button class="btn" type="submit">Register</button>
                        <div class="signup-link">
                              <p>Already have an account?</p>
                              <a href="login">Login</a>
                        </div>
                      </form>
            </div>
            <div class="imgcontainer">
                  <img src="<?php echo URLROOT;?>/images/Logo3.png" alt="logo" class="logo">
                  
            </div>
      </div>
</body>
</html>
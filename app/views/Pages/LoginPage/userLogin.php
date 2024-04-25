<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/loginStyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Page</title>
</head>
<body>          
      <div class="container" id="container">
            <div class="sign-in-container">
                  <form  action="<?php echo URLROOT;?>/Users/login" method="POST">
                        <h2>Login</h2>
                        <div class="input-box">
                              <input type="text"  name="email" id="email" value="<?php echo $data['email']; ?>">
                              <label>Email</label>
                              <span class="form-invalid"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="input-box">
                              <input type="password" name="pwd" id="pwd" value="<?php echo $data['pwd'];?>">
                              <label>Password</label>
                              <span class="form-invalid"><?php echo $data['pwd_err']; ?></span>
                        </div>
                        <div class="forgot-password">
                              <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
                              <a href="forgotPassword">Forgot Password?</a>
                        </div>
                        <button class="btn" type="submit">Login</button>

                        <?php 
                              if($role == "User"){
                                    echo '<div class="signup-link">
                                           <p>Don\'t have an account?</p>
                                           <a href="register">Register</a>
                                          </div>';
                               }
                         ?>
                  </form>
            </div>
            <div class="imgcontainer">
                  <img src="<?php echo URLROOT;?>/images/Logo3.png" alt="logo" class="logo">
                  
            </div>
      </div>
</body>
</html>
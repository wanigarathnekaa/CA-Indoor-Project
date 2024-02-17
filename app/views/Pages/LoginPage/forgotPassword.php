<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/forgotPassword.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Page</title>
</head>
<body>
    <div  class="loginContainer" >
    <!-- Modal Container -->
        <form action="<?php echo URLROOT; ?>/Users/forgotPassword" method="post">
            
           
            
            <div class="container">
                <h1>Forgot password?</h1>
                <div class="text1">Enter your email and we’ll help you create a new password
                </div>
                
                <div class="input-box">
                    <!-- <label for="psw"><b>Password</b></label> -->
                    <input type="email" placeholder="Enter email" name="email" value="" required >
                   
                </div>
                
            
                <button class="btn" name="send" type="submit">Send</button>
            </div>
        </form>
    </div> 
</body>
</html>
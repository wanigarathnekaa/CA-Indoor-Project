            <div class="container">
                <h1>Login</h1>
                
                <div class="input-box">
                    <!-- <label for="uname"><b>Username</b></label> -->
                    <input type="text" name="email" id="email" placeholder="<?php echo $data1['email_err']; ?>">
                    <i class='bx bxs-user'></i>
                    <!-- <span class="form-invalid"></span> -->
                </div>
                
                <div class="input-box">
                    <!-- <label for="psw"><b>Password</b></label> -->
                    <input type="password" name="pwd" id="pwd" placeholder="<?php echo $data1['pwd_err']; ?>">
                    <i class='bx bxs-low-vision'></i>
                    <!-- <span class="form-invalid"></span> -->
                </div>
                <div class="remember-forget">
                    <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
                    <a href="#">Forgot password?</a><br>
                </div>
            
                <button class="btn" type="submit">Login</button>

                <?php 
                    if($role == "User"){
                        echo '<div class="registerLink">
                                <p>Don\'t have an account?</p>
                                <a href="#">Register</a>
                            </div>';
                    }
                ?>
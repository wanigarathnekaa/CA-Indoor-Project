<?php
    class Users extends Controller{
        private $userModel;
        public function __construct(){
            $this->userModel = $this->model('M_Users');
        }

        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //form is submitting

                //Valid input
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                //Input data
                $data = [
                    'name' => trim($_POST['name']),
                    'user_name' => trim($_POST['user_name']),
                    'email' => trim($_POST['email']),
                    'phoneNumber' => trim($_POST['phoneNumber']),
                    'pwd' => trim($_POST['pwd']),
                    'confirmPwd' => trim($_POST['confirmPwd']),

                    'name_err' => "",
                    'user_name_err' => "",
                    'email_err' => "",
                    'phoneNumber_err' => "",
                    'pwd_err' => "",
                    'confirmPwd_err' => "",
                ];

                //validate name
                if(empty($data['name'])){
                    $data['name_err'] = "Please enter a name";
                }

                //validate user_name
                if(empty($data['user_name'])){
                    $data['user_name_err'] = "Please enter an user_name";
                }
                
                //validate email
                if(empty($data['email'])){
                    $data['email_err'] = "Please enter an email";
                }
                else{
                    //check email already registered or not
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = "This email is already in use";
                    }
                }

                //validate phone number
                if(empty($data['phoneNumber'])){
                    $data['phoneNumber_err'] = "Please enter a phone number";
                }

                //validate password
                if(empty($data['pwd'])){
                    $data['pwd_err'] = "Please enter a password";
                }
                else{
                    if($data['pwd'] != $data['confirmPwd']){
                        $data['pwd_err'] = "Not Matching Passwords";
                    }
                }

                //validate confirm passowrd
                if(empty($data['confirmPwd'])){
                    $data['confirmPwd_err'] = "Please confirm your password";
                }


                //If validation is completed and no error, then register the user
                if(empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err']) && empty($data['pwd_err']) && empty($data['confirmPwd_err'])) {
                    //Hash the password
                    $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                    //create user
                    if($this->userModel->register($data)){
                        redirect('Users/login');
                    }
                    else{
                        die('Something Went wrong');
                    }
                }
                else{
                    //Load the view
                    $this->view('Pages/RegisterPage/register', $data);
                }
            }
            else{
                //initial form
                $data = [
                    'name' => "heee",
                    'user_name' => "",
                    'email' => "",
                    'phoneNumber' => "",
                    'pwd' => "",
                    'confirmPwd' => "",

                    'name_err' => "", 
                    'user_name_err' => "",
                    'email_err' => "",
                    'phoneNumber_err' => "",
                    'pwd_err' => "",
                    'confirmPwd_err' => "",
                ];
            }

            //Load the view
            $this->view('Pages/RegisterPage/register', $data);
        }

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //submitting form
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                //Input data
                $data = [
                    'email' => trim($_POST['email']),
                    'pwd' => trim($_POST['pwd']),

                    'email_err' => "",
                    'pwd_err' => "",
                ];

                //validate the email
                if(empty($data['email'])){
                    $data['email_err'] = "Please enter an email";
                }
                else{
                    //check email already registered or not
                    if($this->userModel->findUserByEmail($data['email'])){
                       echo "user is found";
                    }else{
                        $data['email_err'] = "User Not Found";
                    }
                }

                //validate the user
                if(empty($data['pwd'])){
                    $data['pwd_err'] = "Please enter a password";
                }

                //If no error found then login user
                if(empty($data['email_err']) && empty($data['pwd_err'])){
                    $loginUser = $this->userModel->login($data['email'], $data['pwd']);

                    if($loginUser){
                        //Authenticate User
                        $this->createUserSession($loginUser);
                    }
                    else{
                        $data['pwd_err'] = "Invalid Password";
                        // echo $data['pwd_err'];
                        //Load View
                        $this->view('Pages/LoginPage/login', $data);
                    }
                }
                else{
                    //Load View
                    $this->view('Pages/LoginPage/login', $data);
                }

            }
            else{
                //initial form
                $data = [
                    'email' => "",
                    'pwd' => "",

                    'email_err' => "",
                    'pwd_err' => "",
                ];

                //Load View
                $this->view('Pages/LoginPage/login', $data);


            }

        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->uid;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;

            redirect('Pages/Dashboard/user');
        }
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();

            redirect('Users/login');
        }

        public function isloggedin(){
            if(isset($_SESSION['user_id'])){
                return true;
            }else{
                return false;
            }
        }
    }


?>
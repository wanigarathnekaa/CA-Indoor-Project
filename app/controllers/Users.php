<?php
class Users extends Controller
{
    private $userModel;
    private $userManagerModel;
    private $userCoachModel;
    private $userAdminModel;
    public function __construct()
    {
        $this->userModel = $this->model('M_Users');
        $this->userManagerModel = $this->model('M_Manager');
        $this->userCoachModel = $this->model('M_Coach');
        $this->userAdminModel = $this->model('M_Admin');


    }

    //Register function.....................................................
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }

            //validate user_name
            if (empty($data['user_name'])) {
                $data['user_name_err'] = "Please enter an user name";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            } 
            else {
                //check email already registered or not
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "This email is already in use";
                }
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }
            elseif(strlen($data['phoneNumber']) != 10){
                    $data['phoneNumber_err'] = "Please enter a valid phone number";
            }
            else{
                // if ($this->userModel->findUserByPhoneNumber($data['phoneNumber'])) {
                //     $data['phoneNumber_err'] = "This phone number is already in use";
                // }
            }

            //validate password
            if (empty($data['pwd'])) {
                $data['pwd_err'] = "Please enter a password";
            }
            elseif(empty($data['confirmPwd'])){
                $data['confirmPwd_err'] = "Please confirm your password";
            }
            else{
                if($data['pwd'] != $data['confirmPwd']){
                    $data['confirmPwd_err'] = "Not Matching Passwords";
                }
            }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err']) && empty($data['pwd_err']) && empty($data['confirmPwd_err'])) {
                //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                //create user
                if ($this->userModel->register($data)) {
                    redirect('Users/login');
                } else {
                    die('Something Went wrong');
                }
            } else {
                //Load the view
                $this->view('Pages/RegisterPage/register', $data);
            }
        } else {
            //initial form
            $data = [
                'name' => "",
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

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //submitting form
            $role = "User";
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            //Input data
            $data = [
                'email' => trim($_POST['email']),
                'pwd' => trim($_POST['pwd']),

                'email_err' => "",
                'pwd_err' => "",
            ];

            //validate the email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            } else {
                //check email already registered or not
                if ($this->userManagerModel->findUserByEmail($data['email'])) {
                    $role = 'Manager'; 
                    //echo "user is found";
                }
                 elseif ($this->userModel->findUserByEmail($data['email'])) {
                    $role = 'User';
                    //echo "user is found";
                }
                
                
                else {
                    //user not found
                    $role = 'User Not Found';
                    $data['email_err'] = "User Not Found";
                }
            }


            //validate password
            if (empty($data['pwd'])) {
                $data['pwd_err'] = "Please enter the password";
            }

            //If no error found then login user
            if (empty($data['email_err']) && empty($data['pwd_err'])) {
                if ($role == 'User') {
                    //Authenticate User
                    $loginUser = $this->userModel->login($data['email'], $data['pwd']);
                    
                    if($loginUser == false){
                        $data['pwd_err'] = "Invalid Password";
                        $this->view('Pages/LoginPage/login', $data);
                    }else if ($this->userCoachModel->findUserByEmail($data['email'])) {
                        $role = 'Coach';
                        $this->createUserSession($loginUser, $role);
                    }else{
                        $this->createUserSession($loginUser, $role);
                    }
                } else if ($role == 'Manager') {
                    $loginManager = $this->userModel->loginManager($data['email'], $data['pwd']);
                    if($loginManager == false){
                        $data['pwd_err'] = "Invalid Password";
                        $this->view('Pages/LoginPage/login', $data);
                    }else{
                        $this->createUserSession($loginManager , $role);
                    }                   
                }
            } else {
                //Load View
                $this->view('Pages/LoginPage/login', $data);
            }

        } else {
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

    public function createUserSession($user, $role)
    {
        $_SESSION['user_id'] = $user->uid;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_role'] = $role;

        if($role == 'Manager'){
            redirect('Pages/Dashboard/manager');
        }elseif($role == 'User'){
            redirect('Pages/Dashboard/user');
        }else{
            redirect('Pages/Dashboard/coach');
        }

        
    }
    public function logout()
    {
        session_destroy();

        redirect('Users/login');
    }

    public function isloggedin()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            //echo 'No Session';
            //redirect('Users/login');
            return false;
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //form is submitting

            //Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            //Input data
            $data = [
                'name' => trim($_POST['name']),
                'user_name' => trim($_POST['user_name']),
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'pwd' => "12345678",
                'filename' => trim($_FILES['file']['name']),
                'filetmp' => trim($_FILES['file']['tmp_name']),

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'filename_err' => "",
                'filetmp_err' => "",
            ];

            // Check if a new file has been uploaded
            if (!empty($_FILES['file']['name'])) {
                // Move the uploaded file
                $newfilename = uniqid() . "-" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], "../public/profilepic/" . $newfilename);
                $data['filename'] = $newfilename;
            }else {
                // No new file uploaded, retain the existing image value
                $existingFilename = $this->userModel->getExistingImageFilename($data['email']); // Replace $userId with the actual user ID
                $data['filename'] = $existingFilename;
            }




            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }

            //validate user_name
            if (empty($data['user_name'])) {
                $data['user_name_err'] = "Please enter an user_name";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }

            //validate password
            if (empty($data['pwd'])) {
                $data['pwd_err'] = "Please enter a password";
            }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err'])) {
                //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);
                
                //create user
                if($this->userModel->updateUser($data)) {
                    redirect('Pages/Profile/user');
                }else{
                    die('Something Went wrong');
                }


            } else {
                //Load the view
                $this->view('Pages/UserProfiles/editProfile', $data);
            }
        }
        //Load the view
        $this->view('Pages/UserProfiles/editProfile', $data);
    }

    public function delete()
    {
        // var_dump($_POST);
        if($this->userModel->deleteUser($_POST["submit"])) {  
            redirect("Users/register");
        }else{
            die("Something Went Wrong");
        }
        
    }


}


?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Users extends Controller
{
    private $userModel;
    private $userManagerModel;
    private $userCoachModel;
    private $companyUserModel;
    public function __construct()
    {
        $this->userModel = $this->model('M_Users');
        $this->userManagerModel = $this->model('M_Manager');
        $this->userCoachModel = $this->model('M_Coach');
        $this->companyUserModel = $this->model('M_CompanyUsers');
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
                'is_blacklist' => 0,

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'pwd_err' => "",
                'confirmPwd_err' => "",
            ];

            print_r($data);

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
            } else {
                //check email already registered or not
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "This email is already in use";
                }
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            } elseif (strlen($data['phoneNumber']) != 10) {
                $data['phoneNumber_err'] = "Please enter a valid phone number";
            } else {
                // if ($this->userModel->findUserByPhoneNumber($data['phoneNumber'])) {
                //     $data['phoneNumber_err'] = "This phone number is already in use";
                // }
            }

            //validate password
            if (empty($data['pwd'])) {
                $data['pwd_err'] = "Please enter a password";
            } elseif (empty($data['confirmPwd'])) {
                $data['confirmPwd_err'] = "Please confirm your password";
            } else {
                if ($data['pwd'] != $data['confirmPwd']) {
                    $data['confirmPwd_err'] = "Not Matching Passwords";
                }
            }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err']) && empty($data['pwd_err']) && empty($data['confirmPwd_err'])) {
                //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                //create user
                if ($this->userModel->register($data)) {
                    $this->userModel->createlog($data);
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
                } elseif ($this->userModel->findUserByEmail($data['email'])) {
                    $role = 'User';
                } elseif ($this->companyUserModel->findUserByEmail($data['email'])) {
                    $roleNumber = $this->companyUserModel->getUserRoleByEmail($data['email']);
                    if ($roleNumber->role == 1) {
                        $role = 'Owner';
                    } elseif ($roleNumber->role == 2) {
                        $role = 'Admin';
                    } elseif ($roleNumber->role == 3) {
                        $role = 'Cashier';
                    }
                } else {
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

                    if ($loginUser == false) {
                        $data['pwd_err'] = "Invalid Password";
                        $this->view('Pages/LoginPage/login', $data);
                    } else if ($this->userCoachModel->findUserByEmail($data['email'])) {
                        $role = 'Coach';
                        //updating_last_login_time
                        $this->userModel->updateLastLogin($loginUser->email);
                        $this->createUserSession($loginUser, $role);
                    } else {
                        //updating_last_login_time
                        $this->userModel->updateLastLogin($loginUser->email);
                        $this->createUserSession($loginUser, $role);
                    }
                } else if ($role == 'Manager') {
                    $loginManager = $this->userModel->loginManager($data['email'], $data['pwd']);
                    if ($loginManager == false) {
                        $data['pwd_err'] = "Invalid Password";
                        $this->view('Pages/LoginPage/login', $data);
                    } else {
                        $this->createUserSession($loginManager, $role);
                    }
                } else if ($role == 'Owner') {
                    $loginOwner = $this->companyUserModel->loginCompanyUsers($data['email'], $data['pwd']);
                    if ($loginOwner == false) {
                        $data['pwd_err'] = "Invalid Password";
                        $this->view('Pages/LoginPage/login', $data);
                    } else {
                        $this->createUserSession($loginOwner, $role);
                    }
                } else if ($role == 'Admin') {
                    $loginAdmin = $this->companyUserModel->loginCompanyUsers($data['email'], $data['pwd']);
                    if ($loginAdmin == false) {
                        $data['pwd_err'] = "Invalid Password";
                        $this->view('Pages/LoginPage/login', $data);
                    } else {
                        $this->createUserSession($loginAdmin, $role);
                    }
                } else if ($role == 'Cashier') {
                    $loginCashier = $this->companyUserModel->loginCompanyUsers($data['email'], $data['pwd']);
                    if ($loginCashier == false) {
                        $data['pwd_err'] = "Invalid Password";
                        $this->view('Pages/LoginPage/login', $data);
                    } else {
                        $this->createUserSession($loginCashier, $role);
                    }
                } else {
                    $data['email_err'] = "User Not Found";
                    $this->view('Pages/LoginPage/login', $data);
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


    public function forgotPassword()
    {
        $this->view('Pages/LoginPage/forgotPassword');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //input data
            $data = [
                'email' => trim($_POST['email']),

                'email_err' => ''

            ];
            $email = trim($_POST['email']);
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter the email';
            }
            if (empty($data['email_err'])) {
                if ($this->userModel->findUserByEmail($email)) {
                    $user=$this->userModel->findUserByEmail($email);
                    // flash('complaint_created');
                    $password = $this->userModel->generateRandomPassword();
                    if($this->userModel->sendNewPassword($email,$password)){
                        $this->view('Users/login');

                    }



                    // redirect('Users/sendNewPassword/' . urlencode($email) . '/' . urlencode($password));

                } else {
                    $this->view('Pages/LoginPage/forgotPassword');
                }
            } else {
                //load view
                $this->view('Pages/LoginPage/forgotPassword');

            }

        }


    }
    public function sendNewPassword($email, $password)
    {
        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';


        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nivodya2001@gmail.com';
        $mail->Password = 'wupbxphjicpfidgj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('nivodya2001@gmail.com', 'Hasini Hewa');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'New password for yor forgoteen';
        $mail->Body = $password;
        $mail->send();
        $hashedNewPassword = password_hash($password, PASSWORD_DEFAULT);


        if ($mail->send()) {
            if ($this->userModel->updatePassword($email, $hashedNewPassword)) {
                $this->view('Pages/OTPSEND/index');
            } else {
                die('somthing wrong');
            }
        }
    }



    public function createUserSession($user, $role)
    {
        $_SESSION['user_id'] = $user->uid;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_role'] = $role;

        if ($role == 'Manager') {
            redirect('Pages/Dashboard/manager');
        } elseif ($role == 'User') {
            redirect('Pages/Dashboard/user');
        } elseif ($role == 'Coach') {
            redirect('Pages/Dashboard/coach');
        } elseif ($role == 'Owner') {
            redirect('Pages/Dashboard/owner');
        } elseif ($role == 'Admin') {
            redirect('Pages/Dashboard/admin');
        } elseif ($role == 'Cashier') {
            redirect('Pages/Dashboard/cashier');
        }
    }
    public function logout()
    {
        // Update last logout time in the database
        $this->userModel->updateLastLogout($_SESSION['user_email']);

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
                // 'pwd' => "12345678",
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
            } else {
                // No new file uploaded, retain the existing image value
                $existingFilename = $this->userModel->getExistingImageFilename($data['email']); // Replace $userId with the actual user ID
                $data['filename'] = $existingFilename;
                $data['img'] = $existingFilename;
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
            // if (empty($data['pwd'])) {
            //     $data['pwd_err'] = "Please enter a password";
            // }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err']) && empty($data['phoneNumber_err'])) {
                //Hash the password
                // $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                //create user
                if ($this->userModel->updateUser($data)) {
                    redirect('Pages/Profile/user');
                } else {
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


    public function changePassword()
    {
        $user = $this->userModel->findUser($_SESSION['user_email']);


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'oldPassword' => trim($_POST['old_password']),
                'newPassword' => trim($_POST['new_password']),
                'confirmPassword' => trim($_POST['confirm_password']),

                'old_password_err' => "",
                'new_password_err' => "",
                'confirm_password_err' => ""

            ];




            if (empty($data['oldPassword']) || empty($data['newPassword']) || empty($data['confirmPassword'])) {
                $this->view('Pages/UserProfiles/changePassword');
            } else {
                $hashedPassword = $user->password;
                if (password_verify($data['oldPassword'], $hashedPassword)) {
                    if ($data['oldPassword'] == $data['newPassword']) {
                        $data['new_password_err'] = "Please enter a password different from the old one.";
                        $this->view('Pages/UserProfiles/changePassword', $data);

                    } else if ($data['newPassword'] != $data['confirmPassword']) {
                        $data['confirm_password_err'] = "Passwords do not match. Please try again.";
                        $this->view('Pages/UserProfiles/changePassword', $data);

                    } else {
                        $hashedNewPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                        $this->userModel->updatePassword($user->email, $hashedNewPassword);
                        $this->view('Pages/UserProfiles/userProfile', $user);
                    }
                } else {
                    $data['old_password_err'] = "Current Password is incorrect.";
                    $this->view('Pages/UserProfiles/changePassword', $data);
                    $this->view('Pages/UserProfiles/changePassword');
                }
            }
        }
    }
    
    public function companychangePassword()
    {   $user=$this->userModel->findCompanyUserByEmail($_SESSION['user_email']) ;
       
             

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'oldPassword' => trim($_POST['old_password']),
                'newPassword' => trim($_POST['new_password']),
                'confirmPassword' => trim($_POST['confirm_password']),

                'old_password_err' => "",
                'new_password_err' => "",
                'confirm_password_err' => ""

            ];




            if (empty($data['oldPassword']) || empty($data['newPassword']) || empty($data['confirmPassword'])) {
                $this->view('Pages/CompanyUser/companyUserProfile');
            } else {
                $hashedPassword = $user->password;
                if (password_verify($data['oldPassword'], $hashedPassword)) {
                    if ($data['oldPassword'] == $data['newPassword']) {
                        $data['new_password_err'] = "Please enter a password different from the old one.";
                        $this->view('Pages/CompanyUser/changepassword', $data);//C:\xampp\htdocs\C&A_Indoor_Project\app\views\Pages\CompanyUser\.php

                    } else if ($data['newPassword'] != $data['confirmPassword']) {
                        $data['confirm_password_err'] = "Passwords do not match. Please try again.";
                        $this->view('Pages/CompanyUser/changepassword', $data);

                    } else {
                        $hashedNewPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                        $this->userModel->updateCompanyUserPassword($user->email, $hashedNewPassword);
                        $this->view('Pages/CompanyUser/companyUserProfile', $user);
                    }
                } else {
                    $data['old_password_err'] = "Current Password is incorrect.";
                    $this->view('Pages/CompanyUser/changepassword', $data);
                    $this->view('Pages/CompanyUser/changepassword');
                }
            }
        }
    }
    
    
    public function delete()
    {
        // var_dump($_POST);
        $role = $_SESSION['user_role'];
        if ($role == 'Manager') {
            $role = 'manager';
        } else if ($role == 'Coach') {
            $role = 'coach';
        } else if ($role == 'Owner') {
            $role = 'owner';
        } else if ($role == 'Admin') {
            $role = 'admin';
        } else if ($role == 'User') {
            $role = 'user';
        }
        if ($this->userModel->deleteUser($_POST["submit"])) {
            redirect("Pages/Dashboard/{$role}");
        } else {
            die("Something Went Wrong");
        }

    }

    public function getUserByEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = trim($_POST['email']);

            $user = $this->userModel->getUserByEmail($email);

            header('Content-Type: application/json');
            echo json_encode($user);
            exit();
        }

    }


}


?>
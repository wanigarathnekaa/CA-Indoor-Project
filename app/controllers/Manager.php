<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Manager extends Controller
{
    private $managerModel;
    private $userModel;
    private $userCoachModel;
    private $companyUserModel;
    public function __construct()
    {
        $this->userModel = $this->model('M_Users');
        $this->managerModel = $this->model('M_Manager');
        $this->userCoachModel = $this->model('M_Coach');
        $this->companyUserModel = $this->model('M_CompanyUsers');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //form is submitting

            //Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            //Input data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'nic' => trim($_POST['nic']),
                'strAddress' => trim($_POST['strAddress']),
                'city' => trim($_POST['city']),

                'name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'password_err' => "",
                'nic_err' => "",
                'strAddress_err' => "",
                'city_err' => "",
            ];



            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }elseif (!preg_match("/^[a-zA-Z-' ]*$/", $data['name'])) {
                $data['name_err'] = "Only letters and white space allowed";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            } else {
                $userdata = $this->managerModel->findManager($_SESSION['user_email']);
                if ($data['email'] != $userdata->email) {
                    // check email already registered or not
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "This email is already in use";
                    }
                    if ($this->managerModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "This email is already in use";
                    }
                    if ($this->companyUserModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "This email is already in use";
                    }
                }
                //check the email format is correct or not
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_err'] = "Please enter a valid email";
                }
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }elseif (strlen($data['phoneNumber']) != 10) {
                $data['phoneNumber_err'] = "Please enter a valid phone number";     
            } elseif (!preg_match("/^[0-9]*$/", $data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a valid phone number";
            }

            //validate nic
            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }else{
                $nic = str_replace(' ', '', $data['nic']);
                if (strlen($nic) != 10 && strlen($nic) != 12) {
                    $data['nic_err'] = "NIC format is xxxxxxxxxv or xxxxxxxxxxxx";
                }elseif (!preg_match("/^[0-9]{9}[vV]?$/", $nic) && !preg_match("/^[0-9]{12}?$/", $nic)) {
                    $data['nic_err'] = "NIC number is invalid";
                }
            }

            //validate address
            if (empty($data['strAddress'])) {
                $data['strAddress_err'] = "Please enter the Street Address";
            }elseif(strlen($data['strAddress']) > 100){
                $data['strAddress_err'] = "Street Address is too long";
            }elseif(!preg_match("/^[a-zA-Z0-9\s,.'-]*$/", $data['srtAddress'])){
                $data['strAddress_err'] = "Invalid Street Address";
            }

            //validate city
            if (empty($data['city'])) {
                $data['city_err'] = "Please enter the City";
            }elseif(strlen($data['city']) > 50){
                $data['city_err'] = "City name is too long";
            }elseif(!preg_match("/^[a-zA-Z\s]*$/", $data['city'])){
                $data['city_err'] = "Invalid City name";
            }

            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['phoneNumber_err']) && empty($data['strAddress_err']) && empty($data['city_err'])) {
                //generate random password
                $password=$this->managerModel->generateRandomPassword();

                //check whether the  password is sent to the coach via email
                if($this->managerModel->SendPasswordViaEmail($_POST['email'],$password)){
                    $data['password'] = $password;
                }
                else {        
                    die('Something Went wrong');
                }

                //Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //create user
                if ($this->managerModel->managerRegister($data)) {
                    redirect('Pages/Dashboard/owner');
                } else {
                    die('Something Went wrong');
                }

            } else {
                //Load the view
                echo "Place";
                $this->view('Pages/ManagerRegistration/managerRegistration', $data);
            }
        } else {
            //initial form
            $data = [
                'name' => "",
                'email' => "",
                'phoneNumber' => "",
                'password' => "",
                'nic' => "",
                'strAddress' => "",
                'city' => "",

                'name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'password_err' => "",
                'nic_err' => "",
                'strAddress_err' => "",
                'city_err' => "",
            ];
        }

        //Load the view
        $this->view('Pages/ManagerRegistration/managerRegistration', $data);
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
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'nic' => trim($_POST['nic']),
                'strAddress' => trim($_POST['strAddress']),
                'city' => trim($_POST['city']),
                'filename' => $_FILES['file']['name'],
                'filetmp' => $_FILES['file']['tmp_name'],

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'strAddress_err' => "",
                'city_err' => "",
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
                $existingFilename = $this->managerModel->getExistingImageFilename($data['email']); // Replace $userId with the actual user ID
                $data['filename'] = $existingFilename;
                $data['img'] = $existingFilename;
            }

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }elseif (!preg_match("/^[a-zA-Z-' ]*$/", $data['name'])) {
                $data['name_err'] = "Only letters and white space allowed";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }else {
                $userdata = $this->managerModel->findManager($_SESSION['user_email']);
                if ($data['email'] != $userdata->email) {
                    // check email already registered or not
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "This email is already in use";
                    }
                    if ($this->managerModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "This email is already in use";
                    }
                    if ($this->companyUserModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "This email is already in use";
                    }
                }
                //check the email format is correct or not
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_err'] = "Please enter a valid email";
                }
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            } elseif (strlen($data['phoneNumber']) != 10) {
                $data['phoneNumber_err'] = "Please enter a valid phone number";     
            } elseif (!preg_match("/^[0-9]*$/", $data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a valid phone number";
            }

            // validate nic
            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }else{
                $nic = str_replace(' ', '', $data['nic']);
                if (strlen($nic) != 10 && strlen($nic) != 12) {
                    $data['nic_err'] = "NIC format is xxxxxxxxxv or xxxxxxxxxxxx";
                }elseif (!preg_match("/^[0-9]{9}[vV]?$/", $nic) && !preg_match("/^[0-9]{12}?$/", $nic)) {
                    $data['nic_err'] = "NIC number is invalid";
                }
            }

            //validate address
            if (empty($data['strAddress'])) {
                $data['strAddress_err'] = "Please enter the Street Address";
            }elseif(strlen($data['strAddress']) > 100){
                $data['strAddress_err'] = "Street Address is too long";
            }elseif(!preg_match("/^[a-zA-Z0-9\s,.'-]*$/", $data['strAddress'])){
                $data['strAddress_err'] = "Invalid Street Address";
            }

            if (empty($data['city'])) {
                $data['city_err'] = "Please enter the City";
            }elseif(strlen($data['city']) > 50){
                $data['city_err'] = "City name is too long";
            }elseif(!preg_match("/^[a-zA-Z\s]*$/", $data['city'])){
                $data['city_err'] = "Invalid City name";
            }




            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['phoneNumber_err']) && empty($data['strAddress_err']) && empty($data['city_err'])) {
                //create user
                if ($this->managerModel->updateManager($data)) {
                    redirect('Pages/Manager_Profile/manager');
                } else {
                    die('Something Went wrong');
                }


            } else {
                //Load the view
                $this->view('Pages/Manager/managerEditProfile', $data);
            }
        }
        //Load the view
        $this->view('Pages/Manager/managerEditProfile', $data);
    }
    public function ManagerchangePassword()
    {   
        $user=$this->managerModel->findManager($_SESSION['user_email']) ;
       
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

            // Validate old password
            if(empty($data['oldPassword'])){
                $data['old_password_err'] = "Please enter the current password";
            }

            // Validate new password
            if (empty($data['newPassword'])) {
                $data['new_password_err'] = "Please enter the new password";
            } elseif (strlen($data['newPassword']) < 8) {
                $data['new_password_err'] = "Password must be at least 8 characters";
            }elseif (!preg_match("#[0-9]+#", $data['newPassword'])) {
                $data['new_password_err'] = "Password must include at least one number!";
            } elseif (!preg_match("#[a-zA-Z]+#", $data['newPassword'])) {
                $data['new_password_err'] = "Password must include at least one letter!";
            }elseif (empty($data['confirmPassword'])) {
                $data['confirm_password_err'] = "Please confirm the password";
            } elseif ($data['newPassword'] != $data['confirmPassword']) {
                    $data['confirm_password_err'] = "Passwords do not match";
                    $data['new_password_err'] = "Passwords do not match";
            }

            // Check if all errors are empty
            if (empty($data['oldPassword']) || empty($data['newPassword']) || empty($data['confirmPassword'])) {
                $this->view('Pages/Manager/changepassword', $data);
            } else {
                $hashedPassword = $user->password;
                if (password_verify($data['oldPassword'], $hashedPassword)) {
                    if ($data['oldPassword'] == $data['newPassword']) {
                        $data['new_password_err'] = "Please enter a password different from the old one.";
                        $this->view('Pages/Manager/changepassword', $data);//C:\xampp\htdocs\C&A_Indoor_Project\app\views\Pages\CompanyUser\.php

                    } else if ($data['newPassword'] != $data['confirmPassword']) {
                        $data['confirm_password_err'] = "Passwords do not match. Please try again.";
                        $this->view('Pages/Manager/changepassword', $data);

                    } else {
                        $hashedNewPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                        if($this->managerModel->updateManagerPassword($user->email, $hashedNewPassword)){
                            redirect('Users/logout');
                        } else {
                            die('Something went wrong');
                        }
                    
                    }
                } else {
                    $data['old_password_err'] = "Current Password is incorrect.";
                    $this->view('Pages/Manager/changepassword', $data);
                    $this->view('Pages/Manager/changepassword');
                }
            }
        }else{
            $data = [
                'oldPassword' => "",
                'newPassword' => "",
                'confirmPassword' => "",

                'old_password_err' => "",
                'new_password_err' => "",
                'confirm_password_err' => ""
            ];
        }

        $this->view('Pages/Manager/changepassword', $data);
    }
    public function delete()
    {
        // var_dump($_POST);
        if ($this->managerModel->deleteManager($_POST["submit"])) {
            redirect("Pages/managerTable/owner");
        } else {
            die("Something Went Wrong");
        }

    }
}


?>
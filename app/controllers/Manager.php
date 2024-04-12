<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Manager extends Controller
{
    private $managerModel;
    public function __construct()
    {
        $this->managerModel = $this->model('M_Manager');
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
                'password' => "12345678",
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
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            } else {
                if ($this->managerModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "This email is already in use";
                }
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }

            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }

            //validate address
            if (empty($data['strAddress'])) {
                $data['strAddress_err'] = "Please enter the Street Address";
            }

            if (empty($data['city'])) {
                $data['city_err'] = "Please enter the City";
            }

            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['phoneNumber_err']) && empty($data['strAddress_err']) && empty($data['city_err'])) {
                //generate random password
                $password=$this->managerModel->generateRandomPassword();

                //check whether the  password is sent to the coach via email
                if($this->managerModel->SendPasswordViaEmail($_POST['email'],$password)){
                    $data['pwd'] = $password;
                }
                else {        
                    die('Something Went wrong');
                }

                //Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //create user
                if ($this->managerModel->managerRegister($data)) {
                    echo "<script>alert('Manager Registered Successfully');</script>";
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
                'address' => "",

                'name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'password_err' => "",
                'nic_err' => "",
                'address_err' => ""
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
                // 'pwd' => "12345678",
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
            }

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }

            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter a valid NIC number";
            }

            //validate address
            if (empty($data['strAddress'])) {
                $data['strAddress_err'] = "Please enter the Street Address";
            }

            if (empty($data['city'])) {
                $data['city_err'] = "Please enter the City";
            }




            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['phoneNumber_err']) && empty($data['strAddress_err']) && empty($data['city_err'])) {
                //Hash the password
                // $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

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

    public function delete()
    {
        // var_dump($_POST);
        if ($this->managerModel->deleteManager($_POST["submit"])) {
            redirect("Users/register");
        } else {
            die("Something Went Wrong");
        }

    }
}


?>
<?php
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
                'address' => trim($_POST['address']),

                'name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'password_err' => "",
                'nic_err' => "",
                'address_err' => ""
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            } else {
                // if($this->coachUserModel->findUserByEmail($data['email'])){
                //     $data['email_err'] = "This email is already in use";
                // }
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = "Please enter a password";
            }

            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }

            if (empty($data['address'])) {
                $data['address_err'] = "Please enter the Address";
            }

            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['address_err']) && empty($data['phoneNumber_err']) && empty($data['password_err'])) {
                //Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //create user
                if ($this->managerModel->managerRegister($data)) {
                    redirect('Users/login');
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
                'address' => trim($_POST['address']),
                'pwd' => "12345678",

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'address_err' => "",
            ];

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

            //validate password
            if (empty($data['pwd'])) {
                $data['pwd_err'] = "Please enter a password";
            }

            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter a valid NIC number";
            }

            //validate user_name
            if (empty($data['address'])) {
                $data['address_err'] = "Please enter an user_name";
            }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['address_err'])) {
                //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);
                
                //create user
                if($this->managerModel->updateManager($data)) {
                    redirect('Pages/Manager_Profile/manager');
                }else{
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
        if($this->managerModel->deleteManager($_POST["submit"])) {  
            redirect("Users/register");
        }else{
            die("Something Went Wrong");
        }
        
    }
}


?>
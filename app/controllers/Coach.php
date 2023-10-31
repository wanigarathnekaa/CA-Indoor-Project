<?php
class Coach extends Controller
{
    private $coachModel;
    private $coachUserModel;
    public function __construct()
    {
        $this->coachModel = $this->model('M_Coach');
        $this->coachUserModel = $this->model('M_Users');
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
                'user_name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'pwd' => "12345678",
                'nic' => trim($_POST['nic']),
                'address' => trim($_POST['address']),
                'experience' => trim($_POST['experience']),
                'specialty' => trim($_POST['specialty']),
                'certificate' => trim($_POST['certificate']),

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'address_err' => "",
                'experience_err' => "",
                'specialty_err' => "",
                'certificate_err' => ""
            ];

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
            } else {
                //check email already registered or not
                if ($this->coachUserModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "This email is already in use";
                }
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }

            //validate password
            if (empty($data['pwd'])) {
                $data['pwd_err'] = "Please enter a password";
            }
            // else{
            //     if($data['pwd'] != $data['confirmPwd']){
            //         $data['pwd_err'] = "Not Matching Passwords";
            //     }
            // }

            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }

            if (empty($data['address'])) {
                $data['address_err'] = "Please enter the Address";
            }

            if (empty($data['experience'])) {
                $data['experiences_err'] = "Please enter the Experience";
            }

            if (empty($data['specialty'])) {
                $data['specialty_err'] = "Please enter the Specialty";
            }

            if (empty($data['certificate'])) {
                $data['certificate_err'] = "Please enter certifications";
            }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['address_err'])) {
                //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                //create user
                if ($this->coachModel->coachRegister($data) && $this->coachUserModel->register($data)) {
                    die('Coach registered Successfully');
                } else {
                    die('Something Went wrong');
                }
            } else {
                //Load the view
                $this->view('Pages/CoachRegistration/coachRegistration', $data);
            }
        } else {
            //initial form
            $data = [
                'name' => "",
                'user_name' => "",
                'email' => "",
                'phoneNumber' => "",
                'pwd' => "",
                'nic' => "",
                'address' => "",
                'experience' => "",
                'specialty' => "",
                'certificate' => "",

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'address_err' => "",
                'experience_err' => "",
                'specialty_err' => "",
                'certificate_err' => ""
            ];
        }

        //Load the view
        $this->view('Pages/CoachRegistration/coachRegistration', $data);
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
                'user_name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'pwd' => "12345678",
                'nic' => trim($_POST['nic']),
                'address' => trim($_POST['address']),
                'experience' => trim($_POST['experience']),
                'specialty' => trim($_POST['specialty']),
                'certificate' => trim($_POST['certificate']),

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'address_err' => "",
                'experience_err' => "",
                'specialty_err' => "",
                'certificate_err' => ""
            ];

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

            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }

            if (empty($data['address'])) {
                $data['address_err'] = "Please enter the Address";
            }

            if (empty($data['experience'])) {
                $data['experiences_err'] = "Please enter the Experience";
            }

            if (empty($data['specialty'])) {
                $data['specialty_err'] = "Please enter the Specialty";
            }

            if (empty($data['certificate'])) {
                $data['certificate_err'] = "Please enter certifications";
            }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err']) && empty($data['nic_err']) && empty($data['address_err'])) {
                //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                //create user
                if ($this->coachModel->updateCoach($data) && $this->coachUserModel->updateUser($data)) {
                    die('Coach updated Successfully');
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

    public function delete()
    {
        // var_dump($_POST);
        if($this->coachModel->deleteCoach($_POST["submit"]) && $this->coachUserModel->deleteUser($_POST["submit"])) {
            die("User Deleted Successfully");
            // redirect("Users/register");
        }else{
            die("Something Went Wrong");
        }
        
    }



}


// public function login(){
//     if($_SERVER['REQUEST_METHOD'] == 'POST'){
//         //submitting form
//         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


//         //Input data
//         $data = [
//             'email' => trim($_POST['email']),
//             'pwd' => trim($_POST['pwd']),

//             'email_err' => "",
//             'pwd_err' => "",
//         ];

//         //validate the email
//         if(empty($data['email'])){
//             $data['email_err'] = "Please enter an email";
//         }
//         else{
//             //check email already registered or not
//             if($this->coachModel->findUserByEmail($data['email'])){
//                echo "user is found";
//             }else{
//                 $data['email_err'] = "User Not Found";
//             }
//         }

//         //validate the user
//         if(empty($data['pwd'])){
//             $data['pwd_err'] = "Please enter a password";
//         }

//         //If no error found then login user
//         if(empty($data['email_err']) && empty($data['pwd_err'])){
//             $loginUser = $this->coachModel->login($data['email'], $data['pwd']);

//             if($loginUser){
//                 //Authenticate User
//                 $this->createUserSession($loginUser);
//             }
//             else{
//                 $data['pwd_err'] = "Invalid Password";
//                 // echo $data['pwd_err'];
//                 //Load View
//                 $this->view('Pages/LoginPage/login', $data);
//             }
//         }
//         else{
//             //Load View
//             $this->view('Pages/LoginPage/login', $data);
//         }

//     }
//     else{
//         //initial form
//         $data = [
//             'email' => "",
//             'pwd' => "",

//             'email_err' => "",
//             'pwd_err' => "",
//         ];

//         //Load View
//         $this->view('Pages/LoginPage/login', $data);


//     }

// }

// public function createUserSession($user){
//     $_SESSION['user_id'] = $user->uid;
//     $_SESSION['user_name'] = $user->name;
//     $_SESSION['user_email'] = $user->email;

//     redirect('Pages/Dashboard/user');
// }
// public function logout(){
//     unset($_SESSION['user_id']);
//     unset($_SESSION['user_name']);
//     unset($_SESSION['user_email']);
//     session_destroy();

//     redirect('Users/login');
// }

// public function isloggedin(){
//     if(isset($_SESSION['user_id'])){
//         return true;
//     }else{
//         //echo 'No Session';
//         //redirect('Users/login');
//         return false;
//     }
// }



?>

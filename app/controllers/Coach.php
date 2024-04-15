<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Coach extends Controller
{
    private $coachModel;
    private $coachUserModel;
    public function __construct()
    {
        $this->coachModel = $this->model('M_Coach');
        $this->coachUserModel = $this->model('M_Users');
    }


    // register function.....................................................
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
                // 'pwd' => "12345678",
                'nic' => trim($_POST['nic']),
                'srtAddress' => trim($_POST['srtAddress']),
                'city' => trim($_POST['city']),
                'achivements' => trim($_POST['achivements']),
                'experience' => trim($_POST['experience']),
                'specialty' => trim($_POST['specialty']),
                'certificate' => trim($_POST['certificate']),

                'name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'srtAddress_err' => "",
                'city_err' => "",
                'achivements_err' => "",
                'experience_err' => "",
                'specialty_err' => "",
                'certificate_err' => "",
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
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


            // validate nic
            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }

            // validate address
            if (empty($data['srtAddress'])) {
                $data['srtAddress_err'] = "Please enter the Street Address";
            }

            // validate city
            if (empty($data['city'])) {
                $data['city_err'] = "Please enter the City";
            }

            // validate achivements
            if (empty($data['achivements'])) {
                $data['achivements_err'] = "Please enter your Achievements";
            }

            // validate experience
            if (empty($data['experience'])) {
                $data['experience_err'] = "Please enter the Experience";
            }

            // validate specialty
            if (empty($data['specialty'])) {
                $data['specialty_err'] = "Please enter the Specialty";
            }

            // validate certificate
            if (empty($data['certificate'])) {
                $data['certificate_err'] = "Please enter certifications";
            }

            

            

            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['email_err']) 
            && empty($data['nic_err']) && empty($data['phoneNumber_err']) && empty($data['srtAddress_err'])
            && empty($data['city_err']) && empty($data['achivements_err']) && empty($data['experience_err']) 
            && empty($data['specialty_err']) && empty($data['certificate_err'])){

                //generate random password
                $password=$this->coachModel->generateRandomPassword();

                //check whether the  password is sent to the coach via email
                if($this->coachModel->SendPasswordViaEmail($_POST['email'],$password)){
                    $data['pwd'] = $password;
                }
                else {      
                    die('Something Went wrong');
                }

                // //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);
                
                //create user
                if ($this->coachModel->coachRegister($data) && $this->coachUserModel->register($data)) { 
                    echo "User Registered";
                    redirect('Pages/Dashboard/manager');
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
                'srtAddress' => "",
                'city' => "",
                'achivements' => "",
                'experience' => "",
                'specialty' => "",
                'certificate' => "",

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'srtAddress_err' => "",
                'city_err' => "",
                'achivements_err' => "",
                'experience_err' => "",
                'specialty_err' => "",
                'certificate_err' => "",
            ];
        }

            //Load the view
            $this->view('Pages/CoachRegistration/coachRegistration', $data);
    }



    // edit function.....................................................
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
                'srtAddress' => trim($_POST['srtAddress']),
                'city' => trim($_POST['city']),
                'achivements' => trim($_POST['achivements']),
                'experience' => trim($_POST['experience']),
                'specialty' => trim($_POST['specialty']),
                'certificate' => trim($_POST['certificate']),
                'filename' => trim($_FILES['file']['name']),
                'filetmp' => trim($_FILES['file']['tmp_name']),

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'srtAddress_err' => "",
                'city_err' => "",
                'achivements_err' => "",
                'experience_err' => "",
                'specialty_err' => "",
                'certificate_err' => "",
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
                $existingFilename = $this->coachUserModel->getExistingImageFilename($data['email']); // Replace $userId with the actual user ID
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

            // validate nic
            if (empty($data['nic'])) {
                $data['nic_err'] = "Please enter the NIC number";
            }

            // validate address
            if (empty($data['srtAddress'])) {
                $data['address_err'] = "Please enter the Street Address";
            }

            // validate city
            if (empty($data['city'])) {
                $data['address_err'] = "Please enter the City";
            }

            // validate achivements
            if (empty($data['achivements'])) {
                $data['address_err'] = "Please enter the Achievements of the ";
            }

            // validate experience
            if (empty($data['experience'])) {
                $data['experiences_err'] = "Please enter the Experience";
            }

            // validate specialty
            if (empty($data['specialty'])) {
                $data['specialty_err'] = "Please enter the Specialty";
            }

            // validate certificate
            if (empty($data['certificate'])) {
                $data['certificate_err'] = "Please enter certifications";
            }


            //If validation is completed and no error, then register the user
            if (empty($data['name_err']) && empty($data['user_name_err']) && empty($data['email_err']) && empty($data['nic_err'])) {
                //Hash the password
                $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                //create user
                if ($this->coachModel->updateCoach($data) && $this->coachUserModel->updateUser($data)) {
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





    // delete function.....................................................
    public function delete()
    {
        // var_dump($_POST);
        if ($this->coachModel->deleteCoach($_POST["submit"]) && $this->coachUserModel->deleteUser($_POST["submit"])) {
            redirect("Pages/Dashboard/manager");
        } else {
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
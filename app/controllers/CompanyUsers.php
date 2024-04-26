<?php

class CompanyUsers extends Controller
{
      private $companyUserModel;
        private $userModel;
        private $managerModel;
        private $userCoachModel;
      public function __construct()
      {
            $this->userModel = $this->model('M_Users');
            $this->managerModel = $this->model('M_Manager');
            $this->userCoachModel = $this->model('M_Coach');
            $this->companyUserModel = $this->model('M_CompanyUsers');
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
                        'filename' => $_FILES['file']['name'],
                        'filetmp' => $_FILES['file']['tmp_name'],


                        'name_err' => "",
                        'email_err' => "",
                        'phoneNumber_err' => "",
                        'nic_err' => "",
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
                        $existingFilename = $this->companyUserModel->getExistingImageFilename($data['email']); // Replace $userId with the actual user ID
                        $data['filename'] = $existingFilename;
                        $data['image'] = $existingFilename;
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
                    }else{
                        $userdata = $this->companyUserModel->findUserByEmail($data['email']);
                        if ($userdata->email == $data['email']) {  
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

                  

                  //check if there are no errors
                  if (empty($data['name_err']) && empty($data['email_err']) && empty($data['phoneNumber_err']) && empty($data['nic_err']) && empty($data['img_err'])) {
                        //Hash password
                        // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                        if($this->companyUserModel->editProfile($data)){
                              redirect('Pages/CompanyUser_Profile/<?php echo $role ?>');
                        } else {
                              $this->view('Pages/CompanyUser/CompanyUserEditProfile', $data);
                        }
                  } else {

                        //Load view with errors
                        $this->view('Pages/CompanyUser/CompanyUserEditProfile', $data);
                  }
            }
                  //Load form
                  $this->view('Pages/CompanyUser/CompanyUserEditProfile',$data);
      }




      public function delete()
    {
        // var_dump($_POST);
        if($this->companyUserModel->deleteCompanyUser($_POST["submit"])) {  
            redirect("Users/register");
        }else{
            die("Something Went Wrong");
        }
        
    }

    public function companychangePassword()
    {   
        $user=$this->companyUserModel->findUser($_SESSION['user_email']) ;
       
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
              if(empty($data['newPassword'])){
                  $data['new_password_err'] = "Please enter the new password";
              } elseif(strlen($data['newPassword']) < 8){
                  $data['new_password_err'] = "Password must be at least 8 characters";
              }
  
              // Validate confirm password
              if(empty($data['confirmPassword'])){
                  $data['confirm_password_err'] = "Please confirm the password";
              } elseif($data['newPassword'] != $data['confirmPassword']){
                  $data['confirm_password_err'] = "Passwords do not match";
              }


            if (empty($data['oldPassword']) || empty($data['newPassword']) || empty($data['confirmPassword'])) {
                $this->view('Pages/CompanyUser/changepassword', $data);
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
                        if($this->companyUserModel->updateCompanyUserPassword($user->email, $hashedNewPassword)){
                            redirect('Pages/CompanyUser_Profile/<?php echo $role ?>');
                        } else {
                              die("Something went wrong.");
                        }
                    }
                } else {
                    $data['old_password_err'] = "Current Password is incorrect.";
                    $this->view('Pages/CompanyUser/changepassword', $data);
                  //   $this->view('Pages/CompanyUser/changepassword');
                }
            }
        }else{
            $data = [
                'oldPassword' => '',
                'newPassword' => '',
                'confirmPassword' => '',
                'old_password_err' => '',
                'new_password_err' => '',
                'confirm_password_err' => ''
            ];
        }
       $this->view('Pages/CompanyUser/changepassword', $data);
    }
}


?>
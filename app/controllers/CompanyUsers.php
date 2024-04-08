<?php

class CompanyUsers extends Controller
{
      private $companyUserModel;
      public function __construct()
      {
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
                '       filetmp_err' => "",      
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

                  //validate nic
                  if (empty($data['nic'])) {
                        $data['nic_err'] = "Please enter a NIC";
                  }

                  

                  //check if there are no errors
                  if (empty($data['name_err']) && empty($data['email_err']) && empty($data['phoneNumber_err']) && empty($data['nic_err']) && empty($data['img_err'])) {
                        //Hash password
                        // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                        if($this->companyUserModel->editProfile($data)){
                              redirect('Pages/CompanyUser_Profile/<?php echo $role ?>');
                        } else {
                              die('Something went wrong');
                        }
                  } else {
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
}


?>
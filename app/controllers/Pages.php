<?php
class Pages extends Controller
{
    private $pagesModel;
    public function __construct()
    {
        $this->pagesModel = $this->model('M_Pages');
    }

    public function about()
    {
        $users = $this->pagesModel->getUsers();
        $data = [
            'users' => $users,
        ];

        $this->view('v_about', $data);
    }

    public function Dashboard($name)
    {
        if ($name == "user") {
            $this->view('Pages/Dashboard/user');
        } else if ($name == "admin") {
            $this->view('Pages/Dashboard/admin');
        } else if ($name == "cashier") {
            $this->view('Pages/Dashboard/cashier');
        } else if ($name == "coach") {
            $this->view('Pages/Dashboard/coach');
        } else if ($name == "manager") {
            $this->view('Pages/Dashboard/manager');
        } else if ($name == "owner") {
            $this->view('Pages/Dashboard/owner');
        }
    }

    public function Login($name)
    {
        // $role = $name;
        $this->view('Pages/LoginPage/login');
    }

    public function Register($name)
    {
        // $role = $name;
        $this->view('Pages/RegisterPage/register');
    }

    public function Profile($name)
    {
        $user = $this->pagesModel->findUser($_SESSION['user_email']);

        // print_r($user);
        $this->view('Pages/UserProfiles/userProfile', $user);
    }

    public function editProfile($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);
        $coachAsCoach = $this->pagesModel->findCoach($_SESSION['user_email']);
        $coachAsUser = $this->pagesModel->findUser($_SESSION['user_email']);

        $data = [
            'name' => $coachAsUser->name,
            'user_name' => $coachAsUser->user_name,
            'email' => $_SESSION['user_email'],
            'phoneNumber' => $coachAsUser->phoneNumber,
            'pwd' => $coachAsUser->password,
            'nic' => $coachAsCoach->nic,
            'address' => $coachAsCoach->address,
            'experience' => $coachAsCoach->experience,
            'specialty' => $coachAsCoach->specialty,
            'certificate' => $coachAsCoach->certificate,

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
        // print_r($data);

        $this->view('Pages/UserProfiles/editProfile', $data);
    }

    public function Advertisements($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/advertisement');
    }

    public function AdvertisementDetails($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/advertisementDetails');
    }

    public function Coach($name)
    {
        $coaches = $this->pagesModel->getCoaches();
        $data = [
            'users' => $coaches,
        ];
        $res = [];
        foreach ($data['users'] as $user) {
            $res[] = $this->pagesModel->findUser($user->email);
        }

        $this->view('Pages/Coach/coach', $res);
    }

    public function CoachCard($name)
    {
        $this->view('Pages/Coach/coachCard');
    }

    public function Coach_Advertisements($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/coachAdvertisements');
    }

    public function Add_Advertisements($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/addAdvertisement');
    }

    public function Coach_Registration($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/CoachRegistration/coachRegistration');
    }

    public function Manager_Registration($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/ManagerRegistration/managerRegistration');
    }

    public function Delete_Profile($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/UserProfiles/deleteProfile');
    }
}

?>
<?php
class Pages extends Controller{
    private $pagesModel;
    public function __construct(){
        $this->pagesModel = $this->model('M_Pages');
    }

    public function about(){
        $users = $this->pagesModel->getUsers();
        $data = [
            'users' => $users,
        ];

        $this->view('v_about', $data);
    }

    public function Dashboard($name){
        if($name == "user"){
            $this->view('Pages/Dashboard/user');
        }
        else if($name == "admin"){
            $this->view('Pages/Dashboard/admin');
        }
        else if($name == "cashier"){
            $this->view('Pages/Dashboard/cashier');
        }
        else if($name == "coach"){
            $this->view('Pages/Dashboard/coach');
        }
        else if($name == "manager"){
            $this->view('Pages/Dashboard/manager');
        }
        else if($name == "owner"){
            $this->view('Pages/Dashboard/owner');
        }
    }
    
    public function Login($name){
        // $role = $name;
        $this->view('Pages/LoginPage/login');
    }

    public function Register($name){
        // $role = $name;
        $this->view('Pages/RegisterPage/register');
    }

    public function Profile($name){
        $user = $this->pagesModel->findUser($_SESSION['user_email']);

        // print_r($user);
        $this->view('Pages/UserProfiles/userProfile', $user);
    }

    public function editProfile($name){
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/UserProfiles/editProfile');
    }

    public function Advertisements($name){
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/advertisement');
    }

    public function AdvertisementDetails($name){
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/advertisementDetails');
    }

    public function Coach($name){
        $this->view('Pages/Coach/coach');
    }

    public function CoachCard($name){
        $this->view('Pages/Coach/coachCard');
    }

    public function Coach_Advertisements($name){
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/coachAdvertisements');
    }

    public function Add_Advertisements($name){
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/addAdvertisement');
    }

    public function Coach_Registration($name){
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/CoachRegistration/coachRegistration');
    }

}

?>
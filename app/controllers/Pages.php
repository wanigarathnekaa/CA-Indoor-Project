<?php
class Pages extends Controller
{
    private $pagesModel;
    private $advertiseModel;
    public function __construct()
    {
        $this->pagesModel = $this->model('M_Pages');
        $this->advertiseModel = $this->model('M_Advertisement');
    }

    public function about()
    {
        $users = $this->pagesModel->getUsers();
        $data = [
            'users' => $users,
        ];

        $this->view('v_about', $data);
    }

    public function AboutUs($name)
    {
        $this->view('Pages/AboutUs/aboutUs');
    }


    //booking calender for company
    public function Calendar($name)
    {
        $this->view('Pages/Calendar/calender');
    }

    //booking calender for users(Players, Coaches)
    public function userCalendar($name)
    {
        $this->view('Pages/Calendar/userCalander');
    }

    //booking time slots for company
    public function Booking($name)
    {
        $bookings = $this->pagesModel->getBookings();
        $this->view('Pages/Calendar/booking', $bookings);
    }

    public function Payment($name)
    {
        // echo $_SESSION['user_email'];
        $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);
        $this->view('Pages/Booking/payGateway', $user);
    }

    //booking time slots for users(Players, Coaches)
    public function User_Booking($name)
    {
        $bookings = $this->pagesModel->getBookings();
        $this->view('Pages/Calendar/userBooking', $bookings);
    }

    // daily reservation table for manager, owner
    public function Table($name)
    {
        $bookings = $this->pagesModel->getBookings();
        $this->view('Pages/Tables/dailyReservation', $bookings);
    }

    // personal reservation table for player
    public function Personal_Reservation($name)
    {
        $bookings = $this->pagesModel->getBookings();
        $this->view('Pages/Tables/personal_reservation', $bookings);
    }

    // coach table
    public function coachTable($name)
    {
        $coaches = $this->pagesModel->getCoaches();
        $coach = $this->pagesModel->getCoachCount();
        // $users = $this->pagesModel->getUserCount();
        $data = [
            'CoachCount' => $coach,
            'users' => $coaches,
            // 'UserCount' => $users,
        ];
        $res = [];
        foreach ($data['users'] as $user) {
            $res[] = $this->pagesModel->findUser($user->email);
        }
        $this->view('Pages/Tables/coaches_Table', $data, $res);
    }
    //manager table
    public function managerTable($name)
    {
        $managers = $this->pagesModel->getManagers();
        $manager = $this->pagesModel->getManagerCount();
        // $users = $this->pagesModel->getUserCount();
        $data = [
            'ManagerCount' => $manager,
            'users' => $managers,
            // 'UserCount' => $users,
        ];
        $res = [];
        foreach ($data['users'] as $user) {
            $res[] = $this->pagesModel->findUser($user->email);
        }
        $this->view('Pages/Tables/managers_Table', $data, $res);
    }

    // Player table
    public function playerTable($name)
    {
        $players = $this->pagesModel->getUsers();
        $coaches = $this->pagesModel->getCoaches();
        $users = $this->pagesModel->getUserCount();
        $data = [
            'Coaches' => $coaches,
            'UserCount' => $users,
        ];
        $this->view('Pages/Tables/players_Table', $players, $data);
    }


    //reservation table
    public function reservationTable($name)
    {
        $bookings = $this->pagesModel->getBookings();
        $this->view('Pages/Tables/reservations_Table', $bookings);
    }


    // dashboard
    public function Dashboard($name)
    {
        $bookings = $this->pagesModel->getBookings();
        $coaches = $this->pagesModel->getCoachCount();
        $users = $this->pagesModel->getUserCount();
        $coach = $this->pagesModel->getCoaches();
        $advertisement = $this->pagesModel->getAdvertisement();

        $data = [
            'CoachCount' => $coaches,
            'UserCount' => $users-$coaches,
            'coach' => $coach,
            'Reserve_Count' => count($bookings),
            'advertCount' => count($advertisement),
        ];
        $res = [];
        foreach ($data['coach'] as $user) {
            $res[] = $this->pagesModel->findUser($user->email);
        }

        $data1 = [
            'adverts' => $advertisement,
            'userCoach' => $res,
        ];

        if ($name == "user") {
            $this->view('Pages/Dashboard/user', $data1);
        } else if ($name == "admin") {
            $this->view('Pages/Dashboard/admin', $data1, $bookings);
        } else if ($name == "cashier") {
            $this->view('Pages/Dashboard/cashier');
        } else if ($name == "coach") {
            $this->view('Pages/Dashboard/coach', $data1);
        } else if ($name == "manager") {
            $this->view('Pages/Dashboard/manager', $bookings, $data);
        } else if ($name == "owner") {
            $this->view('Pages/Dashboard/owner');
        }
    }

    //landing page
    public function LandingPage($name)
    {
        $this->view('Pages/LandingPage/landingPage');
    }

    //login page
    public function Login($name)
    {
        // $role = $name;
        $this->view('Pages/LoginPage/login');
    }

    //register page
    public function Register($name)
    {
        // $role = $name;
        $this->view('Pages/RegisterPage/register');
    }

    //reservation register page
    public function Booking_Register($name)
    {
        $coaches = $this->pagesModel->getCoaches();
        $data = [
            'users' => $coaches,
        ];
        $res = [];
        foreach ($data['users'] as $user) {
            $res[] = $this->pagesModel->findUser($user->email);
        }
        $this->view('Pages/Booking/bookingRegistration', $res);
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
        $role = "Users";
        if ($coachAsCoach) {
            $role = "Coach";
            $data = [
                'name' => $coachAsUser->name,
                'user_name' => $coachAsUser->user_name,
                'email' => $_SESSION['user_email'],
                'phoneNumber' => $coachAsUser->phoneNumber,
                'pwd' => $coachAsUser->password,
                'nic' => $coachAsCoach->nic,
                // 'address' => $coachAsCoach->address,
                'experience' => $coachAsCoach->experience,
                'specialty' => $coachAsCoach->specialty,
                'certificate' => $coachAsCoach->certificate,
                'role' => $role,

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
        } else {
            $data = [
                'name' => $coachAsUser->name,
                'user_name' => $coachAsUser->user_name,
                'email' => $_SESSION['user_email'],
                'phoneNumber' => $coachAsUser->phoneNumber,
                'pwd' => $coachAsUser->password,
                'role' => $role,

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
            ];
        }
        // print_r($data);

        $this->view('Pages/UserProfiles/editProfile', $data);
    }

    // add advertisement page
    public function Add_Advertisements($name)
    {
        $role = "User";
        $user = $this->pagesModel->findUser($_SESSION['user_email']);
        $coach = $this->pagesModel->findCoach($_SESSION['user_email']);
        $manager = $this->pagesModel->findManager($_SESSION['user_email']); 
        if($user){
            $role = "User";
        } 
        else if($coach){
            $role = "Coach";
        }
        else if($manager){
            $role = "Manager";
        }
        $data = [
                'role' => $role,
                'email' => $_SESSION['user_email'],
                'title' => "",
                'name' => "",
                'date' => "",
                'content' => "",
                'filename' => "",
                'filetmp' => "",


                'title_err' => "",
                'name_err' => "",
                'date_err' => "",
                'content_err' => "",
                'filename_err' => "",
                'filetmp_err' => "",
            ];

        $this->view('Pages/Advertisement/addAdvertisement', $data);
    }


   

    // view advertisement
    public function View_Advertisement($name)
    {
        $role = "User";
        $user = $this->pagesModel->findUser($_SESSION['user_email']);
        $coach = $this->pagesModel->findCoach($_SESSION['user_email']);
        $manager = $this->pagesModel->findManager($_SESSION['user_email']); 
        if(!empty($user)){
            $role = "User";
        } 
        else if(!empty($coach)){
            $role = "Coach";
        }
        else if(!empty($manager)){
            $role = "Manager";
        }
        $advertisement = $this->pagesModel->getAdvertisement();
        $data = [
            'role' => $role,
            'adverts' => $advertisement,
        ];
        $this->view('Pages/Advertisement/advertisement', $data);
    }

    // public function Advertisements($name)
    // {
    //     $role = "User";
    //     $user = $this->pagesModel->findUser($_SESSION['user_email']);
    //     $coach = $this->pagesModel->findCoach($_SESSION['user_email']);
    //     $manager = $this->pagesModel->findManager($_SESSION['user_email']); 
    //     if(!empty($user)){
    //         $role = "User";
    //     } 
    //     else if(!empty($coach)){
    //         $role = "Coach";
    //     }
    //     else if(!empty($manager)){
    //         $role = "Manager";
    //     }
    //     $advertisement = $this->pagesModel->getAdvertisement();
    //     $data = [
    //         'role' => $role,
    //         'adverts' => $advertisement,
    //     ];

    //     $this->view('Pages/Advertisement/advertisement', $data);
    // }

    public function AdvertisementDetails()
    {
        $flag = 0;
        $advertisement = $this->pagesModel->getAdvertisement();
        $user = $this->pagesModel->findUser($_SESSION['user_email']);
        if(empty($user)){
            $flag = 1;
        } 
        $data = [
            'adverts' => $advertisement,
            'flag' => $flag,
        ];
        $this->view('Pages/Advertisement/advertisementDetails', $data);
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
        $coaches = $this->pagesModel->getCoaches();
        $data = [
            'users' => $coaches,
        ];
        $res = [];
        foreach ($data['users'] as $user) {
            $res[] = $this->pagesModel->findUser($user->email);
        }
        $this->view('Pages/Coach/coachCard', $res, $coaches);
    }

    public function Coach_Advertisements($name)
    {
        // $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Advertisement/coachAdvertisements');
    }


   

    public function Coach_Registration($name)
    {
        $this->view('Pages/CoachRegistration/coachRegistration');
    }

    public function Manager_Registration($name)
    {
        $this->view('Pages/ManagerRegistration/managerRegistration');
    }

    public function Delete_Profile($name)
    {
        $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/UserProfiles/deleteProfile', $user);
    }

    public function Manager_Edit_Profile($name)
    {
        $manager = $this->pagesModel->findManager($_SESSION['user_email']);
        $data = [
            'name' => $manager->name,
            'email' => $_SESSION['user_email'],
            'phoneNumber' => $manager->phoneNumber,
            'pwd' => $manager->password,
            'nic' => $manager->nic,
            'address' => $manager->address,

            'name_err' => "",
            'email_err' => "",
            'phoneNumber_err' => "",
            'nic_err' => "",
            'address_err' => "",
        ];

        $this->view('Pages/Manager/managerEditProfile', $data);
    }

    public function Manager_Profile($name)
    {
        // echo $_SESSION['user_email'];
        $user = $this->pagesModel->findManager($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Manager/managerProfile', $user);
    }

    public function Manager_Delete_Profile($name)
    {
        $user = $this->pagesModel->findManager($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Manager/managerDeleteProfile', $user);
    }

    public function Inventory_Management($name)
    {
        $this->view('Pages/InventoryManagement/dashboard');
    }

    public function Category($name)
    {
        $categories = $this->pagesModel->getCategories();
        $data = [
            'categoryName_err' => "",
            'categories' => $categories,
        ];
        $this->view('Pages/InventoryManagement/category',$data);
    }


    //terms and conditions page
    public function termsConditions()
    {
        $this->view('Components/termsConditions');
    }

    // Contact Us Page
    public function contactUs()
    {
        $this->view('Components/contactUs');
    }

}

?>
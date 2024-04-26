
<?php
class Pages extends Controller
{
    private $pagesModel;
    private $advertiseModel;
    private $userModel;

    public function __construct()
    {
        $this->pagesModel = $this->model('M_Pages');
        $this->userModel = $this->model('M_Users');

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

    public function CoachCalendar($name)
    {
        $this->view('Pages/Calendar/coachAvailability');
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

    public function Manager_Booking($name)
    {
        $bookings = $this->pagesModel->getReservations();
        // $data = [
        //     'bookings' => $bookings,
        // ];
        $this->view('Pages/Calendar/managerBooking', $bookings);
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
        $bookings = $this->pagesModel->getReservations();
        $this->view('Pages/Calendar/userBooking', $bookings);
    }

    // daily reservation table for manager, owner
    public function Table($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $data = [
            'bookings' => $bookings,
        ];
        $this->view('Pages/Tables/dailyReservation', $data);
    }

    // daily reservation table for cashier
    public function Cashier_Table($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $reservations = $this->pagesModel->getBookings();
        $data = [
            'bookings' => $bookings,
            'reservation' => $reservations
        ];
        $this->view('Pages/Tables/cashierReservation', $data);
    }

    // personal reservation table for player
    public function Personal_Reservation($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $data = [
            'bookings' => $bookings,
        ];
        $this->view('Pages/Tables/personal_reservation', $data);
    }

    //personal previous reservation table for player
    public function Personal_Previous_Reservation($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $data = [
            'bookings' => $bookings,
        ];
        $this->view('Pages/Tables/personal_previous_reservation', $data);
    }


    //permanent reservations
    public function Permanent_Reservation($name)
    {
        $permanentBookings = $this->pagesModel->getPermanentBookings();
        $data = [
            'permanentBookings' => $permanentBookings,
        ];
        $this->view('Pages/Tables/permanentReservations', $data);
    }


    //Coaching reservation table for coach
    public function Coaching_Reservation($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $data = [
            'bookings' => $bookings,
        ];
        $this->view('Pages/Tables/coachSession', $data);
    }

    //schedule page for coach,player
    public function userSchedule($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $coach = $this->pagesModel->getCoaches();

        $data = [
            'coach' => $coach,
        ];
        $res = [];
        foreach ($data['coach'] as $user) {
            $res[] = $this->pagesModel->findUser($user->email);
        }

        $data1 = [
            'userCoach' => $res,
            'bookings' => $bookings,
        ];
        $this->view('Pages/SchedulePages/userschedule', $data1);
    }

    //schedule page for company
    public function Schedule($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $permanentBookings = $this->pagesModel->getPermanentBookings();
        $data = [
            'bookings' => $bookings,
            'permanentBookings' => $permanentBookings,
        ];
        $this->view('Pages/SchedulePages/companyschedule', $data);
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
    public function CompanyUserTable($name)
    {
        $CompanyUsers = $this->pagesModel->getCompanyUsers();
        $CompanyUser = $this->pagesModel->getCompanyUserCount();
        // $users = $this->pagesModel->getUserCount();
        $data = [
            'CompanyUserCount' => $CompanyUser,
            'CompanyUsers' => $CompanyUsers,
            // 'UserCount' => $users,
        ];
        $res = [];
        foreach ($data['CompanyUsers'] as $CompanyUsers) {
            $res[] = $this->pagesModel->findUser($CompanyUsers->email);
        }
        $this->view('Pages/Tables/CompanyUser_Table', $data, $res);
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
        $bookings = $this->pagesModel->getReservations();
        $this->view('Pages/Tables/reservations_Table', $bookings);
    }
   

    public function bookingTable($name)
    {
        $bookings = $this->pagesModel->getBookings();
        $this->view('Pages/Tables/booking_table', $bookings);
    }

    public function orderTable($name)
    {
        $order = $this->pagesModel->getOrder();
        $this->view('Pages/Tables/orders_table', $order);
    }

    public function Cancel_Order_Table($name)
    {
        $order = $this->pagesModel->getCancelOrder();
        $this->view('Pages/Tables/cancelOrderTable', $order);
    }
    public function AccountLogTable()
    {
        $logs = $this->pagesModel->getAccLog();
        $data = [
            'logs' => $logs]; 
        $this->view('Pages/Tables/AccountLOG', $data);
    }
    //Report
    public function SalesAmountt(){
        $data = [
            'invoice_date' => '',
            'invoice_due_date' => '',
            'invoice_date_error' => '',
            'invoice_due_date_error' => ''
        ];
        $this->view('Pages/Report/SalesAmount', $data);
    }
        
    public function SalesMonthlyy(){
        $data = [
            'Selected_month' => '',
            'Selected_month_error' => ''
        ];
        $this->view('Pages/Report/bookingreport', $data);
    }
        
    public function OrderReportt(){
        $this->view('Pages/Report/orderReport');}
    public function Userlogss(){
        $this->view('Pages/Report/userlogreport');}
    public function MonthlyOrderReportt(){
        $this->view('Pages/Report/monthlyORDERreport');}    
        
        public function Weekly_Reservationn(){
            $this->view('Pages/Report/Weekly_Reservation');
        }
    // dashboard
    public function Dashboard($name)
    {
        $bookings = $this->pagesModel->getReservations();
        $coaches = $this->pagesModel->getCoachCount();
        $bookingCount = count($this->pagesModel->getBookings());
        $orderCount = count($this->pagesModel->getOrder());
        $cancelOrderCount = count($this->pagesModel->getCancelOrder());
        $users = $this->pagesModel->getUserCount();
        $coach = $this->pagesModel->getActivatedCoaches();
        $advertisement = $this->pagesModel->getAdvertisement();
        $managers = $this->pagesModel->getManagerCount();
        $companyUsers = $this->pagesModel->getCompanyUserCount();
        $bookings = $this->pagesModel->getReservations();
        $logs = $this->pagesModel->getAccLog();
        $reservation = $this->pagesModel->getBookings();
      
        $data = [
            'CoachCount' => $coaches,
            'UserCount' => $users - $coaches,
            'bookingCount' => $bookingCount,
            'orderCount' => $orderCount,
            'cancelOrderCount' => $cancelOrderCount,
            'coach' => $coach,
            'Reserve_Count' => count($bookings),
            'advertCount' => count($advertisement),
            'ManagerCount' => $managers,
            'CompanyUserCount' => $companyUsers,
            'bookings' => $bookings,
            'logs' => $logs,
            'reservation' => $reservation


        ];
        $res = [];
        foreach ($data['coach'] as $user) {
            $res[] = $this->pagesModel->getActivatedUser($user->email);
        }

        $data1 = [
            'adverts' => $advertisement,
            'userCoach' => $res,
            'bookings' => $bookings,
            'logs' => $logs,

        ];

        if ($name == "user") {
            $this->view('Pages/Dashboard/user', $data1);
        } else if ($name == "admin") {
            $this->view('Pages/Dashboard/admin', $data); // Pass all data in a single array
        } else if ($name == "cashier") {

            $this->view('Pages/Dashboard/cashier', $data1, $data);

        } else if ($name == "coach") {
            $this->view('Pages/Dashboard/coach', $data1);
        } else if ($name == "manager") {
            $this->view('Pages/Dashboard/manager',$data);
        } else if ($name == "owner") {
            $this->view('Pages/Dashboard/owner', $data);
        }
    }

    //landing page
    public function LandingPage()
    {
        $advertisement = $this->pagesModel->getAdvertisement();
        $data = [
            'adverts' => $advertisement,
        ];

        $this->view('Pages/LandingPage/landingPage', $data);
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
        $coaches = $this->pagesModel->getActivatedCoaches();
        $data = [
            'users' => $coaches,
        ];
        $this->view('Pages/Booking/bookingRegistration', $coaches);
    }

    public function Permanent_Booking($name)
    {
        $coaches = $this->pagesModel->getActivatedCoaches();
        $permanentBookings = $this->pagesModel->getPermanentBookings();
        $data = [
            'users' => $coaches,
            'permanentBookings' => $permanentBookings,
        ];
        $this->view('Pages/Booking/permanentBookingRegistration', $coaches, $data);
    }

    // user profile for player, coach......................................................................................
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
        $userAsCoach = $this->pagesModel->findCoach($_SESSION['user_email']);
        $userAsUser = $this->pagesModel->findUser($_SESSION['user_email']);
        $role = "Users";
        if ($userAsCoach) {
            $role = "Coach";
            $data = [
                'name' => $userAsUser->name,
                'user_name' => $userAsUser->user_name,
                'email' => $_SESSION['user_email'],
                'phoneNumber' => $userAsUser->phoneNumber,
                'pwd' => $userAsUser->password,
                'srtAddress' => $userAsCoach->srtAddress,
                'city' => $userAsCoach->city,
                'nic' => $userAsCoach->nic,
                'experience' => $userAsCoach->experience,
                'specialty' => $userAsCoach->specialty,
                'certificate' => $userAsCoach->certificate,
                'achivements' => $userAsCoach->achivements,
                'role' => $role,
                'img' => $userAsUser->img,

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'nic_err' => "",
                'srtAddress_err' => "",
                'city_err' => "",
                'experience_err' => "",
                'specialty_err' => "",
                'certificate_err' => "",
                'achivements_err' => "",
                'img_err' => ""
            ];
        } else {
            $data = [
                'name' => $userAsUser->name,
                'user_name' => $userAsUser->user_name,
                'email' => $_SESSION['user_email'],
                'phoneNumber' => $userAsUser->phoneNumber,
                'pwd' => $userAsUser->password,
                'role' => $role,
                'img' => $userAsUser->img,

                'name_err' => "",
                'user_name_err' => "",
                'email_err' => "",
                'phoneNumber_err' => "",
                'img_err' => ""
            ];
        }
        // print_r($data);

        $this->view('Pages/UserProfiles/editProfile', $data);
    }

    public function Delete_Profile($name)
    {
        $user = $this->pagesModel->findUser($_SESSION['user_email']);
        // print_r($user);
        $this->view('Pages/UserProfiles/deleteProfile', $user);
    }

    public function changePassword()
    {
        $data = [
            'oldPassword' => "",
            'newPassword' => "",
            'confirmPassword' => "",
            'old_password_err' => "",
            'new_password_err' => "",
            'confirm_password_err' => "",
        ];
        $this->view('Pages/UserProfiles/changePassword', $data);            
    }
    public function CompanyUserchangePassword()
    {       
        $data = [
            'oldPassword' => "",
            'newPassword' => "",
            'confirmPassword' => "",
            'old_password_err' => "",
            'new_password_err' => "",
            'confirm_password_err' => "",
        ];   
        $this->view('Pages/CompanyUser/changepassword', $data);

        
    }
    public function ManagerchangePassword()
    {      
        $data = [
            'oldPassword' => "",
            'newPassword' => "",
            'confirmPassword' => "",
            'old_password_err' => "",
            'new_password_err' => "",
            'confirm_password_err' => "",
        ];   
        $this->view('Pages/Manager/changepassword', $data);
        
    }


    // add advertisement page
    public function Add_Advertisements($name)
    {
        $role = "User";
        $user = $this->pagesModel->findUser($_SESSION['user_email']);
        $coach = $this->pagesModel->findCoach($_SESSION['user_email']);
        $manager = $this->pagesModel->findManager($_SESSION['user_email']);
        if ($user) {
            $role = "User";
        } else if ($coach) {
            $role = "Coach";
        } else if ($manager) {
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
        if (!empty($user)) {
            $role = "User";
        } else if (!empty($coach)) {
            $role = "Coach";
        } else if (!empty($manager)) {
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
        if (empty($user)) {
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
        $coaches = $this->pagesModel->getActivatedCoaches();
        $data = [
            'users' => $coaches,
        ];
        $res = [];
        foreach ($data['users'] as $user) {
            $res[] = $this->pagesModel->getActivatedUser($user->email);

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
        $data = [
            'name' => "",
            'email' => "",
            'phoneNumber' => "",
            'password' => "",
            'nic' => "",
            'srtAddress' => "",
            'city' => "",
            'experience' => "",
            'specialty' => "",
            'certificate' => "",
            'achivements' => "",

            'name_err' => "",
            'email_err' => "",
            'phoneNumber_err' => "",
            'password_err' => "",
            'nic_err' => "",
            'srtAddress_err' => "",
            'city_err' => "",
            'experience_err' => "",
            'specialty_err' => "",
            'certificate_err' => "",
            'achivements_err' => "",    
        ];
        $this->view('Pages/CoachRegistration/coachRegistration', $data);
    }

    public function Manager_Registration($name)
    {
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
        $this->view('Pages/ManagerRegistration/managerRegistration', $data);
    }

    public function Manager_Profile($name)
    {
        // echo $_SESSION['user_email'];
        $user = $this->pagesModel->findManager($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Manager/managerProfile', $user);
    }

    public function Manager_Edit_Profile($name)
    {
        $manager = $this->pagesModel->findManager($_SESSION['user_email']);
        $data = [
            'name' => $manager->name,
            'email' => $_SESSION['user_email'],
            'phoneNumber' => $manager->phoneNumber,
            // 'pwd' => $manager->password,
            'nic' => $manager->nic,
            'strAddress' => $manager->strAddress,
            'city' => $manager->city,
            'img' => $manager->img,

            'name_err' => "",
            'email_err' => "",
            'phoneNumber_err' => "",
            'nic_err' => "",
            'strAddress_err' => "",
            'city_err' => "",
            'img_err' => ""
        ];

        $this->view('Pages/Manager/managerEditProfile', $data);
    }

    public function Manager_Delete_Profile($name)
    {
        $user = $this->pagesModel->findManager($_SESSION['user_email']);
        // print_r($user);

        $this->view('Pages/Manager/managerDeleteProfile', $user);
    }

    public function CompanyUser_Profile($name)
    {
        $user = $this->pagesModel->findComanyUser($_SESSION['user_email']);
        // print_r($user);
        $this->view('Pages/CompanyUser/companyUserProfile', $user);
    }

    public function CompanyUser_Edit_Profile($name)
    {
        $user = $this->pagesModel->findComanyUser($_SESSION['user_email']);
        // print_r($user);
        $data = [
            'name' => $user->name,
            'email' => $_SESSION['user_email'],
            'phoneNumber' => $user->phoneNumber,
            // 'pwd' => $user->password,
            'nic' => $user->nic,
            'image' => $user->image,

            'name_err' => "",
            'email_err' => "",
            'phoneNumber_err' => "",
            'nic_err' => "",
            'img_err' => ""
        ];
        $this->view('Pages/CompanyUser/CompanyUserEditProfile', $data);
    }

    public function Inventory_Management($name)
    {
        $orders = $this->pagesModel->getOrder();
        $this->view('Pages/InventoryManagement/dashboard', $orders);
    }

    public function Category($name)
    {
        $categories = $this->pagesModel->getCategories();
        $data = [
            'categoryName_err' => "",
            'categories' => $categories,
        ];
        $this->view('Pages/InventoryManagement/category', $data);
    }

    public function Order($name)
    {
        $orders = $this->pagesModel->getOrder();
        $products = $this->pagesModel->getProducts();
        $categories = $this->pagesModel->getCategories();
        $data = [
            'orders' => $orders,
            'products' => $products,
            'categories' => $categories,
        ];
        $this->view('Pages/InventoryManagement/order', $data);
    }

    public function Brand($name)
    {
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $data = [
            'categoryName_err' => "",
            'categories' => $categories,
            'brands' => $brand,
        ];
        $this->view('Pages/InventoryManagement/brand', $data);
    }

    public function Product($name)
    {
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $products = $this->pagesModel->getProducts();
        $data = [
            'categoryName_err' => "",
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
        ];
        $this->view('Pages/InventoryManagement/product', $data);
    }

    public function Cricket_Shop($name)
    {
        $cartItems = $this->pagesModel->getCart($_SESSION['user_email']);
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $products = $this->pagesModel->getProducts();
        $data = [
            'cartItems' => $cartItems,
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
        ];
        $this->view('Pages/CricketShop/crickShop', $data);
    }

    public function Cricket_Item($name)
    {

        $cartItems = $this->pagesModel->getCart($_SESSION['user_email']);
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $products = $this->pagesModel->getProducts();
        $data = [
            'cartItems' => $cartItems,
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
            'name' => $name,
        ];
        $this->view('Pages/CricketShop/cricketItem', $data);
    }

    public function Item_Detail($name)
    {
        $cartItems = $this->pagesModel->getCart($_SESSION['user_email']);
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $products = $this->pagesModel->getProducts();
        $singleProduct = $this->pagesModel->getProductByID($name);
        $data = [
            'cartItems' => $cartItems,
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
            'SProduct' => $singleProduct,
            'name' => $name,
        ];
        $this->view('Pages/CricketShop/itemDetail', $data);
    }

    // Shooping Cart
    public function Cricket_Cart($name)
    {
        $cartItems = $this->pagesModel->getCart($_SESSION['user_email']);
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $products = $this->pagesModel->getProducts();
        $data = [
            'cartItems' => $cartItems,
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
            'name' => $name,
        ];
        $this->view('Pages/CricketShop/cricketCart', $data);
    }

    //checkout page
    public function Checkout($name)
    {
        $cartItems = $this->pagesModel->getCart($_SESSION['user_email']);
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $products = $this->pagesModel->getProducts();
        $data = [
            'cartItems' => $cartItems,
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
            'name' => $name,
        ];
        $this->view('Pages/CricketShop/checkout', $data);
    }



    // orders page
    public function Orders($name)
    {
        $cartItems = $this->pagesModel->getCart($_SESSION['user_email']);
        $categories = $this->pagesModel->getCategories();
        $brand = $this->pagesModel->getBrands();
        $products = $this->pagesModel->getProducts();
        $oders = $this->pagesModel->getOrders($_SESSION['user_id']);




        $data = [
            'cartItems' => $cartItems,
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
            'name' => $name,
            'orders' => $oders,
        ];

        $this->view('Pages/CricketShop/orders', $data);
    }


    //terms and conditions page
    public function termsConditions()
    {
        $this->view('Components/termsConditions');
    }

    // Contact Us Page
    // public function contactUs()
    // {
    //     $this->view('Components/contactUs');
    // }


    public function coachAvailability($name)
    {
        $availability = $this->pagesModel->getCoachAvailability();
        $data = [
            'availability' => $availability,
        ];
        $this->view('Pages/Coach/availabletimes', $data);
    }

}

?>

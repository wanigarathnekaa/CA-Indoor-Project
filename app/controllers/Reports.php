<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Reports extends Controller
{
    private $reportmodel;
    public function __construct()
    {
        $this->reportmodel = $this->model('M_Report');

    }

    // Load the report selection page
    public function SelectReport()
    {    
        $this->view('Pages/Report/reportSelect');
    }

  
    public function SalesAmount(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Input data
            $data = [
                'invoice_date' => trim($_POST['invoice_date']),
                'invoice_due_date' => trim($_POST['invoice_due_date']), 
                
                'invoice_date_error' => '',
                'invoice_due_date_error' => ''
                
            ];  
            
            // Validate start date
            if (empty($data['invoice_date'])) {
                $data['invoice_date_error'] = 'Please enter a start date';
            }elseif($data['invoice_date'] > date('Y-m-d')){
                $data['invoice_date_error'] = 'Start date must be less than or equal to today';
            }

            // Validate end date
            if (empty($data['invoice_due_date'])) {
                $data['invoice_due_date_error'] = 'Please enter an end date';
            }elseif($data['invoice_due_date'] < $data['invoice_date']){
                $data['invoice_due_date_error'] = 'End date must be greater than start date';
            }elseif($data['invoice_due_date'] > date('Y-m-d')){
                $data['invoice_due_date_error'] = 'End date must be less than or equal to today';
            }
            

            if(empty($data['invoice_date_error']) && empty($data['invoice_due_date_error'])){

                if(isset($_POST["download_pdf"])) {
                    $this->reportmodel->filterBookingsAndGeneratePDF($data);}
                else if(isset($_POST["view_pdf"])){
                    $this->reportmodel->filterBookingsAndGeneratePDF1($data);}
                elseif(isset($_POST["filter"])){
                    // Get bookings data
                    $bookings = $this->reportmodel->getBookingDetails($data);
                    $data1 = [
                        'bookings' => $bookings
                    ];
                    $this->view('Pages/Report/SalesAmount', $data,$data1);
                }
            
            }
            else{
                $this->view('Pages/Report/SalesAmount', $data);
            }
        }
            
            
        }

        


    
        public function SalesMonthly() {
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Valid input
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
                // Input data
                $data = [
                    'Selected_month' => trim($_POST['Selected_month']),
                    'report_type' => trim($_POST['report_type']),
                    'Selected_month_error' => '',
                    'report_type_error' => ''
                ];
        
                // Validate selected month
                if (empty($data['Selected_month'])) {
                    $data['Selected_month_error'] = 'Please select a month';
                } elseif ($data['Selected_month'] > date('m')) {
                    $data['Selected_month_error'] = 'Selected month must be less than or equal to current month';
                }
        
                // Validate report type
                if (empty($data['report_type'])) {
                    $data['report_type_error'] = 'Please select a report type';
                }
        
                if (empty($data['Selected_month_error']) && empty($data['report_type_error'])) {
                    // Proceed with processing data based on selected report type
                    if ($data['report_type'] === 'booking') {
                        if (isset($_POST["view_pdf"])) {
                            // Display the reservation chart PDF
                            $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF1($data);
                        } elseif (isset($_POST["download_pdf"])) {
                            $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF($data);
                        } elseif (isset($_POST["filter"])) {
                            // Fetch bookings data based on selected month
                            $bookings = $this->reportmodel->getMonthlyBookingDetails($data);
                            $data1 = ['bookings' => $bookings];
                            $this->view('Pages/Report/bookingreport', $data, $data1);
                        }
                    } elseif ($data['report_type'] === 'order') {
                        if (isset($_POST["view_pdf"])) {
                            // Display the order chart PDF
                            $this->reportmodel->MonthlyOrdersGeneratePDF1($data);
                        } elseif (isset($_POST["download_pdf"])) {
                            $this->reportmodel->displayReservationChart($data);
                        } elseif (isset($_POST["filter"])) {
                            // Fetch orders data based on selected month
                            $bookings = $this->reportmodel->getMonthlyBookingDetails($data);
                            $data1 = ['bookings' => $bookings];
                            $this->view('Pages/Report/bookingreport', $data, $data1);
                        }
                    }
                }
                 else {
                // If it's a GET request (initial load), just load the view
                $this->view('Pages/Report/bookingreport', $data);
            }
        }
    }
        
     

    

    public function OrderReport(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Input data
            $data = [
                'Product' => trim($_POST['Product']),
                'Product_error' => '',

            ];

            // Validate selected month
            if (empty($data['Product'])) {
                $data['Product_error'] = 'Please select a product';
            }
            if(empty($data['Product_error'])){

            if(isset($_POST["download_pdf"])) {
                $this->reportmodel->OrderGeneratePDF($data);}
            else if(isset($_POST["view_pdf"])){
                $this->reportmodel->OrderGeneratePDF1($data);
            }
            $orders = $this->reportmodel->getOrderDetails($data);
                    
            $data1 = [
                'orders' => $orders
            ]; 
            $this->view('Pages/Report/orderReport', $data1, $data);
        }
            else{
                $this->view('Pages/Report/orderReport', $data);
            }
  
            }
        }
    
    
    // public function MonthlyOrderReport(){

    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         // Valid input
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //         $data = [
    //             'Selected_month' => trim($_POST['Selected_month']),

    //             'Selected_month_error' => ''
    //         ];

    //         // Validate selected month
    //         if (empty($data['Selected_month'])) {
    //             $data['Selected_month_error'] = 'Please select a month';
    //         }elseif($data['Selected_month'] > date('m')){
    //             $data['Selected_month_error'] = 'Selected month must be less than or equal to current month';
    //         }

    //         if(empty($data['Selected_month_error'])){
    //             if(isset($_POST["download_pdf"])) {
    //             $this->reportmodel->MonthlyOrdersGeneratePDF($data);}
    //         else if(isset($_POST["view_pdf"])){
    //             $this->reportmodel->MonthlyOrdersGeneratePDF1($data);
    //         }
    //         $monthlyOrders = $this->reportmodel->getMonthlyOrders($data);
                    
    //         $data1 = [
    //             'monthlyOrders' => $monthlyOrders
    //         ];
    //         $this->view('Pages/Report/monthlyORDERreport', $data1);
    //     }
    //         else{
    //             $this->view('Pages/Report/monthlyORDERreport', $data);}

    //         }

            
           
    //     }
    
    public function Userlogs(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'invoice_date' => trim($_POST['invoice_date']),
                'invoice_due_date' => trim($_POST['invoice_due_date']),
                'invoice_date_err' => '',
                'invoice_due_date_err' => '',    
            ];
            if (empty($data['invoice_date'])) {
                $data['invoice_date_error'] = 'Please enter a start date';
            }elseif($data['invoice_date'] > date('Y-m-d')){
                $data['invoice_date_error'] = 'Start date must be less than or equal to today';
            }

            // Validate end date
            if (empty($data['invoice_due_date'])) {
                $data['invoice_due_date_error'] = 'Please enter an end date';
            }elseif($data['invoice_due_date'] < $data['invoice_date']){
                $data['invoice_due_date_error'] = 'End date must be greater than start date';
            }elseif($data['invoice_due_date'] > date('Y-m-d')){
                $data['invoice_due_date_error'] = 'End date must be less than or equal to today';
            }

            if(empty($data['invoice_date_error']) && empty($data['invoice_due_date_error'])){

            if(isset($_POST["download_pdf"])) {
                $this->reportmodel->LogsGeneratePDF($data);}
            else if(isset($_POST["view_pdf"])){
                $this->reportmodel->LogsGeneratePDF1($data);
            }
            $bookings = $this->reportmodel->getUserLogs($data);
            $data1 = [
                'bookings' => $bookings
            ];
            $this->view('Pages/Report/userlogreport', $data1,$data);}
            else{
                $this->view('Pages/Report/userlogreport', $data);}

            }

  
        }
    
    public function Weekly_Reservation() {
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Input data
            $data = [
                'invoice_date' => trim($_POST['invoice_date']),
                'invoice_due_date' => trim($_POST['invoice_due_date']),   
                'report_type' => trim($_POST['report_type']),
                'invoice_date_error' => '',
                'invoice_due_date_error'=>'',
                'report_type_error' => ''
            ];
            // Validate selected month
            if (empty($data['invoice_date'])) {
                $data['invoice_date_error'] = 'Please enter a start date';
            }elseif($data['invoice_date'] > date('Y-m-d')){
                $data['invoice_date_error'] = 'Start date must be less than or equal to today';
            }

            // Validate end date
            if (empty($data['invoice_due_date'])) {
                $data['invoice_due_date_error'] = 'Please enter an end date';
            }elseif($data['invoice_due_date'] < $data['invoice_date']){
                $data['invoice_due_date_error'] = 'End date must be greater than start date';
            }elseif($data['invoice_due_date'] > date('Y-m-d')){
                $data['invoice_due_date_error'] = 'End date must be less than or equal to today';
            }
    
            // Validate report type
            if (empty($data['report_type'])) {
                $data['report_type_error'] = 'Please select a report type';
            }
    
            if (empty($data['invoice_due_date_error']) && empty($data['report_type_error'])&& empty($data['invoice_date_error'])) {
             
            
            if ($data['report_type'] === 'net-Types') {
                if (isset($_POST["view_pdf"])) {
                    // Display the reservation chart
                    $this->reportmodel->displayReservationChart1($data);
                } elseif (isset($_POST["download_pdf"])) {
                    $this->reportmodel->displayReservationChart($data);

            }}
            else if ($data['report_type'] === 'weekly') {
                if (isset($_POST["view_pdf"])) {
                    // Display the reservation chart
                    $this->reportmodel->displayRevenueChart1($data);
                } elseif (isset($_POST["download_pdf"])) {
                    $this->reportmodel->displayRevenueChart($data);
            }} 
            else if ($data['report_type'] === 'timeALO') {
                if (isset($_POST["view_pdf"])) {
                    // Display the reservation chart
                    $this->reportmodel->displayTimeChart1($data);
                } elseif (isset($_POST["download_pdf"])) {
                    $this->reportmodel->displayTimeChart($data);
            }}
        else {
            $this->view('Pages/Report/Weekly_Reservation');
        }}
        else{
            $this->view('Pages/Report/Weekly_Reservation',$data);

        }
    }
    
    
    
    
    }
        }
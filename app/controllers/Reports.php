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

        


    
    public function SalesMonthly(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'Selected_month' => trim($_POST['Selected_month']),

                'Selected_month_error' => ''
            ];

            // Validate selected month
            if (empty($data['Selected_month'])) {
                $data['Selected_month_error'] = 'Please select a month';
            }elseif($data['Selected_month'] > date('m')){
                $data['Selected_month_error'] = 'Selected month must be less than or equal to current month';
            }

            if(empty($data['Selected_month_error'])){
                if(isset($_POST["download_pdf"])) {
                    $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF($data);}
                else if(isset($_POST["view_pdf"])){
                    $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF1($data);
                }elseif(isset($_POST["filter"])){
                    $bookings = $this->reportmodel->getMonthlyBookingDetails($data);
                    $data1 = [
                        'bookings' => $bookings
                    ];
                    $this->view('Pages/Report/bookingreport', $data,$data1);
                }
            }
            else{
                $this->view('Pages/Report/bookingreport', $data);
            }
        }
        
// if(isset($_POST["Filter"])){
//     $this->reportmodel->displayMonthlyFilteredBookings($data);
// }

// if(isset($_POST["download_pdf"])) {
//     $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF($data);

// }



    }

    

    public function OrderReport(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Input data
            $data = [
                'Product' => trim($_POST['Product']),

                'Product_error' => ''
            ];
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
    }
    
        
        // if(isset($_POST["filter"])){
        //     $this->reportmodel->displayFilteredOrders($data);
        // }

        // if(isset($_POST["download_pdf"])) {
        //     $this->reportmodel->OrderGeneratePDF($data);
            
            
        


    
    
    public function MonthlyOrderReport(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'Selected_month' => trim($_POST['Selected_month']),
            ];
            if(isset($_POST["download_pdf"])) {
                $this->reportmodel->MonthlyOrdersGeneratePDF($data);}
            else if(isset($_POST["view_pdf"])){
                $this->reportmodel->MonthlyOrdersGeneratePDF1($data);
            }
            $monthlyOrders = $this->reportmodel->getMonthlyOrders($data);
                    
            // Debugging: Check the bookings data
    
            $data1 = [
                'monthlyOrders' => $monthlyOrders
            ];
            $this->view('Pages/Report/monthlyORDERreport', $data1);

            
           
        }
        
// if(isset($_POST["Filter"])){
//     $this->reportmodel->displayMonthlyFilteredOrders($data);
// }

// if(isset($_POST["download_pdf"])) {
//     $this->reportmodel->MonthlyOrdersGeneratePDF($data);

// }



    }
    public function Userlogs(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'invoice_date' => trim($_POST['invoice_date']),
                'invoice_due_date' => trim($_POST['invoice_due_date']),   
            ];
            if(isset($_POST["download_pdf"])) {
                $this->reportmodel->LogsGeneratePDF($data);}
            else if(isset($_POST["view_pdf"])){
                $this->reportmodel->LogsGeneratePDF1($data);
            }
            $bookings = $this->reportmodel->getUserLogs($data);
            $data1 = [
                'bookings' => $bookings
            ];
            $this->view('Pages/Report/userlogreport', $data1,$data);

  
        }
    }
        // if(isset($_POST["filter"])){

        //     $this->reportmodel->displayLogs($data);
        // }

        // if(isset($_POST["download_pdf"])) {
        //     $this->reportmodel->LogsGeneratePDF($data);
            
            

    

    
    public function Weekly_Reservation() {
        // Load the view for the Weekly Reservation report
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Input data
            $data = [
                'invoice_date' => trim($_POST['invoice_date']),
                'invoice_due_date' => trim($_POST['invoice_due_date']),   
            ];
            // $bookings=$this->reportmodel->getReservationChart($data);}

            // $data1 = [
            //     'bookings' => $bookings
            // ];
        

            
    
            // Check if the report type is "payment-status"
            if ($_POST['report_type'] === 'net-Types') {
                if (isset($_POST["view_pdf"])) {
                    // Display the reservation chart
                    $this->reportmodel->displayReservationChart1($data);
                } elseif (isset($_POST["download_pdf"])) {
                    $this->reportmodel->displayReservationChart($data);

            }}
            else if ($_POST['report_type'] === 'weekly') {
                if (isset($_POST["view_pdf"])) {
                    // Display the reservation chart
                    $this->reportmodel->displayRevenueChart1($data);
                } elseif (isset($_POST["download_pdf"])) {
                    $this->reportmodel->displayRevenueChart($data);
            }
        } else {
            // If the form is not submitted, load the default view
            $this->view('Pages/Report/Weekly_Reservation');
        }
    }
    
    
    
    
    }
        }
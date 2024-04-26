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
                
                if (empty($data['invoice_date'])) {
                    $data['invoice_date_error'] = 'Please enter a start date';
                }

                if (empty($data['invoice_due_date'])) {
                    $data['invoice_due_date_error'] = 'Please enter an end date';
                }
                
                if(isset($_POST["download_pdf"])) {
                    $this->reportmodel->filterBookingsAndGeneratePDF($data);}
                else if(isset($_POST["view_pdf"])){
                    $this->reportmodel->filterBookingsAndGeneratePDF1($data);
                }
        
                // Debugging: Check the data being sent
                else{
                // Get bookings data
                    $bookings = $this->reportmodel->getBookingDetails($data);
            
                    // Debugging: Check the bookings data
            
                    $data1 = [
                        'bookings' => $bookings
                    ];
                    $this->view('Pages/Report/SalesAmount', $data1,$data);
                }
                
            }else{
                $data = [
                    'invoice_date' => '',
                    'invoice_due_date' => '',
                    'invoice_date_error' => '',
                    'invoice_due_date_error' => ''
                ];
                $this->view('Pages/Report/SalesAmount', $data);
            } 
            
            
        }

        


    
    public function SalesMonthly(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'Selected_month' => trim($_POST['Selected_month']),
            ];
            if(isset($_POST["download_pdf"])) {
                $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF($data);}
            else if(isset($_POST["view_pdf"])){
                $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF1($data);
            }
            
            $bookings = $this->reportmodel->getMonthlyBookingDetails($data);
            $data1 = [
                'bookings' => $bookings
            ];
            $this->view('Pages/Report/bookingreport', $data1,$data);
        }
        
// if(isset($_POST["Filter"])){
//     $this->reportmodel->displayMonthlyFilteredBookings($data);
// }

// if(isset($_POST["download_pdf"])) {
//     $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF($data);

// }



    }

    // public function getUserLogs($data){
        
    // $invoice_date = $data['invoice_date'];
    // $invoice_due_date = $data['invoice_due_date'];

    // $this->reportmodel->query("SELECT * FROM userlog WHERE create_date >= :start_date AND create_date <= :end_date");

    // $this->reportmodel->bind(':start_date', $invoice_date);
    // $this->reportmodel->bind(':end_date', $invoice_due_date);
    // return $this->reportmodel->resultSet();}

    public function OrderReport(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Input data
            $data = [
                'Product' => trim($_POST['Product']),
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
            $this->view('Pages/Report/bookingreport', $data1,$data);

  
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
    
            // Check if the report type is "payment-status"
            if ($_POST['report_type'] === 'payment-status') {
                if (isset($_POST["filter"])) {
                    // Display the reservation chart
                    $this->reportmodel->displayReservationChart($data);
                } elseif (isset($_POST["download_pdf"])) {
            }}
            else if ($_POST['report_type'] === 'weekly') {
                if (isset($_POST["filter"])) {
                    // Display the reservation chart
                    $this->reportmodel->displayRevenueChart($data);
                } elseif (isset($_POST["download_pdf"])) {
            }
        } else {
            // If the form is not submitted, load the default view
            $this->view('Pages/Report/Weekly_Reservation');
        }
    }
    
    
    
    
  
    
    
        }}
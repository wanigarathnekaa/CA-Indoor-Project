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

    public function Bookingreport()
                     {
                         
                        $this->view('Pages/Report/bookingreport');
                        

                     }
                     public function SalesAmount(){
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Valid input
                            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                            // Input data
                            $data = [
                                'invoice_date' => trim($_POST['invoice_date']),
                                'invoice_due_date' => trim($_POST['invoice_due_date']),   
                            ];
                    
                            // Debugging: Check the data being sent
                   
                            // Get bookings data
                            $bookings = $this->reportmodel->getBookingDetails($data);
                    
                            // Debugging: Check the bookings data
                    
                            $data1 = [
                                'bookings' => $bookings
                            ];
                            $this->view('Pages/Report/SalesAmountview', $data1);
                        }
                    
                    
        // if(isset($_POST["filter"])){
        //     // $this->view('Pages/Report/SalesAmount', $data1);

        //     $this->reportmodel->displayFilteredBookings($data);
        // }

        // if(isset($_POST["download_pdf"])) {
        //     $this->reportmodel->filterBookingsAndGeneratePDF($data);
            
        }

        // }


    
    public function SalesMonthly(){
        $this->view('Pages/Report/bookingreport');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'Selected_month' => trim($_POST['Selected_month']),
            ];
            
            $bookings = $this->reportmodel->getMonthlyBookingDetails($data);
            $data2 = [
                'bookings' => $bookings
            ];
            $this->view('Pages/Report/bookingreport', $data2);
        }
        
if(isset($_POST["Filter"])){
    $this->reportmodel->displayMonthlyFilteredBookings($data);
}

if(isset($_POST["download_pdf"])) {
    $this->reportmodel->MonthlyfilterBookingsAndGeneratePDF($data);

}



    }



    public function OrderReport(){
        $this->view('Pages/Report/orderReport');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'Product' => trim($_POST['Product']),
            ];
  
            
        }
        
        if(isset($_POST["filter"])){
            $this->reportmodel->displayFilteredOrders($data);
        }

        if(isset($_POST["download_pdf"])) {
            $this->reportmodel->OrderGeneratePDF($data);
            
            

        }


    }
    
    public function MonthlyOrderReport(){
        $this->view('Pages/Report/monthlyORDERreport');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'Selected_month' => trim($_POST['Selected_month']),
            ];
            
           
        }
        
if(isset($_POST["Filter"])){
    $this->reportmodel->displayMonthlyFilteredOrders($data);
}

if(isset($_POST["download_pdf"])) {
    $this->reportmodel->MonthlyOrdersGeneratePDF($data);

}



    }
    public function Userlogs(){
        $this->view('Pages/Report/userlogreport');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'invoice_date' => trim($_POST['invoice_date']),
                'invoice_due_date' => trim($_POST['invoice_due_date']),   
            ];
  
        }
        
        if(isset($_POST["filter"])){

            $this->reportmodel->displayLogs($data);
        }

        if(isset($_POST["download_pdf"])) {
            $this->reportmodel->LogsGeneratePDF($data);
            
            

        }
    }

    
    public function Weekly_Reservation() {
        // Load the view for the Weekly Reservation report
        $this->view('Pages/Report/Weekly_Reservation');
    
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
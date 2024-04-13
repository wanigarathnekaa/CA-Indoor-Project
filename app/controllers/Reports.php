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
        $this->view('Pages/Report/SalesAmount');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'invoice_date' => trim($_POST['invoice_date']),
                'invoice_due_date' => trim($_POST['invoice_due_date']),   
            ];
  
            $bookings = $this->reportmodel->getBookingDetails($data);
            $data1 = [
                'bookings' => $bookings
            ];
            $this->view('Pages/Report/SalesAmount', $data1);
        }
        
        if(isset($_POST["filter"])){
            $this->reportmodel->displayFilteredBookings($data);
        }

        if(isset($_POST["download_pdf"])) {
            $this->reportmodel->filterBookingsAndGeneratePDF($data);
            // $invoice_name=$this->reportmodel->sendemail($data);
            // $this->reportmodel->sendingemail($invoice_name);
            

        }


    }
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

    public function genandsendemail(){
        $this->view('Pages/Report/orderReport');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Input data
            $data = [
                'category' => trim($_POST['category']),
            ];
            
            $orders = $this->reportmodel->getOrderDetails($data);
            $data2 = [
                'orders' => $orders
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
  
    
    
        }
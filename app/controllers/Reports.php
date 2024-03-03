<?php
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
        $this->view('Pages/Report/SalesAmount');


    }


    
        public function bookingDetails(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Valid input
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
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
        }
    }
    
   
    
                   

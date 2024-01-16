<?php
class Bookings extends Controller
{
    private $bookingModel;
    public function __construct()
    {
        $this->bookingModel = $this->model('M_Bookings');

    }

    public function register()
    {
        if (isset($_POST['booking']) == 'POST') {
            //form is submitting

            //Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Input data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'net' => trim($_POST['net']),
                'timeSlot' => trim($_POST['timeSlot']),
                'date' => trim($_POST['date']),
                'coach' => trim($_POST['coach']),
                'phoneNumber' => trim($_POST['phoneNumber']),

                'name_err' => "",
                'email_err' => "",
                'net_err' => "",
                'timeSlot_err' => "",
                'date_err' => "",
                'coach_err' => "",
                'phoneNumber_err' => "",
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }

            //validate user_name
            if (empty($data['net'])) {
                $data['net_err'] = "Please enter the net";
            }
            else if($this->bookingModel->findBooking($data['date'], $data['timeSlot'], $data['net'])){
                $data['net_err'] = "Net has been booked already.";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }

            if (empty($data['name_err']) && empty($data['net_err']) && empty($data['email_err'])) {
                //create user
                if ($this->bookingModel->Booking_Register($data)) {
                    $_SESSION['booking_success'] = true;
                    redirect("Pages/Booking/user?fulldate={$data['date']}");
                } else {
                    die('Something Went wrong');
                }
            } else {
                //Load the view
                // echo '<script>alert("Net has been booked already")</script>'; 
                $this->view('Pages/Booking/bookingRegistration', $data);
            }
        } 
        else {
            //initial form
            $data = [
                'name' => "",
                'email' => "",
                'net' => "",
                'timeSlot' => "",
                'date' => "",
                'coach' => "",
                'phoneNumber' => "",


                'name_err' => "",
                'email_err' => "",
                'net_err' => "",
                'timeSlot_err' => "",
                'date_err' => "",
                'coach_err' => "",
                'phoneNumber_err' => "",

            ];
        }

        //Load the view
        $this->view('Pages/Booking/bookingRegistration', $data);
    }

    public function delete()
    {
        // var_dump($_POST);
        if($this->bookingModel->deleteBooking($_POST["submit"])) {  
            redirect("Pages/reservationTable/user");
        }else{
            die("Something Went Wrong");
        }
        
    }

}

?>
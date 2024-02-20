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
            
            if(isset($_POST['booking_delete_id']) && $_POST['booking_delete_id'] != 0){
                $bookingId = trim($_POST['booking_delete_id']);
                echo $bookingId;
                $this->bookingModel->deleteReservation($bookingId);
            }

            $jsonString = $_POST['timeSlotsAndNetTypes'];

            // Decode the JSON string into an associative array
            $arrayData = json_decode($jsonString, true);

            //Input data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'date' => trim($_POST['date']),
                'coach' => trim($_POST['coach']),

                'name_err' => "",
                'email_err' => "",
                'date_err' => "",
                'phoneNumber_err' => "",
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }

            if (empty($data['name_err']) && empty($data['net_err']) && empty($data['email_err'])) {
                $bookingId = $this->bookingModel->last_inserted_id();
                //create user
                if ($this->bookingModel->Make_Reservation($data)) {
                    $_SESSION['booking_success'] = true;
                    $bookingId = $this->bookingModel->last_inserted_id();
                    foreach ($arrayData as $timeSlotAndNetType) {
                        $timeSlot = $timeSlotAndNetType['timeSlot'];
                        $netType = $timeSlotAndNetType['netType'];
                        $this->bookingModel->addTimeSlots($bookingId, $timeSlot, $netType);
                    }

                    redirect("Pages/Manager_Booking/manager?fulldate={$data['date']}");
                } else {
                    die('Something Went wrong');
                }
            } else {
                //Load the view
                // echo '<script>alert("Net has been booked already")</script>'; 
                $this->view('Pages/Booking/bookingRegistration', $data);
            }
        } else {
            //initial form
            $data = [
                'name' => "",
                'email' => "",
                'phoneNumber' => "",
                'date' => "",
                'coach' => "",
                'timeSlotsAndNetTypes' => "",

                'name_err' => "",
                'email_err' => "",
                'date_err' => "",
                'phoneNumber_err' => "",
            ];
        }

        //Load the view
        $this->view('Pages/Booking/bookingRegistration', $data);
    }

    public function delete()
    {
        // var_dump($_POST);
        if ($this->bookingModel->deleteBooking($_POST["submit"])) {
            redirect("Pages/reservationTable/user");
        } else {
            die("Something Went Wrong");
        }

    }

}

?>
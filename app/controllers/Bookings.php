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

            if (isset($_POST['booking_delete_id']) && $_POST['booking_delete_id'] != 0) {
                $bookingId = trim($_POST['booking_delete_id']);
                echo $bookingId;
                $this->bookingModel->deleteReservation($bookingId);
            }

            $jsonString = $_POST['timeSlotsAndNetTypes'];

            // Decode the JSON string into an associative array
            $arrayData = json_decode($jsonString, true);

            $bookingPrice = $_POST['bookingPrice'];
            $decimalBookingPrice = number_format((float) $bookingPrice, 2, '.', '');

            //Input data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'date' => trim($_POST['date']),
                'coach' => trim($_POST['coach']),
                'bookingPrice' => $decimalBookingPrice,
                'paymentStatus' => 'Not Paid',
                'paidPrice' => 0,

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
            $role = $_SESSION['user_role'];
            if ($role == 'Manager') {
                $role = 'manager';
            } else if ($role == 'Coach') {
                $role = 'coach';
            } else if ($role == 'Owner') {
                $role = 'owner';
            } else if ($role == 'User') {
                $role = 'user';
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

                    redirect("Pages/Manager_Booking/{$role}?fulldate={$data['date']}");
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

    public function BookingRegister()
    {
        // Check if POST data is available
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jsonString = file_get_contents("php://input");
            $postData = json_decode($jsonString, true);

            // Log the received data for debugging
            error_log(print_r($postData, true));

            // Access the data as needed
            $name = isset($postData['name']) ? trim($postData['name']) : '';
            $email = isset($postData['email']) ? trim($postData['email']) : '';
            $phoneNumber = isset($postData['phone']) ? trim($postData['phone']) : '';
            $date = isset($postData['date']) ? trim($postData['date']) : '';
            $coach = isset($postData['coach']) ? trim($postData['coach']) : '';
            $bookingPrice = isset($postData['bookingPrice']) ? trim($postData['bookingPrice']) : '';
            $paymentStatus = isset($postData['paymentStatus']) ? trim($postData['paymentStatus']) : '';
            $paidPrice = isset($postData['paidPrice']) ? trim($postData['paidPrice']) : '';
            $arrayData = json_decode($postData['timeSlots'], true);

            if ($paidPrice == $bookingPrice) {
                $paymentStatus = "Paid";
            } else {
                $paymentStatus = "Pending";
            }


            $data = [
                'name' => $name,
                'email' => $email,
                'phoneNumber' => $phoneNumber,
                'date' => $date,
                'coach' => $coach,
                'bookingPrice' => $bookingPrice,
                'paymentStatus' => $paymentStatus,
                'paidPrice' => $paidPrice,

                'name_err' => "",
                'email_err' => "",
                'date_err' => "",
                'coach_err' => "",
                'phoneNumber_err' => "",
                'bookingPrice_err' => "",
                'paymentStatus_err' => "",
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Payment is Unsuccessful- Name is required";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Payment is Unsuccessful - Email is required";
            }

            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Payment is Unsuccessful - Phone Number is required";
            }

            if (empty($data['date'])) {
                $data['date_err'] = "Payment is Unsuccessful - Date is required";
            }

            if (empty($data['coach'])) {
                $data['coach_err'] = "Payment is Unsuccessful - Coach is required";
            }

            if (empty($data['bookingPrice'])) {
                $data['bookingPrice_err'] = "Payment is Unsuccessful - Booking Price is required";
            }

            if (empty($data['paymentStatus'])) {
                $data['paymentStatus_err'] = "Payment is Unsuccessful - Payment Status is required";
            }

            if (
                empty($data['name_err']) && empty($data['email_err']) && empty($data['date_err'])
                && empty($data['coach_err']) && empty($data['phoneNumber_err'])
                && empty($data['bookingPrice_err']) && empty($data['paymentStatus_err'])
            ) {
                //create user
                if ($this->bookingModel->Make_Reservation($data)) {
                    $_SESSION['booking_success'] = true;
                    $bookingId = $this->bookingModel->last_inserted_id();
                    $_SESSION['booking_id'] = $bookingId;
                    foreach ($arrayData as $timeSlotAndNetType) {
                        $timeSlot = $timeSlotAndNetType['timeSlot'];
                        $netType = $timeSlotAndNetType['netType'];
                        $this->bookingModel->addTimeSlots($bookingId, $timeSlot, $netType);
                    }

                    $response = [
                        'status' => 'success',
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Something went wrong',
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'messageNameError' => $data['name_err'],
                    'messageEmailError' => $data['email_err'],
                    'messageDateError' => $data['date_err'],
                    'messageCoachError' => $data['coach_err'],
                    'messagePhoneNumberError' => $data['phoneNumber_err'],
                    'messageBookingPriceError' => $data['bookingPrice_err'],
                    'messagePaymentStatusError' => $data['paymentStatus_err'],
                ];
            }


            $jsObj = json_encode($response);
            echo $jsObj;
        } else {
            echo "Invalid request method";
        }
    }

    public function SendInvoice($reservationID)
    {
        $this->view('Pages/Report/SalesAmount');


        if (isset($_POST["OKAY"])) {
            // $this->reportmodel->filterBookingsAndGeneratePDF($data);
            $reservation = $this->bookingModel->GetReservInfo($reservationID);
            $invoice_name = $this->bookingModel->sendEmail($reservation);
            $this->bookingModel->sendingemail($invoice_name, $reservation);


        }


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

    public function permanentBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Decode JSON strings to arrays
            $timeSlotsA = json_decode($_POST['timeSlotsA'], true);
            $timeSlotsB = json_decode($_POST['timeSlotsB'], true);
            $timeSlotsM = json_decode($_POST['timeSlotsM'], true);

            // Encode arrays to JSON strings
            $timeSlotsAJson = json_encode($timeSlotsA);
            $timeSlotsBJson = json_encode($timeSlotsB);
            $timeSlotsMJson = json_encode($timeSlotsM);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'date' => trim($_POST['date']),
                'coach' => trim($_POST['coach']),
                'timeDuration' => trim($_POST['timeDuration']),
                'day' => trim($_POST['day']),
                'timeSlotA' => $timeSlotsAJson, // Use JSON string
                'timeSlotB' => $timeSlotsBJson, // Use JSON string
                'timeSlotM' => $timeSlotsMJson, // Use JSON string
            ];

            if ($this->bookingModel->permanentBooking($data)) {
                $response = [
                    'status' => 'success',
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong',
                ];
            }

            $jsObj = json_encode($response);
            echo $jsObj;

        }
    }


    public function cancelReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $booking_Id = trim($_POST['bookingId']);

            if ($this->bookingModel->deleteReservation($booking_Id)) {
                $response = [
                    'status' => 'success',
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong',
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }

}

?>
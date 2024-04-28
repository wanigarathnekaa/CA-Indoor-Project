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

            $admin = $this->bookingModel->getADMINdetails();
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
                'timeSlots' => $jsonString,
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

            //Managing Coach Available Time Slots
            $data1 = [
                'date' => $data['date'],
                'email' => $data['coach'],
                'time_slot' => "",
                'reserved_time_slot' => '',
            ];

            if (!empty($data['coach'])) {
                $time_slots_coach_available = $this->bookingModel->getCoachAvailability($data);
                $array_time_slots = json_decode($time_slots_coach_available[0]->time_slot, true);
                print_r($array_time_slots);
                $ts_array = array();
                for ($i = 0; $i < count($arrayData); $i++) {
                    $ts_array[] = $arrayData[$i]['timeSlot'];
                }
                $resultArray = array_diff($array_time_slots, $ts_array);
                $result = array_values($resultArray);

                if (!empty($result)) {
                    $data1["time_slot"] = json_encode($result);
                    $data1['reserved_time_slot'] = json_encode($ts_array);
                } else {
                    $data1["time_slot"] = NULL;
                    $data1['reserved_time_slot'] = json_encode($ts_array);
                }
                $this->bookingModel->update_coach_availability($data1);
                $this->bookingModel->update_reserved_timeSlots($data1);
            }


            if (empty($data['name_err']) && empty($data['net_err']) && empty($data['email_err'])) {
                $bookingId = $this->bookingModel->last_inserted_id();
                //create user
                if ($this->bookingModel->Make_Reservation($data) && $this->bookingModel->SendEmailToCoach($data, $admin)) {
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

            if ($data['coach'] != "No Coach") {
                $time_slots_coach_available = $this->bookingModel->getCoachAvailability($data);
                $array_time_slots = json_decode($time_slots_coach_available[0]->time_slot, true);
                print_r($array_time_slots);
                $ts_array = array();
                for ($i = 0; $i < count($arrayData); $i++) {
                    $ts_array[] = $arrayData[$i]['timeSlot'];
                }
                $resultArray = array_diff($array_time_slots, $ts_array);
                $result = array_values($resultArray);

                if (!empty($result)) {
                    $data1["time_slot"] = json_encode($result);
                    $data1['reserved_time_slot'] = json_encode($ts_array);
                } else {
                    $data1["time_slot"] = NULL;
                    $data1['reserved_time_slot'] = json_encode($ts_array);
                }
                $this->bookingModel->update_coach_availability($data1);
                $this->bookingModel->update_reserved_timeSlots($data1);
            }

            if (
                empty($data['name_err']) && empty($data['email_err']) && empty($data['date_err'])
                && empty($data['coach_err']) && empty($data['phoneNumber_err'])
                && empty($data['bookingPrice_err']) && empty($data['paymentStatus_err'])
            ) {
                //create reservation
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
    public function sendingInvoice()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $reservationID = trim($_POST['id']);

        $reservation = $this->bookingModel->GetReservInfo($reservationID);
        $invoice_name = $this->bookingModel->sendEmail($reservation);
        if ($this->bookingModel->sendingemail($invoice_name, $reservation)) {
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
            $bookingPrice = count($timeSlotsA) * 1000 + count($timeSlotsB) * 1000 + count($timeSlotsM) * 1500;

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

                'name_err' => "",
                'email_err' => "",
                'date_err' => "",
                'phoneNumber_err' => "",
                'timeDuration_err' => "",
                'day_err' => "",
            ];

            $data1 = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phoneNumber' => $data['phoneNumber'],
                'date' => $data['date'],
                'coach' => $data['coach'],
                'bookingPrice' => $bookingPrice,
                'paymentStatus' => 'Not Paid',
                'paidPrice' => 0,
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }

            //validate date
            if (empty($data['date'])) {
                $data['date_err'] = "Please enter a date";
            }

            //validate phone number
            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = "Please enter a phone number";
            }

            //validate time duration
            if (empty($data['timeDuration'])) {
                $data['timeDuration_err'] = "Please enter a time duration";
            }

            //validate day
            if (empty($data['day'])) {
                $data['day_err'] = "Please enter a day";
            }

            // Calculate the end date based on the start date and time duration
            $startDate = strtotime($data['date']);
            $timeDuration = $data['timeDuration'];

            // Calculate end date based on time duration
            if (strpos($timeDuration, 'Months') !== false) {
                $months = (int) filter_var($timeDuration, FILTER_SANITIZE_NUMBER_INT);
                $endDate = date('Y-m-d', strtotime("+$months months", $startDate));
            }
            $data['endDate'] = $endDate;

            $desiredDay = $data["day"];

            // Get all specified days between start and end date
            $specifiedDays = [];
            $currentDate = $startDate;

            // Find the first occurrence of the desired day
            while (date('l', $currentDate) != $desiredDay && $currentDate <= strtotime($endDate)) {
                $currentDate = strtotime('+1 day', $currentDate);
            }

            // Collect all the specified days
            while ($currentDate <= strtotime($endDate)) {
                $specifiedDays[] = date('Y-m-d', $currentDate);
                $currentDate = strtotime('+7 days', $currentDate);
            }

            // Check if there are no errors
            if (
                empty($data['name_err']) && empty($data['email_err']) && empty($data['date_err'])
                && empty($data['phoneNumber_err']) && empty($data['timeDuration_err']) && empty($data['day_err'])
            ) {
                // Check if the booking is successful
                if ($this->bookingModel->permanentBooking($data)) {
                    foreach ($specifiedDays as $date) {
                        $data1['date'] = $date;
                        if ($this->bookingModel->Make_Reservation($data1)) {
                            $_SESSION['booking_success'] = true;
                            $bookingId = $this->bookingModel->last_inserted_id();
                            foreach ($timeSlotsA as $timeSlot) {
                                $this->bookingModel->addTimeSlots($bookingId, $timeSlot, 'Normal Net A');
                            }
                            foreach ($timeSlotsB as $timeSlot) {
                                $this->bookingModel->addTimeSlots($bookingId, $timeSlot, 'Normal Net B');
                            }
                            foreach ($timeSlotsM as $timeSlot) {
                                $this->bookingModel->addTimeSlots($bookingId, $timeSlot, 'Machine Net');
                            }

                            $response = [
                                'status' => 'success',
                            ];
                        } else {
                            $response = [
                                'status' => 'error',
                                'message' => 'Something went wrong when making reservation',
                            ];
                        }
                    }
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
                    'messagePhoneNumberError' => $data['phoneNumber_err'],
                    'messageTimeDurationError' => $data['timeDuration_err'],
                    'messageDayError' => $data['day_err'],
                ];
            }

            $jsObj = json_encode($response);
            echo $jsObj;

        }
    }

    public function checkBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'date' => trim($_POST['date']),
                'day' => trim($_POST['day']),
                'timeDuration' => trim($_POST['timeDuration']),
            ];

            $result = $this->bookingModel->getPermanentBookings();

            if ($result) {
                $response = [
                    'status' => 'success',
                    'data' => $result,
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No booking found',
                ];
            }

            // header('Content-Type: application/json');
            echo json_encode($response);
            exit();
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

    public function getReservationDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $booking_Id = trim($_POST['id']);

            $result = $this->bookingModel->getReservationDetailsByID($booking_Id);

            if ($result) {
                $response = $result;
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

    public function updateReservation()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $booking_Id = trim($_POST['id']);

        if ($this->bookingModel->updateReservation($booking_Id)) {
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

    public function cancelPermanentReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'pbookingId' => trim($_POST['pId']),
                'date' => trim($_POST['pDate']),
                'timeDuration' => trim($_POST['pTimeDuration']),
                'day' => trim($_POST['pDay']),
                'timeSlotA' => json_decode(html_entity_decode($_POST['timeSlotA']), true),
                'timeSlotB' => json_decode(html_entity_decode($_POST['timeSlotB']), true),
                'timeSlotM' => json_decode(html_entity_decode($_POST['timeSlotM']), true),
            ];

            $startDate = strtotime($data['date']);
            $timeDuration = $data['timeDuration'];

            // Calculate end date based on time duration
            if (strpos($timeDuration, 'Months') !== false) {
                $months = (int) filter_var($timeDuration, FILTER_SANITIZE_NUMBER_INT);
                $endDate = date('Y-m-d', strtotime("+$months months", $startDate));
            }

            $data['endDate'] = $endDate;

            $desiredDay = $data["day"];

            // Get all specified days between start and end date
            $specifiedDays = [];
            $currentDate = strtotime('today');

            // Find the first occurrence of the desired day
            while (date('l', $currentDate) != $desiredDay && $currentDate <= strtotime($endDate)) {
                $currentDate = strtotime('+1 day', $currentDate);
            }

            // Collect all the specified days
            while ($currentDate <= strtotime($endDate)) {
                $specifiedDays[] = date('Y-m-d', $currentDate);
                $currentDate = strtotime('+7 days', $currentDate);
            }

            $flag = 0;

            foreach ($specifiedDays as $date) {
                $netType = '';
                $timeSlot = '';
                if (!empty($data['timeSlotA'])) {
                    $timeSlot = $data['timeSlotA'][0];
                    $netType = 'Normal Net A';
                } else if (!empty($data['timeSlotB'])) {
                    $timeSlot = $data['timeSlotB'][0];
                    $netType = 'Normal Net B';
                } else if (!empty($data['timeSlotM'])) {
                    $timeSlot = $data['timeSlotM'][0];
                    $netType = 'Machine Net';
                }

                $bookingId = $this->bookingModel->getBookingId($date, $netType, $timeSlot);
                if ($this->bookingModel->deleteReservation($bookingId[0]->id)) {
                    $flag = 1;
                } else {
                    $flag = 0;
                    break;
                }

            }

            if ($flag == 1) {
                if ($this->bookingModel->updatePermanentBookingStatus($data['pbookingId'])) {
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
<?php
class Order extends Controller
{
    private $orderModel;
    public function __construct()
    {
        $this->orderModel = $this->model('M_Order');
    }

    public function saveOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "pickup" => trim($_POST['pickup']),
                "payment" => trim($_POST['payment']),
                "fname" => trim($_POST['fname']),
                "email" => trim($_POST['email']),
                "adr" => trim($_POST['adr']),
                "phone" => trim($_POST['phone']),
                "city" => trim($_POST['city']),
                "customerID" => $_SESSION['user_id'], 
                "order_date" => date('Y-m-d H:i:s'),
                "order_status" => "pending",


                "pickup_err" => "",
                "payment_err" => "",
                "fname_err" => "",
                "email_err" => "",
                "adr_err" => "",
                "phone_err" => "",
                "city_err" => ""
            ];

            // Validate Order
            if(empty($data["pickup"])){
                $data["pickup"]="Please Select Pickup Mode";
            }
            if (empty($data['payment'])) {
                $data['payment_err'] = "Please Select a Payment Method";
            }
            if (empty($data['fname'])) {
                $data['fname_err'] = "Please Enter the Full Name";
            }
            if (empty($data['email'])) {
                $data['email_err'] = "Please Enter the Email";
            }
            if (empty($data['adr'])) {
                $data['adr_err'] = "Please Enter the Address";
            }
            if (empty($data['phone'])) {
                $data['phone_err'] = "Please Enter the Phone Number";
            }
            if (empty($data['city'])) {
                $data['city_err'] = "Please Enter the City";
            }

            $response = [];
    
            // If validation is completed and no error, then insert the order
            if (empty($data['pickup_err']) && empty($data['payment_err']) && empty($data['fname_err']) && empty($data['email_err']) 
            && empty($data['adr_err']) && empty($data['phone_err']) && empty($data['city_err'])) {
                if ($this->orderModel->insertOrder($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Order Placed Successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Something went wrong. Please try again'
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Please fill in all the fields',
                    'pickup_err' => $data['pickup_err'],
                    'payment_err' => $data['payment_err'],
                    'fname_err' => $data['fname_err'],
                    'email_err' => $data['email_err'],
                    'adr_err' => $data['adr_err'],
                    'phone_err' => $data['phone_err'],
                    'city_err' => $data['city_err']
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }
}


?>
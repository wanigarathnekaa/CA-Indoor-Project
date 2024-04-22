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
                "price" => trim($_POST['price']), // Total price of the order
                "customerID" => $_SESSION['user_id'],
                "order_date" => date('Y-m-d H:i:s'),
                "order_status" => "Not Complete",
                "payment_status" => "Not Paid",
                "items" => $_POST['items'], // This is an array of items in the cart


                "pickup_err" => "",
                "payment_err" => "",
                "fname_err" => "",
                "email_err" => "",
                "adr_err" => "",
                "phone_err" => "",
                "city_err" => ""
            ];

            $orderItems = $data["items"];
            $orderId = $this->orderModel->last_inserted_id();

            if ($data["pickup"] == "pickup_at_store") {
                $data["adr"] = "Store_Address";
                $data["city"] = "Store_City";
            }

            if ($data["payment"] == "pay_online") {
                $amount = intval($data['price']);
                $merchant_id = "1225484";
                $order_id = $orderId+1;
                $merchant_secret = "MTI0NjM0MDI4NjM5MDE0NzA0NzIxMTU4ODM1OTEwMTE3MDk0NDk4Mw==";
                $currency = "LKR";
                //Calculate the hash using MD5 and concatenate various pieces of data
                $hash = strtoupper(
                    md5(
                        $merchant_id .
                        $order_id .
                        number_format($amount, 2, '.', '') .
                        $currency .
                        strtoupper(md5($merchant_secret))
                    )
                );
                // Create an associative array with payment-related data
                $array = [];
                $array["pickup"] = $data["pickup"];
                $array["payment"] = $data["payment"];
                $array["amount"] = $amount; 
                $array['merchant_id'] = $merchant_id;
                $array['order_id'] = $order_id;
                $array['hash'] = $hash;
                $array['currency'] = $currency;
                $array['first_name'] = $data["fname"];
                $array['last_name'] = $data["fname"];
                $array['email'] = $data['email'];
                $array['phone'] = $data['phone'];
                $array['address'] = $data['adr'];
                $array['city'] = $data['city'];
                $array['items'] = "Order Payment";

                // Convert the array to a JSON string
                $jsObj = json_encode($array);

                // Output the JSON string
                echo $jsObj;
                exit();
            }

            // Validate Order
            if (empty($data["pickup"])) {
                $data["pickup"] = "Please Select Pickup Mode";
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

            //Checking product quantity before placing order
            foreach ($orderItems as $item) {
                $product_id = $item['p_id'];
                $qty = $item['qty'];
                if ($qty > $this->orderModel->getProductQuantity($product_id)) {
                    $response = [
                        'status' => 'error',
                        'message' => 'Product quantity is not available'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }

                if ($this->orderModel->updateQuantity($product_id, $qty)) {
                    continue;
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Something went wrong. Please try again'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }
            }

            // If validation is completed and no error, then insert the order
            if (
                empty($data['pickup_err']) && empty($data['payment_err']) && empty($data['fname_err']) && empty($data['email_err'])
                && empty($data['adr_err']) && empty($data['phone_err']) && empty($data['city_err'])
            ) {
                if ($this->orderModel->insertOrder($data) && $this->orderModel->deleteCart($_SESSION['user_email'])) {

                    $orderId = $this->orderModel->last_inserted_id();
                    foreach ($orderItems as $item) {
                        $product_id = $item['p_id'];
                        $qty = $item['qty'];
                        $price_per_unit = $item['product_price'];
                        $this->orderModel->orderItems($orderId, $product_id, $qty, $price_per_unit);
                    }
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

    public function onlinePaidOrder()
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
                "price" => trim($_POST['price']), // Total price of the order
                "customerID" => $_SESSION['user_id'],
                "order_date" => date('Y-m-d H:i:s'),
                "order_status" => "Not Complete",
                "payment_status" => "Paid",
                "items" => $_POST['items'], // This is an array of items in the cart


                "pickup_err" => "",
                "payment_err" => "",
                "fname_err" => "",
                "email_err" => "",
                "adr_err" => "",
                "phone_err" => "",
                "city_err" => ""
            ];

            $orderItems = $data["items"];

            if ($data["pickup"] == "pickup_at_store") {
                $data["adr"] = "Store_Address";
                $data["city"] = "Store_City";
            }

            // Validate Order
            if (empty($data["pickup"])) {
                $data["pickup"] = "Please Select Pickup Mode";
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

            //Checking product quantity before placing order
            foreach ($orderItems as $item) {
                $product_id = $item['p_id'];
                $qty = $item['qty'];
                if ($qty > $this->orderModel->getProductQuantity($product_id)) {
                    $response = [
                        'status' => 'error',
                        'message' => 'Product quantity is not available'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }

                if ($this->orderModel->updateQuantity($product_id, $qty)) {
                    continue;
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Something went wrong. Please try again'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }
            }

            // If validation is completed and no error, then insert the order
            if (
                empty($data['pickup_err']) && empty($data['payment_err']) && empty($data['fname_err']) && empty($data['email_err'])
                && empty($data['adr_err']) && empty($data['phone_err']) && empty($data['city_err'])
            ) {
                if ($this->orderModel->insertOrder($data) && $this->orderModel->deleteCart($_SESSION['user_email'])) {

                    $orderId = $this->orderModel->last_inserted_id();
                    foreach ($orderItems as $item) {
                        $product_id = $item['p_id'];
                        $qty = $item['qty'];
                        $price_per_unit = $item['product_price'];
                        $this->orderModel->orderItems($orderId, $product_id, $qty, $price_per_unit);
                    }
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

    public function getOrderDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $order_id = $_POST['order_id'];
            $order = $this->orderModel->getOrder($order_id);
            $orderItems = $this->orderModel->getOrderItems($order_id);

            $products = [];
            foreach ($orderItems as $item) {
                $product = $this->orderModel->getProduct($item->product_id);
                $products[] = $product;
            }

            $response = [
                'order' => $order,
                'orderItems' => $orderItems,
                'products' => $products
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }

    public function changeOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $order_id = $_POST['order_id'];
            $new_status = $_POST['new_status'];

            if ($this->orderModel->updateOrderStatus($order_id, $new_status)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Order Status Updated Successfully'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong. Please try again'
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }

    public function changePaymentStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $order_id = $_POST['order_id'];

            if ($this->orderModel->updatePaymentStatus($order_id)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Order Status Updated Successfully'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong. Please try again'
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }
}


?>
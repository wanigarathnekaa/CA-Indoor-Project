<?php
class CricketShop extends Controller
{
    private $shopModel;
    public function __construct()
    {
        $this->shopModel = $this->model('M_CricketShop');
    }

    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'product_id' => trim($_POST['product_id']),
                'email' => trim($_POST['email']),
                'product_title' => trim($_POST['product_title']),
                'product_price' => trim($_POST['product_price']),
                'product_thumbnail' => trim($_POST['product_thumbnail']),
                'qty' => trim($_POST['qty']),
                'totalAmount' => trim($_POST['totalAmount'])
            ];
            if ($this->shopModel->addToCart($data)) {
                $response = [
                    'status' => 'success',
                ];
            } else {
                $response = [
                    'status' => 'error',
                ];
            }

            echo json_encode($response);
            exit;
        }
    }

    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'qty' => trim($_POST['qty']),
                'cart_id' => trim($_POST['cart_id']),
                'product_price' => trim($_POST['product_price']),
                'p_id' => trim($_POST['p_id']),
            ];
            $product = $this->shopModel->getProductByID($data['p_id']);
            if ($data['qty'] > $product->qty) {
                $response = [
                    'status' => 'error',
                    'message' => 'We don\'t have enough stock on hand for the quantity you selected. Please try again.',
                ];
                echo json_encode($response);
                exit;
            }

            $data['total_amount'] = $data['qty'] * $data['product_price'];

            if ($this->shopModel->updateCart($data)) {
                $response = [
                    'status' => 'success',

                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong. Please try again.',
                ];
            }

            echo json_encode($response);
            exit;
        }
    }

    public function removeItem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $cart_id = trim($_POST['cart_id']);
            if ($this->shopModel->deleteCartItem($cart_id)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Item removed from cart',
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong. Please try again.',
                ];
            }

            echo json_encode($response);
            exit;
        }
    }
}
?>
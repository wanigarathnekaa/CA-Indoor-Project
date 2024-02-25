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
}
?>

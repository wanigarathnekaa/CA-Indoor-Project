<?php
class Category extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        $this->categoryModel = $this->model('M_Category');
    }

    public function slugify($text, string $divider = '_')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function saveCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['form_type'] == 'edit') {
                $this->editCategory();
            } else{
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'categoryName' => trim($_POST['categoryName']),
                    'categorySlug' => $this->slugify($_POST['categoryName']),
                    'categoryName_err' => "",
                ];

                // Validate category
                if (empty($data['categoryName'])) {
                    $data['categoryName_err'] = "Please enter a category";
                } else {
                    if ($this->categoryModel->findCategory($data['categoryName'])) {
                        $data['categoryName_err'] = "This category is already exist";
                    }
                }

                // If validation is completed and no error, then register the user
                if (empty($data['categoryName_err'])) {
                    // Create user
                    if ($this->categoryModel->insertCategory($data)) {
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
                    // Load the view
                    $response = [
                        'status' => 'error',
                        'message' => $data['categoryName_err'],
                    ];
                }

                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        }
    }

    public function getCategoryById()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id = trim($_POST['id']);

            $category = $this->categoryModel->getCategoryById($id);

            header('Content-Type: application/json');
            echo json_encode($category);
            exit();
        }
    }


    public function editCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'categoryName' => trim($_POST['categoryName']),
                'categorySlug' => $this->slugify($_POST['categoryName']),
                'categoryId' => trim($_POST['categoryId']),
                'categoryName_err' => "",
            ];

            // Validate category
            if (empty($data['categoryName'])) {
                $data['categoryName_err'] = "Please enter a category";
            } else {
                if ($this->categoryModel->findCategory($data['categoryName'])) {
                    $data['categoryName_err'] = "This category is already exist";
                }
            }

            // If validation is completed and no error, then register the user
            if (empty($data['categoryName_err'])) {
                // Create user
                if ($this->categoryModel->updateCategory($data)) {
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
                // Load the view
                $response = [
                    'status' => 'error',
                    'message' => $data['categoryName_err'],
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

    }

    public function deleteCategory($id)
    {
        $cartItems = $this->categoryModel->getCartItems();
        if ($cartItems) {
            foreach ($cartItems as $cartItem) {
                $product = $this->categoryModel->getProductById($cartItem->p_id);
                if ($product->category_id == $id) {
                    echo "<script>alert('A product from the brand you are trying to delete is in the cart. Please remove it before deleting the brand.');</script>";
                    exit();
                }
            }
        }
        if ($this->categoryModel->deleteCategory($id)) {
            redirect('Pages/Category/manager');
        } else {
            die('Something went wrong');
        }
    }

}


?>
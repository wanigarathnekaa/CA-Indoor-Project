<?php
class Product extends Controller
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = $this->model('M_Product');
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

    public function saveBrand()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['form_type'] == 'edit') {
                $this->editBrand();
            } else{
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'brandName' => trim($_POST['brandName']),
                    'brandSlug' => $this->slugify($_POST['brandName']),
                    'brandCategoryName' => trim($_POST['category_name']),
                    'brandName_err' => "",
                    'brandCategoryName_err' => "",
                ];

                // Validate category
                if (empty($data['brandName'])) {
                    $data['brandName_err'] = "Please enter a brand";
                } else {
                    if ($this->brandModel->findBrand($data['brandName'])) {
                        $data['brandName_err'] = "This brand is already exist";
                    }
                }

                if($data['brandCategoryName'] == "0"){
                    $data['brandCategoryName_err'] = "Please select a category";
                }

                // If validation is completed and no error, then register the user
                if (empty($data['brandName_err']) && empty($data['brandCategoryName_err'])) {
                    if ($this->brandModel->insertBrand($data)) {
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
                        'messageBrandName' => $data['brandName_err'],
                        'messageBrandCategoryName' => $data['brandCategoryName_err'],
                    ];
                }

                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        }
    }

    public function getBrandById()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id = trim($_POST['id']);

            $category = $this->brandModel->getBrandById($id);

            header('Content-Type: application/json');
            echo json_encode($category);
            exit();
        }
    }

    public function getBrandCategoryById()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id = trim($_POST['id']);

            $category = $this->brandModel->getBrandCategoryById($id);

            $output ='<option selected disabled>--Select Your Brand Name--</option>';
            foreach ($category as $cat) {
                $output .= '<option value="' . $cat->brand_category_name . '">' . $cat->brand_name . '</option>';
            }

            $response = [
                'output' => $output,
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }


    public function editBrand()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'brandName' => trim($_POST['brandName']),
                'brandSlug' => $this->slugify($_POST['brandName']),
                'brandCategoryName' => trim($_POST['category_name']),
                'brandId' => trim($_POST['brandId']),
                'brandName_err' => "",
                'brandCategoryName_err' => "",
            ];

            // Validate category
            if (empty($data['brandName'])) {
                $data['brandName_err'] = "Please enter a brand";
            } else {
                if ($this->brandModel->findBrand($data['brandName'])) {
                    $data['brandName_err'] = "This category is already exist";
                }
            }

            if($data['brandCategoryName'] == "0"){
                $data['brandCategoryName_err'] = "Please select a category";
            }

            // If validation is completed and no error, then register the user
            if (empty($data['brandName_err']) && empty($data['brandCategoryName_err'])) {
                // Create user
                if ($this->brandModel->updateBrand($data)) {
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
                    'messageBrandName' => $data['brandName_err'],
                    'messageBrandCategoryName' => $data['brandCategoryName_err'],
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

    }

    public function deleteBrand($id)
    {
        if ($this->brandModel->deleteBrand($id)) {
            redirect('Pages/Brand/manager');
        } else {
            die('Something went wrong');
        }
    }

}


?>
<?php
class Product extends Controller
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = $this->model('M_Product');
    }

    public function saveProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['formType'] == 'edit') {
                //$this->editProduct();
            } else {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'productName' => trim($_POST['productName']),
                    'category_name' => intval(trim($_POST['category_name'])),
                    'brand_name' => intval(trim($_POST['brand_name'])),
                    'regular_price' => trim($_POST['regular_price']),
                    'selling_price' => trim($_POST['selling_price']),
                    'short_description' => trim($_POST['short_description']),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),

                    'productName_err' => "",
                    'category_name_err' => "",
                    'brand_name_err' => "",
                    'regular_price_err' => "",
                    'selling_price_err' => "",
                    'product_thumbnail_err' => "",
                    'short_description_err' => "",
                ];

                // Validate product
                if (empty($data['productName'])) {
                    $data['productName_err'] = "Please enter a Product Name";
                } else {
                    if ($this->productModel->findProduct($data['productName'])) {
                        $data['productName_err'] = "This Product is already exist";
                    }
                }

                if ($data['category_name'] == 0) {
                    $data['category_name_err'] = "Please select a category";
                }
                if ($data['brand_name'] == 0) {
                    $data['brand_name_err'] = "Please select a brand";
                }
                if (empty($data['regular_price'])) {
                    $data['regular_price_err'] = "Please select a Regular Price";
                }
                if (empty($data['selling_price'])) {
                    $data['selling_price_err'] = "Please select a Selling Price";
                }

                if (empty($data['short_description'])) {
                    $data['short_description_err'] = "Enter Description";
                }

                $allowed_types = array('jpg', 'jpeg', 'png');
                $max_size = 5 * 1024 * 1024; // 5MB

                if ($_FILES["product_thumbnail"]["error"] == UPLOAD_ERR_OK) {
                    $data['product_thumbnail'] = trim($_FILES['product_thumbnail']['name']);
                    $data['product_thumbnail_tmp'] = trim($_FILES['product_thumbnail']['tmp_name']);
                    $file_size = $_FILES['product_thumbnail']['size'];
                    $file_extension = strtolower(pathinfo($data['product_thumbnail'], PATHINFO_EXTENSION));

                    if (!in_array($file_extension, $allowed_types)) {
                        $data['product_thumbnail_err'] = "Only jpg, jpeg, png files are allowed";
                    } elseif ($file_size > $max_size) {
                        $data['product_thumbnail_err'] = "File size is too large. Maximum file size is 5MB";
                    } else {
                        $newFileName = date('YmdHis') . '.' . $file_extension;
                        move_uploaded_file($data['product_thumbnail_tmp'], "../public/CricketShop/" . $newFileName);
                        $data['product_thumbnail'] = $newFileName;
                    }
                }else{
                    $data['product_thumbnail_err'] = "Please select a thumbnail";
                }

                // If validation is completed and no error, then register the user
                if (empty($data['productName_err']) && empty($data['category_name_err']) && empty($data['brand_name_err']) && empty($data['regular_price_err']) && empty($data['selling_price_err']) && empty($data['short_description_err']) && empty($data['product_thumbnail_err'])) {
                    if ($this->productModel->insertProduct($data)) {
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
                        'messageProductName' => $data['productName_err'],
                        'messageCategoryName' => $data['category_name_err'],
                        'messageBrandName' => $data['brand_name_err'],
                        'messageRegularPrice' => $data['regular_price_err'],
                        'messageSellingPrice' => $data['selling_price_err'],
                        'messageShortDescription' => $data['short_description_err'],
                        'messageProductThumbnail' => $data['product_thumbnail_err'],
                    ];
                }

                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        }
    }

    // public function getBrandById()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $id = trim($_POST['id']);

    //         $category = $this->brandModel->getBrandById($id);

    //         header('Content-Type: application/json');
    //         echo json_encode($category);
    //         exit();
    //     }
    // }

    // public function getBrandCategoryById()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $id = trim($_POST['id']);

    //         $category = $this->brandModel->getBrandCategoryById($id);

    //         $output ='<option selected disabled>--Select Your Brand Name--</option>';
    //         foreach ($category as $cat) {
    //             $output .= '<option value="' . $cat->brand_category_name . '">' . $cat->brand_name . '</option>';
    //         }

    //         $response = [
    //             'output' => $output,
    //         ];

    //         header('Content-Type: application/json');
    //         echo json_encode($response);
    //         exit();
    //     }
    // }


    // public function editBrand()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'brandName' => trim($_POST['brandName']),
    //             'brandSlug' => $this->slugify($_POST['brandName']),
    //             'brandCategoryName' => trim($_POST['category_name']),
    //             'brandId' => trim($_POST['brandId']),
    //             'brandName_err' => "",
    //             'brandCategoryName_err' => "",
    //         ];

    //         // Validate category
    //         if (empty($data['brandName'])) {
    //             $data['brandName_err'] = "Please enter a brand";
    //         } else {
    //             if ($this->brandModel->findBrand($data['brandName'])) {
    //                 $data['brandName_err'] = "This category is already exist";
    //             }
    //         }

    //         if($data['brandCategoryName'] == "0"){
    //             $data['brandCategoryName_err'] = "Please select a category";
    //         }

    //         // If validation is completed and no error, then register the user
    //         if (empty($data['brandName_err']) && empty($data['brandCategoryName_err'])) {
    //             // Create user
    //             if ($this->brandModel->updateBrand($data)) {
    //                 $response = [
    //                     'status' => 'success',
    //                 ];
    //             } else {
    //                 $response = [
    //                     'status' => 'error',
    //                     'message' => 'Something went wrong',
    //                 ];
    //             }
    //         } else {
    //             // Load the view
    //             $response = [
    //                 'status' => 'error',
    //                 'messageBrandName' => $data['brandName_err'],
    //                 'messageBrandCategoryName' => $data['brandCategoryName_err'],
    //             ];
    //         }

    //         header('Content-Type: application/json');
    //         echo json_encode($response);
    //         exit();
    //     }

    // }

    // public function deleteBrand($id)
    // {
    //     if ($this->brandModel->deleteBrand($id)) {
    //         redirect('Pages/Brand/manager');
    //     } else {
    //         die('Something went wrong');
    //     }
    // }

}


?>
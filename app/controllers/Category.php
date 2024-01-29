<?php
class Category extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        $this->categoryModel = $this->model('M_Category');
    }

    public function saveCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'categoryName' => trim($_POST['categoryName']),
                
                'categoryName_err' => ""
            ];

            //validate category
            if (empty($data['categoryName'])) {
                $data['categoryName_err'] = "Please enter a category";
            }
            // else{
            //     if ($this->categoryModel->findModelByName($data['categoryName'])) {
            //         $data['categoryName_err'] = "This category is already exist";
            //     }
            // }


            //If validation is completed and no error, then register the user
            if (empty($data['categoryName_err']) ) {
                //create user
                if ($this->categoryModel->insertCategory($data)) {
                    redirect('Pages/Category/manager');
                } else {
                    die('Something Went wrong');
                }
            } else {
                //Load the view
                $this->view('Pages/InventoryManagement/category',$data);
            }
        } else {
            //initial form
            $data = [
                'categoryName' => "",
                
                'categoryName_err' => ""
            ];
        }

        //Load the view
        $this->view('Pages/InventoryManagement/category',$data);   
    }

    public function editCategory($id){
        echo $id;
    }

    public function deleteCategory($id){
        echo $id;
    }

    
}


?>
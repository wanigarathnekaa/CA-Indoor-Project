<?php
    class Advertisement extends Controller{
        private $advertiseModel;
        public function __construct(){
            $this->advertiseModel = $this->model('M_Advertisement');
        }

        public function add_Advertisement(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //form is submitting

                //Valid input
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                //Input data
                $data = [
                    'title' => trim($_POST['title']),
                    'description' => trim($_POST['description']),
                    'img' => trim($_POST['img']),

                    'title_err' => "",
                    'description_err' => "",
                    'img_err' => ""
                ];

                //validate name
                if(empty($data['title'])){
                    $data['title_err'] = "Please enter a title";
                }

                //validate user_name
                if(empty($data['description'])){
                    $data['description_err'] = "Please enter the Description";
                }
                
                //validate email
                if(empty($data['img'])){
                    $data['img_err'] = "Please upload the image";
                }
                


                //If validation is completed and no error, then register the user
                if(empty($data['title_err']) && empty($data['description_err']) && empty($data['img_err'])) {
                    //Hash the password
                    $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

                    //create user
                    if($this->advertiseModel->addAdvertisement($data)){
                        die('Advertisement Added Successfully');
                    }
                    else{
                        die('Something Went wrong');
                    }
                }
                else{
                    //Load the view
                    $this->view('Pages/Advertisement/coachAdvertisements', $data);
                }
            }
            else{
                //initial form
                $data = [
                    'title' => "",
                    'description' => "",
                    'img' => "",

                    'title_err' => "",
                    'description_err' => "",
                    'img_err' => ""
                ];
            }

            //Load the view
            $this->view('Pages/Advertisement/coachAdvertisements', $data);;
        }

        
    }


?>
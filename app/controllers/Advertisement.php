<?php
    class Advertisement extends Controller{
        private $advertiseModel;
        public function __construct(){
            $this->advertiseModel = $this->model('M_Advertisement');
        }

        //view advertisement
        public function index(){
            $advertisement = $this->advertiseModel->getAdvertisement();
            $data = [
                'adverts' => $advertisement
            ];
            $this->view('Pages/Advertisement/advertisement', $data);
        }


        // create advertisement
        public function add_Advertisement(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //form is submitting

                //Valid input
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Input data
                $data = [
                    'title' => trim($_POST['title']),
                    'name' => trim($_POST['name']),
                    'date' => trim($_POST['date']),
                    'content' => trim($_POST['content']),
                    'filename' => trim($_FILES['file']['name']),
                    'filetmp' => trim($_FILES['file']['tmp_name']),


                    'title_err' =>"",
                    'name_err' => "",
                    'date_err' => "",
                    'content_err' => "",
                    'filename_err' => "",
                    'filetmp_err' => "",
                ];

                $newfilename = uniqid()."-".$data['filename'];
                move_uploaded_file($data['filetmp'],"../public/uploads/".$newfilename);
                $data['filename'] = $newfilename;

                //validate name
                if(empty($data['name'])){
                    $data['name_err'] = "Please enter a name";
                }

                //validate title
                if(empty($data['title'])){
                    $data['title_err'] = "Please enter a title";
                }

                //validate date
                if(empty($data['date'])){
                    $data['date_err'] = "Please enter the date";
                }

                //validate content
                if(empty($data['content'])){
                    $data['content_err'] = "Please enter the Description";
                }
                
                //validate email
                if(empty($data['filename'])){
                    $data['filename_err'] = "Please upload the image";
                }
                


                //If validation is completed and no error, then register the user
                if(empty($data['title_err']) && empty($data['content_err'])) {
                    if($this->advertiseModel->addAdvertisement($data)){
                        // $this->view('Pages/Advertisement/advertisement');
                        redirect('Advertisement/index');
                    }
                    else{
                        die('Something Went wrong');
                    }
                }
                else{
                    //Load the view
                    $this->view('Pages/Advertisement/addAdvertisement', $data);
                }
            }
            else{
                //initial form
                $data = [
                    'title' => "",
                    'name' => "",
                    'date' => "",
                    'content' => "",
                    'filename' => "",
                    'filetmp' => "",


                    'title_err' =>"",
                    'name_err' => "",
                    'date_err' => "",
                    'content_err' => "",
                    'filename_err' => "",
                    'filetmp_err' => "",
                ];
            }

            //Load the view
            $this->view('Pages/Advertisement/addAdvertisement', $data);
        }


        //view advertisement details
        public function AdvertisementDetails(){
            $advertisement = $this->advertiseModel->getAdvertisement();
            $data = [
                'adverts' => $advertisement
            ];
            $this->view('Pages/Advertisement/advertisementDetails', $data);
        }

       

        


        

        
    }


?>
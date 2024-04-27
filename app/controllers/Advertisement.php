<?php
class Advertisement extends Controller
{
    private $advertiseModel;
    public function __construct()
    {
        $this->advertiseModel = $this->model('M_Advertisement');
    }

    // create advertisement
    public function add_Advertisement()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //form is submitting

            //Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Input data
            $data = [
                'title' => trim($_POST['title']),
                'email' => trim($_POST['email']),
                'content' => trim($_POST['content']),
                'filename' => trim($_FILES['file']['name']),
                'filetmp' => trim($_FILES['file']['tmp_name']),


                'title_err' => "",
                'email_err' => "",
                'content_err' => "",
                'filename_err' => "",
                'filetmp_err' => "",
            ];

            if (!empty($_FILES['file']['name'])) {
                $newfilename = uniqid() . "-" . $data['filename'];
                move_uploaded_file($data['filetmp'], "../public/uploads/" . $newfilename);
                $data['filename'] = $newfilename;
            } else {
                $data['filename'] = "";
                $data['filename_err'] = "Please upload the image";
            }
            

            //validate title
            if (empty($data['title'])) {
                $data['title_err'] = "Please enter a title";
            }

                     

            //validate content
            if (empty($data['content'])) {
                $data['content_err'] = "Please enter the Description";
            }



            //If validation is completed and no error, then register the user
            if (empty($data['title_err']) && empty($data['content_err'])&& empty($data['filename_err'])) {
                if ($this->advertiseModel->addAdvertisement($data)) {
                    // $this->view('Pages/Advertisement/advertisement');
                    redirect('Pages/View_Advertisement/advertisement');
                } else {
                    die('Something Went wrong');
                }
            } else {
                //Load the view
                $this->view('Pages/Advertisement/addAdvertisement', $data);
            }
        } else {
            //initial form
            $data = [
                'title' => "",
                'email' => "",
                'content' => "",
                'filename' => "",
                'filetmp' => "",


                'title_err' => "",
                'email_err' => "",
                'content_err' => "",
                'filename_err' => "",
                'filetmp_err' => "",
            ];
        }

        //Load the view
        $this->view('Pages/Advertisement/addAdvertisement', $data);
    }


    // delete advertisement
    public function deleteAdvertisement($advertisement_id){

        if ($this->advertiseModel->deleteAdvertisement($advertisement_id)) {
            redirect('Pages/View_Advertisement/advertisement');
        } else {
            die('Something Went wrong');
        }
    }



    // edit advertisement
    public function editAdvertisement($advertisement_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //form is submitting

            //Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Input data
            $data = [
                'advertisement_id' => $advertisement_id,
                'title' => trim($_POST['title']),
                'email' => trim($_POST['email']),
                'content' => trim($_POST['content']),
                'filename' => trim($_FILES['file']['name']),
                'filetmp' => trim($_FILES['file']['tmp_name']),

                'title_err' => "",
                'email_err' => "",
                'content_err' => "",
                'filename_err' => "",
                'filetmp_err' => "",
            ];

            if (!empty($_FILES['file']['name'])) {
                $newfilename = uniqid() . "-" . $data['filename'];
                move_uploaded_file($data['filetmp'], "../public/uploads/" . $newfilename);
                $data['filename'] = $newfilename;
            } else {
                $existingFilename = $this->advertiseModel->getExistingImageFilename($advertisement_id);
                $data['filename'] = $existingFilename;
                $data['img'] = $existingFilename;
            }

            

            //validate title
            if (empty($data['title'])) {
                $data['title_err'] = "Please enter a title";
            }

            //validate content
            if (empty($data['content'])) {
                $data['content_err'] = "Please enter the Description";
            }

           


            if (empty($data['title_err']) && empty($data['content_err']) && empty($data['date_err']) && empty($data['name_err'])) {
                if ($this->advertiseModel->editAdvertisement($data)) {
                    redirect('Pages/View_Advertisement/advertisement');
                } else {
                    die('Something Went wrong');
                }
            } else {
                //Load the view
                $this->view('Pages/Advertisement/editAdvertisement', $data);
            }

        }
        else{
            $advertisement = $this->advertiseModel->getAdvertisementById($advertisement_id);
            $data = [
                'advertisement_id' => $advertisement_id,
                'title' => $advertisement->title,
                'email' => $advertisement->email,
                'content' => $advertisement->content,
                'filename' => $advertisement->img,
                'filetmp' => "",

                'title_err' => "",
                'email_err' => "",
                'content_err' => "",
                'filename_err' => "",
                'filetmp_err' => "",
            ];

            //Load the view
            $this->view('Pages/Advertisement/editAdvertisement', $data);
        }
    }





}

?>
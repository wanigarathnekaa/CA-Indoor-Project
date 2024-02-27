<?php
class Reports extends Controller
{
    private $reportmodel;
    public function __construct()
    {
        $this->reportmodel = $this->model('M_Report');

    }
    public function view1()
                     {
                         $usernames = $this->reportmodel->getUsernames();
                         $reservations = $this->reportmodel->getReservations();

                         
                         $data = [
                             'usernames' => $usernames,
                             'reservations'=>$reservations
                         ];
                         $this->view('Pages/Report/report1',$data);
                        

                     }
                     public function view2()
                     {
                         
                         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            //form is submitting
                
                            //Valid input
                            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
                
                
                            //Input data
                            $data = [
                                'date' => trim($_POST['date']),
                                'user_name' => trim($_POST['user_name']),
                                
                
                                'date_err' => "",
                                'user_name_err' => "",
                               
                            ];
                
                            
                
                            //If validation is completed and no error, then register the user
                            if (empty($data['date_err']) && empty($data['user_name_err'])) {
                               
                                //create user
                                $userReservatoons=$this->reportmodel->getUserAndReservationData($data);
                                $data1 = [
                                    'userReservatoons' => $userReservatoons                                ];
                                $this->view('Pages/Report/report1',$data1); 
                            } else {
                                //Load the view
                                $this->view('Pages/Report/report1',$data); 
                            }
                        } else {
                            //initial form
                            $data = [
                                'date' => "",
                                'user_name' => "",
                                
                
                                'date_err' => "",
                                'user_name_err' => ""
                              
                            ];
                        }
                
                        //Load the view
                        $this->view('Pages/Report/report1',$data); 

                     }
}
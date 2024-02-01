<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
class Complaint extends Controller{
    private $complaintModel;
    public function __construct(){
        $this->complaintModel=$this->model('M_Complaint');

    }
   
    public function create(){
         if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
            //input data
            $data=[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'message'=>trim($_POST['message']),

                

             

                'name_err'=>'',
                'email_err'=>'',
                'message_err'=>''

            ];
               
            if(empty($data['name'])) {
                $data['name_err']='Please enter the name';
            }
            
            if(empty($data['email'])) {
                $data['email_err']='Please enter the email';
            }
            if(empty($data['message'])) {
                $data['message_err']='Please enter the message';
            }
            if(empty($data['name_err']) && empty($data['email_err'])&&empty($data['message_err'])){
                if($this->complaintModel->create($data)){
                    // flash('complaint_created');
                    redirect('Pages/Dashboard/user');
                }
                else{
                    die('Somthing went wrong');
                }
            }
            else{
                //load view
                $this->view('Components/contactUs',$data);
                       
            }
          }
          else{
                      $data=[
                          'name'=>'',
                          'email'=>'',
                          'message'=>'',
                            
            
                             'name_err'=>'',
                             'email_err'=>'',
                             'message_err'=>''
                            
            
                         ];
                         //load view
                         $this->view('Components/contactUs',$data);
                       
                     }}


                    //  view complaints
                     public function viewComplaints()
                     {
                         $complaints = $this->complaintModel->getComplaints();
                         
                         $data = [
                             'complaints' => $complaints
                         ];
                         $this->view('Pages/Complaint/view_complaint', $data);
                     }
                     public function ComplaintDetails($complaintId)
                     {
                         $complaint = $this->complaintModel->getComplaintById($complaintId);
                         
                         $data = [
                            'complaint' => $complaint,
                         ];
                         $this->view('Pages/Complaint/complaintDetails', $data);
                     }
// Function to send email with password
    public function sendEmail($complaintId)
    {
        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';
        if (isset($_POST["send"])) {

        $mail = new PHPMailer(true);

        $email=$this->complaintModel->getComplaintEmailById($complaintId);

 
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nivodya2001@gmail.com';
            $mail->Password = 'ndvpqhmangzegxhn';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            
            //Recipients
            $mail->setFrom('nivodya2001@gmail.com', 'Hasini Hewa');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'About your complaint';
            $mail->Body    = $_POST["message"];
            $mail->send();

            redirect('Pages/Dashboard/admin');


            if ($mail->send()) {
                if($this->complaintModel->delete($complaintId)){
                    redirect('Pages/Dashboard/admin');

                }
                else{
                    die('somthing wrong');
                }                



                
            } else {
                // Handle email sending failure
                echo 'Email could not be sent.';
            }
        } 

    }}
                         

?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Complaint extends Controller
{
    private $complaintModel;
    public function __construct()
    {
        $this->complaintModel = $this->model('M_Complaint');

    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //input data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'message' => trim($_POST['message']),
                'is_replied'=>0,

                'name_err' => '',
                'email_err' => '',
                'message_err' => ''

            ];

            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter the name';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter the email';
            }
            if (empty($data['message'])) {
                $data['message_err'] = 'Please enter the message';
            }
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['message_err'])) {
                if ($this->complaintModel->create($data)) {
                    // flash('complaint_created');
                    redirect('Pages/Dashboard/user');
                } else {
                    die('Somthing went wrong');
                }
            } else {
                //load view
                $this->view('Components/contactUs', $data);

            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'message' => '',


                'name_err' => '',
                'email_err' => '',
                'message_err' => ''


            ];
            //load view
            $this->view('Components/contactUs', $data);

        }
    }


    //  view complaints
    public function viewComplaints()
    {
        $complaints = $this->complaintModel->getComplaintsWithoutReplies();
        $allComplaints = $this->complaintModel->getComplaints();

        // Get user image
        foreach ($complaints as $complaint) {
            $image = $this->complaintModel->getUserImg($complaint->user_id);
            $complaint->img = $image;
        }

        $data = [
            'complaints' => $complaints,
            'allComplaints' => $allComplaints,
            'image' => $image,
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
    public function SendMessage()
    {

        $this->view('Pages/Complaint/SendMessage');//C:\xampp\htdocs\C&A_Indoor_Project\app\views\Pages\Complaint\SendMessage.php
    }

    






    // Function to send email with password
    public function sendEmail($complaintId)
    {
        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';
    
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Valid input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            // Input data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),   
                'message1' => trim($_POST['message1']),
                'message' => trim($_POST['message']),
        
                'name_error' => '',
                'email_error' => '',
                'message1_error' => '',
                'message_error' => ''
            ];
        
            // Validate input
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter a name';
            }
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter an email';
            }
            if (empty($data['message1'])) {
                $data['message1_error'] = 'Please enter a message';
            }
            if (empty($data['message'])) {
                $data['message_error'] = 'Please enter a reply';
            }
        
            // Fetch complaint details
            $complaint = $this->complaintModel->getComplaintById($complaintId);
        
            // Check if complaint exists
            if ($complaint) {
                // Add complaint details to data array
                $data['complaint'] = $complaint;
        
                // Proceed if there are no errors
                if (empty($data['name_error']) && empty($data['email_error']) && empty($data['message1_error']) && empty($data['message_error'])) {
                    if (isset($_POST["send"])) {
                        // Create PHPMailer instance
                        $mail = new PHPMailer(true);
        
                        // Fetch email of the complaint
                        $email = $this->complaintModel->getComplaintEmailById($complaintId);
        
                        // Server settings
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'nivodya2001@gmail.com';
                        $mail->Password = 'wupbxphjicpfidgj';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
        
                        // Sender and recipient
                        $mail->setFrom('nivodya2001@gmail.com', 'Hasini Hewa');
                        $mail->addAddress($email);
        
                        // Email content
                        $mail->isHTML(true);
                        $mail->Subject = 'About your complaint';
                        $mail->Body = $data['message']; // Use the reply message from the form
        
                        try {
                            // Attempt to send email
                            $mail->send();
                            // Update complaint status
                            if ($this->complaintModel->updateComplaint($complaintId)) {
                                redirect('Complaint/viewComplaints');
                            } else {
                                die('Something went wrong.');
                            }
                        } catch (Exception $e) {
                            // Handle email sending exception
                            echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;
                        }
                    }
                } else {
                    // Display form with error messages
                    $this->view('Pages/Complaint/complaintDetails', $data);
                }
            } else {
                // Complaint not found
                echo 'Complaint not found.';
            }
        }
        
    }
    


    public function sendMsgEmail()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $name = $_POST['name'];
        $message = $_POST['message'];
        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nivodya2001@gmail.com';
        $mail->Password = 'wupbxphjicpfidgj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('nivodya2001@gmail.com', 'Hasini Hewa');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'About your complaint';
        $mail->Body = $message;

        // Attempt to send email
        try {
            $mail->send();
            $response = [
                'status' => 'success',
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo,
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

?>
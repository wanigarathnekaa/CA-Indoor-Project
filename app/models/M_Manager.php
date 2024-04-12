<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class M_Manager
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //Register User
    public function managerRegister($data)
    {
        $this->db->query('INSERT INTO managers (name, email, nic, strAddress,city, phoneNumber, password) VALUES (:name, :email, :nic, :strAddress,:city, :phoneNumber, :password)');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':strAddress', $data['strAddress']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':password', $data['password']);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM managers WHERE email = :email');
        $this->db->bind(':email', $email);


        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function updateManager($data)
    {
        $this->db->query('UPDATE managers SET name=:name, email=:email ,nic= :nic, strAddress=:strAddress, city=:city, phoneNumber=:phoneNumber ,img = :img  WHERE email = :email');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':strAddress', $data['strAddress']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':img', $data['filename']);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteManager($email){
        $this->db->query('DELETE FROM managers WHERE email=:email');
        $this->db->bind(':email', $email);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    // get user progile pic
    public function getExistingImageFilename($email){
        $this->db->query('SELECT img FROM managers WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            return $row->img; 
        } else {
            return null; 
        }
    }


    public function generateRandomPassword($length = 12) {
        // Define characters to use in the password
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    
        // Get the total number of characters available
        $charLength = strlen($chars);
    
        // Initialize the password variable
        $password = '';
    
        // Loop to generate random characters
        for ($i = 0; $i < $length; $i++) {
            // Generate a random index to pick a character from $chars
            $randomIndex = mt_rand(0, $charLength - 1);
    
            // Append the randomly selected character to the password
            $password .= $chars[$randomIndex];
        }
    
        return $password;
    }
    
    public function SendPasswordViaEmail($email,$password) {
        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);


        
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
            $mail->Subject = 'Your Manager Account Details';
            $mail->Body    = 'Your login credentials : <br>Email :  '.$email.'<br>Password : '.$password;
            $mail->send();

            return true;


                
            
        } 
}
?>
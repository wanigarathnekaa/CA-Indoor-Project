<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    class M_Coach{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getUserByEmail($email){
            $this->db->query('SELECT * FROM coaches WHERE email =:email');
            $this->db->bind(':email', $email);

            return $this->db->single();

        }

        

        //Register User
        public function coachRegister($data){
            $this->db->query('INSERT INTO coaches (email, nic, srtAddress, city , achivements, experience, specialty, certificate) VALUES (:email, :nic, :srtAddress, :city , :achivements, :experience, :specialty, :certificate)');
            
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':srtAddress', $data['srtAddress']);
            $this->db->bind(':city', $data['city']);
            $this->db->bind(':achivements', $data['achivements']);
            $this->db->bind(':experience', $data['experience']);
            $this->db->bind(':specialty', $data['specialty']);
            $this->db->bind(':certificate', $data['certificate']);
            



            if($this->db->execute()){
                return true;
            }
            else{
                return false;
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
                $mail->Subject = 'Your Coach Account Details';
                $mail->Body    = 'Your login credentials:<br>Email:  '.$email.'<br>Password:'.$password;
                $mail->send();
    
                return true;
    
    
                    
                
            } 
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }

    }
          
    
            public function findUserByEmail($email)
            {
                $this->db->query('SELECT * FROM coaches WHERE email = :email');
                $this->db->bind(':email', $email);
        
        
                $row = $this->db->single();
        
                if ($this->db->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
        
            }

        
        
        

        public function updateCoach($data){
            $this->db->query('UPDATE coaches SET email=:email ,nic= :nic, srtAddress= :srtAddress, city=:city, achivements=:achivements, experience=:experience, specialty=:specialty, certificate=:certificate  WHERE email = :email');
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':srtAddress', $data['srtAddress']);
            $this->db->bind(':city', $data['city']);
            $this->db->bind(':achivements', $data['achivements']);
            $this->db->bind(':experience', $data['experience']);
            $this->db->bind(':specialty', $data['specialty']);
            $this->db->bind(':certificate', $data['certificate']);
    


            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
            
        }

        public function deleteCoach($email){
            $this->db->query('DELETE FROM coaches WHERE email=:email');
            $this->db->bind(':email', $email);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>
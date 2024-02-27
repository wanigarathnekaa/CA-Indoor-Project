<?php
class M_Users
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //Register User
    public function register($data)
    {
        $this->db->query('INSERT INTO user (name, user_name, email, phoneNumber,password,img) VALUES (:name, :user_name, :email, :phoneNumber,:password,:img)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_name', $data['user_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':password', $data['pwd']);
        $this->db->bind(':img', $data['filename']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);


        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);


        $row = $this->db->single();

        return $row;
    }

    //Login Users
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
    public function loginCoach($email, $password)
    {
        $this->db->query('SELECT * FROM coaches WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }

    }
    public function loginManager($email, $password)
    {
        $this->db->query('SELECT * FROM managers WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }

    }

    public function loginCashier($email, $password)
    {
        $this->db->query('SELECT * FROM cashier WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        
        if ($password == $row->password) {
            return $row;
        } else {
            return false;
        }

    }


    public function updateUser($data)
    {
        $this->db->query('UPDATE user SET name = :name, user_name= :user_name, email= :email, phoneNumber= :phoneNumber, password= :password ,img = :img WHERE email = :email');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_name', $data['user_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':password', $data['pwd']);
        $this->db->bind(':img', $data['filename']);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }
    public function findUser($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        return $this->db->single();
    }
    public function updatePassword($email, $hashedPassword) {
    
        $this->db->query('UPDATE user SET password = :password WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);

        if ($this->db->execute()) {
            return true; 
        } else {
            return false;
        }
    }

    
    public function deleteUser($email){
        $this->db->query('DELETE FROM user WHERE email=:email');
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
        $this->db->query('SELECT img FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            return $row->img; 
        } else {
            return null; 
        }
    }
    public function generateRandomPassword($length = 12) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        $charLength = strlen($chars);
        $password = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, $charLength - 1);
            $password .= $chars[$randomIndex];
        }
    
        return $password;
    }



}
?>
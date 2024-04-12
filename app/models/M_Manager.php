<?php
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
}
?>
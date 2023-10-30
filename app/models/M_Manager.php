<?php 
    class M_Manager{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        //Register User
        public function managerRegister($data){
            $this->db->query('INSERT INTO managers (name, email, nic, address, phoneNumber, password) VALUES (:name, :email, :nic, :address, :phoneNumber, :password)');
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':phoneNumber', $data['phoneNumber']);
            $this->db->bind(':password', $data['password']);


            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
            
        }


    }
?>
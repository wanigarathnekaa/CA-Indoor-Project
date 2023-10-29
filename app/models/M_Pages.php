<?php 
    class M_Pages{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }
        public function getUsers(){
            $this->db->query('SELECT * FROM user');

            return $this->db->resultSet();
        }

        public function findUser($email){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email', $email);

            return $this->db->single();
        }


    }
?>
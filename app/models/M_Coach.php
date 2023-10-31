<?php 
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
            $this->db->query('INSERT INTO coaches (email, nic, address, experience, specialty, certificate) VALUES (:email, :nic, :address, :experience, :specialty, :certificate)');
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':address', $data['address']);
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

        public function updateCoach($data){
            $this->db->query('UPDATE coaches SET email=:email ,nic= :nic, address= :address, experience=:experience, specialty=:specialty, certificate=:certificate  WHERE email = :email');
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':address', $data['address']);
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
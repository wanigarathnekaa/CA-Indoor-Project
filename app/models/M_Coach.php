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

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM coaches WHERE email =:email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
    
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
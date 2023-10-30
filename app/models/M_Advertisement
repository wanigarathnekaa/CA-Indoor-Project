<?php 
    class M_Advertisement{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function addAdvertisement($data){
            $this->db->query('INSERT INTO advertisement (title, create_date, discription, post_url) VALUES (:title, :create_date, :discription, :post_url)');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':create_date', $data['create_date']);
            $this->db->bind(':discription', $data['discription']);
            $this->db->bind(':post_url', $data['post_url']);


            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
            
        }


    }
?>
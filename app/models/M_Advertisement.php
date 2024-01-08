<?php 
    class M_Advertisement{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function addAdvertisement($data){
            $this->db->query('INSERT INTO advert (title, date, content, name, img) VALUES (:title, :date, :content, :name, :img)');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':date', $data['date']);
            $this->db->bind(':content', $data['content']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':img', $data['filename']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
            
        }


    }
?>
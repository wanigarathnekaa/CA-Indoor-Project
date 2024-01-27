<?php 
    class M_Advertisement{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        // add advertisement.............................................
        public function addAdvertisement($data){
            $this->db->query('INSERT INTO advert (title, email, date, content, name, img) VALUES (:title, :email, :date, :content, :name, :img)');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':email', $data['email']);
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

        // delete advertisement.............................................
        public function deleteAdvertisement($id){
            $this->db->query('DELETE FROM advert WHERE advertisement_id = :advertisement_id');
            $this->db->bind(':advertisement_id', $id);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        // edit advertisement.............................................
        public function editAdvertisement($data){
            $this->db->query('UPDATE advert SET title = :title, email = :email, date = :date, content = :content, name = :name, img = :img WHERE advertisement_id = :advertisement_id');
            $this->db->bind(':advertisement_id', $data['advertisement_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':email', $data['email']);
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


        // get advertisement by id.............................................
        public function getAdvertisementById($id){
            $this->db->query('SELECT * FROM advert WHERE advertisement_id = :advertisement_id');
            $this->db->bind(':advertisement_id', $id);

            $row = $this->db->single();

            return $row;
            
        }

    }
?>
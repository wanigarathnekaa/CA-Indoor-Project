<?php 
    class M_Advertisement{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        // add advertisement.............................................
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

        // get advertisement by id.............................................
        // public function getAdvertisementById($id){
        //     $this->db->query('SELECT * FROM advert WHERE id = :id');
        //     $this->db->bind(':id', $id);
        //     $result = $this->db->single();
        //     return $result;
        // }

        // update advertisement.............................................
        public function updateAdvertisement($data){
            $this->db->query('UPDATE advert SET title = :title, date = :date, content = :content, name = :name, img = :img WHERE id = :id');
            $this->db->bind(':id', $data['id']);
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

        // delete advertisement.............................................
        public function deleteAdvertisement($id){
            $this->db->query('DELETE FROM advert WHERE id = :id');
            $this->db->bind(':id', $id);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>
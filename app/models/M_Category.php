<?php 
    class M_Category{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function insertCategory($data){
            $this->db->query('INSERT INTO category (category_name) VALUES (:category_name)');
            $this->db->bind(':category_name', $data['categoryName']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        
    }
?>
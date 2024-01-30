<?php 
    class M_Category{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function insertCategory($data){
            $this->db->query('INSERT INTO category (category_name, category_slug_url) VALUES (:category_name, :category_slug_url)');
            $this->db->bind(':category_name', $data['categoryName']);
            $this->db->bind(':category_slug_url', $data['categorySlug']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function findCategory($name){
            $this->db->query('SELECT * FROM category WHERE LOWER(category_name) = LOWER(:category_name)');
            $this->db->bind(':category_name', $name);

            $this->db->execute();
        
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getCategoryById($id){
            $this->db->query('SELECT * FROM category WHERE category_id = :category_id');
            $this->db->bind(':category_id', $id);

            $row = $this->db->single();

            return $row;
        } 

        public function deleteCategory($id){
            $this->db->query('DELETE FROM category WHERE category_id = :category_id');
            $this->db->bind(':category_id', $id);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updateCategory($data){
            $this->db->query('UPDATE category SET category_name = :category_name, category_slug_url = :category_slug_url WHERE category_id = :category_id');
            $this->db->bind(':category_name', $data['categoryName']);
            $this->db->bind(':category_slug_url', $data['categorySlug']);
            $this->db->bind(':category_id', $data['categoryId']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>
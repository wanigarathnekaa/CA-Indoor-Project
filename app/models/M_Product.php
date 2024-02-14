<?php 
    class M_Product{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function insertProduct($data){
            $this->db->query('INSERT INTO product (product_title, category_id, brand_id, regular_price, selling_price, product_thumbnail, short_description, status, created_at, qty) VALUES (:product_title, :category_id, :brand_id, :regular_price, :selling_price, :product_thumbnail, :short_description, :status, :created_at, :qty)');
            $this->db->bind(':product_title', $data['productName']);
            $this->db->bind(':category_id', $data['category_name']);
            $this->db->bind(':brand_id', $data['brand_name']);
            $this->db->bind(':regular_price', $data['regular_price']);
            $this->db->bind(':selling_price', $data['selling_price']);
            $this->db->bind(':product_thumbnail', $data['product_thumbnail']);
            $this->db->bind(':short_description', $data['short_description']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':created_at', $data['created_at']);
            $this->db->bind(':qty', $data['quantity']);
            
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function findProduct($name){
            $this->db->query('SELECT * FROM product WHERE LOWER(product_title) = LOWER(:product_title)');
            $this->db->bind(':product_title', $name);

            $this->db->execute();
        
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getProductById($id){
            $this->db->query('SELECT * FROM product WHERE product_id = :product_id');
            $this->db->bind(':product_id', $id);

            $row = $this->db->single();

            return $row;
        } 

        // public function getBrandCategoryById($id){
        //     $this->db->query('SELECT * FROM brand WHERE brand_category_name = :brand_category_name');
        //     $this->db->bind(':brand_category_name', $id);

        //     return $this->db->resultSet();
        // }

        public function deleteProduct($id){
            $this->db->query('DELETE FROM product WHERE product_id = :product_id');
            $this->db->bind(':product_id', $id);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updateProduct($data){
            $this->db->query('UPDATE product SET product_title = :product_title, category_id = :category_id, brand_id = :brand_id, regular_price = :regular_price, selling_price = :selling_price, product_thumbnail=:product_thumbnail, status=:status, created_at=:created_at, qty=:qty   WHERE product_id = :product_id');
            $this->db->bind(':product_title', $data['productName']);
            $this->db->bind(':category_id', $data['category_name']);
            $this->db->bind(':brand_id', $data['brand_name']);
            $this->db->bind(':regular_price', $data['regular_price']);
            $this->db->bind(':selling_price', $data['selling_price']);
            $this->db->bind(':product_thumbnail', $data['product_thumbnail']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':created_at', $data['created_at']);
            $this->db->bind(':product_id', $data['product_id']);
            $this->db->bind(':qty', $data['quantity']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>
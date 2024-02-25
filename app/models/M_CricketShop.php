<?php 
    class M_CricketShop{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function addToCart($data){
            $this->db->query('INSERT INTO cart (customer_email, p_id, p_thumbnail, product_title, product_price, qty, total_amount) VALUES(:customer_email, :p_id, :p_thumbnail, :product_title, :product_price,:qty, :total_amount)');
            $this->db->bind(':customer_email', $data['email']);
            $this->db->bind(':p_id', $data['product_id']);
            $this->db->bind(':product_title', $data['product_title']);
            $this->db->bind(':p_thumbnail', $data['product_thumbnail']);
            $this->db->bind(':product_price', $data['product_price']);
            $this->db->bind(':qty', $data['qty']);
            $this->db->bind(':total_amount', $data['totalAmount']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getCart($email){
            $this->db->query('SELECT * FROM cart WHERE customer_email = :customer_email');
            $this->db->bind(':customer_email', $email);
            return $this->db->resultSet();
        }
        
      
    }   
?>
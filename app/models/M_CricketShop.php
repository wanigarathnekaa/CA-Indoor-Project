<?php 
    class M_CricketShop{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function addToCart($data){
            $this->db->query('INSERT INTO cart (customer_email, p_id, product_title, qty, total_amount) VALUES(:customer_email, :p_id, :product_title, :qty, :total_amount)');
            $this->db->bind(':customer_email', $data['email']);
            $this->db->bind(':p_id', $data['product_id']);
            $this->db->bind(':product_title', $data['product_title']);
            $this->db->bind(':qty', $data['qty']);
            $this->db->bind(':total_amount', $data['totalAmount']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
      
    }   
?>
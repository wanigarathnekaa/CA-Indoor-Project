<?php 
    class M_Order{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function insertOrder($data){
            $this->db->query('INSERT INTO orders (full_name, mobile_number, email, address, city, customer_id, order_date, order_status, payment_method, pickup_mode) VALUES(:fname, :email, :adr, :phone, :city, :customerID, :order_date, :order_status, :payment, :pickup)');
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':adr', $data['adr']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':city', $data['city']);
            $this->db->bind(':customerID', $data['customerID']);
            $this->db->bind(':order_date', $data['order_date']);
            $this->db->bind(':order_status', $data['order_status']);
            $this->db->bind(':payment', $data['payment']);
            $this->db->bind(':pickup', $data['pickup']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>
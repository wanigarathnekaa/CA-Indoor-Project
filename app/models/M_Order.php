<?php 
    class M_Order{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function insertOrder($data){
            $this->db->query('INSERT INTO orders (full_name, mobile_number, email, address, city, customer_id, order_date, order_status, payment_method, pickup_mode) VALUES(:fname, :phone, :email, :adr,  :city, :customerID, :order_date, :order_status, :payment, :pickup)');
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':adr', $data['adr']);  
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

        public function orderItems($orderId, $product_id, $qty, $price_per_unit){
            $this->db->query('INSERT INTO orderitems (order_id, product_id, quantity, price_per_unit) VALUES(:order_id, :product_id, :qty, :price_per_unit)');
            $this->db->bind(':order_id', $orderId);
            $this->db->bind(':product_id', $product_id);
            $this->db->bind(':qty', $qty);
            $this->db->bind(':price_per_unit', $price_per_unit);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getOrders($customerID){
            $this->db->query('SELECT * FROM orders WHERE customer_id = :customer_id');
            $this->db->bind(':customer_id', $customerID);
            return $this->db->resultSet();
        }

        public function deleteCart($email){
            $this->db->query('DELETE FROM cart WHERE customer_email = :email');
            $this->db->bind(':email', $email);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function last_inserted_id()
    {
        $this->db->query("SELECT MAX(order_id) AS lastID FROM orders");
        $this->db->execute();
        $result = $this->db->single();
        return $result->lastID;
    }
        
    }
?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
class M_Order
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function insertOrder($data)
    {
        $this->db->query('INSERT INTO orders (full_name, mobile_number, email, address, city, customer_id, order_date, order_status, payment_method, pickup_mode, payment_status, price) VALUES(:fname, :phone, :email, :adr, :city, :customerID, :order_date, :order_status, :payment, :pickup, :payment_status, :price)');
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
        $this->db->bind(':payment_status', $data['payment_status']);
        $this->db->bind(':price', $data['price']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function orderItems($orderId, $product_id, $qty, $price_per_unit)
    {
        $this->db->query('INSERT INTO orderitems (order_id, product_id, quantity, price_per_unit) VALUES(:order_id, :product_id, :qty, :price_per_unit)');
        $this->db->bind(':order_id', $orderId);
        $this->db->bind(':product_id', $product_id);
        $this->db->bind(':qty', $qty);
        $this->db->bind(':price_per_unit', $price_per_unit);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrders($customerID)
    {
        $this->db->query('SELECT * FROM orders WHERE customer_id = :customer_id');
        $this->db->bind(':customer_id', $customerID);
        return $this->db->resultSet();
    }

    public function deleteCart($email)
    {
        $this->db->query('DELETE FROM cart WHERE customer_email = :email');
        $this->db->bind(':email', $email);
        if ($this->db->execute()) {
            return true;
        } else {
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

    public function getOrderItems($orderID)
    {
        $this->db->query('SELECT * FROM orderitems WHERE order_id = :order_id');
        $this->db->bind(':order_id', $orderID);
        return $this->db->resultSet();
    }

    public function getOrder($orderID)
    {
        $this->db->query('SELECT * FROM orders WHERE order_id = :order_id');
        $this->db->bind(':order_id', $orderID);
        return $this->db->single();
    }
    
    public function sendEmailManager($email)
    {   
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
     
    
       
        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';
    
        $mail = new PHPMailer(true);
    
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nivodya2001@gmail.com';
        $mail->Password = 'wupbxphjicpfidgj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        //Recipients
        $mail->setFrom('nivodya2001@gmail.com', 'Hasini Hewa');
        $mail->addAddress($email);
    
        //Content
        $mail->isHTML(true);
        $mail->Subject = 'About your appointment';
        $mail->Body = "Hello,<br><br>
        We received your request to place an order, but unfortunately, the requested quantity is not available at the moment. Please check the available quantity and try again.<br>
        If you have any questions or need further assistance, feel free to contact us.<br><br>
        Thank you.";

        
    
        // Attempt to send email
        try {
            $mail->send();
            $response = [
                'status' => 'success',
                'message' => 'Email sent to coach.'
            ];
            return true;
    
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo,
            ];
            return false;
    
        }
    
        
    }

    public function updateOrderStatus($orderID, $newStatus)
    {
        $this->db->query('UPDATE orders SET order_status = :new_status WHERE order_id = :order_id');
        $this->db->bind(':new_status', $newStatus);
        $this->db->bind(':order_id', $orderID);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePaymentStatus($orderID)
    {
        $this->db->query('UPDATE orders SET payment_status = :new_status WHERE order_id = :order_id');
        $this->db->bind(':new_status', "Paid");
        $this->db->bind(':order_id', $orderID);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProductQuantity($product_id)
    {
        $this->db->query('SELECT qty FROM product WHERE product_id = :product_id');
        $this->db->bind(':product_id', $product_id);
        $result = $this->db->single();
        return $result->qty;
    }

    public function getProductReorderLevel($product_id)
    {
        $this->db->query('SELECT reorder_level FROM product WHERE product_id = :product_id');
        $this->db->bind(':product_id', $product_id);
        $result = $this->db->single();
        return $result->reorder_level; 
    }

    public function updateQuantity($product_id, $qty)
    {
        $this->db->query('UPDATE product SET qty = qty - :qty WHERE product_id = :product_id');
        $this->db->bind(':qty', $qty);
        $this->db->bind(':product_id', $product_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getProduct($product_id)
    {
        $this->db->query('SELECT * FROM product WHERE product_id = :product_id');
        $this->db->bind(':product_id', $product_id);
        return $this->db->single();
    }

    public function deleteOrder($order_id)
    {
        $this->db->query('DELETE FROM orders WHERE order_id = :order_id');
        $this->db->bind(':order_id', $order_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertCancelOrder($data)
    {
        $this->db->query('INSERT INTO cancel_orders (order_id, full_name, mobile_number, email, address, city, customer_id, order_date, order_status, payment_method, pickup_mode, payment_status, price) VALUES(:order_id, :fname, :phone, :email, :adr, :city, :customerID, :order_date, :order_status, :payment, :pickup, :payment_status, :price)');
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':fname', $data['full_name']);
        $this->db->bind(':phone', $data['mobile_number']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':adr', $data['address']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':customerID', $data['customer_id']);
        $this->db->bind(':order_date', $data['order_date']);
        $this->db->bind(':order_status', $data['order_status']);
        $this->db->bind(':payment', $data['payment_method']);
        $this->db->bind(':pickup', $data['pickup_mode']);
        $this->db->bind(':payment_status', $data['payment_status']);
        $this->db->bind(':price', $data['price']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertOrderPersonalDetail($data)
    {
        $this->db->query('INSERT INTO order_person_detail (full_name, mobile_number, email, address, city) VALUES(:fname, :phone, :email, :adr, :city)');
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':adr', $data['adr']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':city', $data['city']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrderPersonDetails($email)
    {
        $this->db->query('SELECT * FROM order_person_detail WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function findOrderPerson($email)
    {
        $this->db->query('SELECT * FROM order_person_detail WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }



}
?>
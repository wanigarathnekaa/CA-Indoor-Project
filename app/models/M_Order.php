<?php
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



}
?>
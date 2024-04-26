<?php
class M_Pages
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUsers()
    {
        $this->db->query('SELECT * FROM user');

        return $this->db->resultSet();
    }

    public function findUser($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    public function getActivatedUser($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email AND is_blacklist = 0');
        $this->db->bind(':email', $email);

        return $this->db->single();
    }
    

    public function getActivatedCoaches()
    {
        $this->db->query('SELECT u.*, c.* FROM coaches c LEFT JOIN user u ON u.email = c.email WHERE u.is_blacklist = 0');

        return $this->db->resultSet();
    }

    public function findCoach($email)
    {
        $this->db->query('SELECT * FROM coaches WHERE email = :email');
        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    public function findManager($email)
    {
        $this->db->query('SELECT * FROM managers WHERE email = :email');
        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    public function findComanyUser($email)
    {
        $this->db->query('SELECT * FROM company_users WHERE email = :email');
        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    public function getCoaches()
    {
        $this->db->query('SELECT * FROM coaches');

        return $this->db->resultSet();
    }
    public function getManagers()
    {
        $this->db->query('SELECT * FROM managers');

        return $this->db->resultSet();
    }
    public function getCompanyusers()
    {
        $this->db->query('SELECT * FROM company_users');

        return $this->db->resultSet();
    }

    public function getBookings()
    {
        $this->db->query('SELECT * FROM bookings');

        return $this->db->resultSet();
    }

    public function getReservations(){
        $this->db->query('SELECT * FROM bookings JOIN time_slots ON bookings.id = time_slots.booking_id ORDER BY bookings.date ASC;');
        $this->db->execute();

        return $this->db->resultSet();
    }
    public function updatePassword($email, $hashedPassword) {
        // Assuming you have a database connection and a users table

        // Prepare update query
        $query = "UPDATE users SET password = :password WHERE email = :email";

        // Bind parameters
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);

        // Execute query
        if ($this->db->execute()) {
            return true; // Password updated successfully
        } else {
            return false; // Password update failed
        }
    }

    public function getCoachCount()
    {
        $this->db->query('SELECT * FROM coaches');
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getManagerCount()
    {
        $this->db->query('SELECT * FROM managers');
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getCompanyUserCount()
    {
        $this->db->query('SELECT * FROM company_users');
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function getAccLog()
    {
        $this->db->query('SELECT * FROM userlog');
        $this->db->execute();
        return $this->db->resultSet();
    }

    

    public function getUserCount()
    {
        $this->db->query('SELECT * FROM user');
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getAdvertisement(){
        $this->db->query('SELECT * FROM advert');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getCategories(){
        $this->db->query('SELECT * FROM category');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getBrands(){
        $this->db->query('SELECT * FROM brand');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getProducts(){
        $this->db->query('SELECT * FROM product');
        $result = $this->db->resultSet();        
        return $result;
    }

    public function getProductByID($id){
        $this->db->query('SELECT * FROM product WHERE product_id = :id');
        $this->db->bind(':id', $id);
    
        return $this->db->single();
    }

    public function getCart($email){
        $this->db->query('SELECT * FROM cart WHERE customer_email = :customer_email');
        $this->db->bind(':customer_email', $email);
        return $this->db->resultSet();
    }

    public function getOrder(){
        $this->db->query('SELECT * FROM orders');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getCancelOrder(){
        $this->db->query('SELECT * FROM cancel_orders');
        $result = $this->db->resultSet();
        return $result;
    }


    public function getOrders($customerID){
        $this->db->query('SELECT * FROM orders WHERE customer_id = :customer_id');
        $this->db->bind(':customer_id', $customerID);
        return $this->db->resultSet();
    }

    public function getOrderItems($orderID){
        $this->db->query('SELECT * FROM orderitems WHERE order_id = :order_id');
        $this->db->bind(':order_id', $orderID);
        return $this->db->resultSet();
    }

    public function getPermanentBookings()
    {
        $this->db->query('SELECT * FROM permanent_booking');
        return $this->db->resultSet();
    }
    

}
?>
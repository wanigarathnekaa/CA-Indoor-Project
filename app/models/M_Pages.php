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

    public function getBookings()
    {
        $this->db->query('SELECT * FROM reservation');

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

}
?>
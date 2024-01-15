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

    public function getBookings()
    {
        $this->db->query('SELECT * FROM reservation');

        return $this->db->resultSet();
    }

    public function getCoachCount()
    {
        $this->db->query('SELECT * FROM coaches');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUserCount()
    {
        $this->db->query('SELECT * FROM user');
        $this->db->execute();
        return $this->db->rowCount();
    }

    // public function getAdvertisement()
    // {
    //     $this->db->query('SELECT * FROM advert');

    //     return $this->db->resultSet();
    // }


}
?>
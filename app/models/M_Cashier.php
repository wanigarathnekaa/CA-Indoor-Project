<?php
class M_Cashier
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM cashier WHERE email = :email');
        $this->db->bind(':email', $email);


        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }


}
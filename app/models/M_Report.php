<?php
class M_Report
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsernames(){
        $this->db->query('SELECT * FROM user');

        return $this->db->resultset();
    }
    public function getReservations(){
        $this->db->query('SELECT * FROM reservation');
    
        return $this->db->resultset();

    }
    public function getUserAndReservationData($data){
        $date = $data['date'];
        $user_name = $data['user_name'];
    
        $this->db->query('SELECT u.user_name, u.email, u.phoneNumber, r.net 
                          FROM user u 
                          INNER JOIN reservation r ON u.email = r.email 
                          WHERE u.user_name = :user_name AND r.date = :date');
    
        $this->db->bind(':user_name', $user_name);
        $this->db->bind(':date', $date);
    
        return $this->db->resultset();
    }
    
    
    
    
    
}
?>
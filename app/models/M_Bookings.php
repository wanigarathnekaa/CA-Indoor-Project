<?php 
    class M_Bookings{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function Booking_Register($data)
    {
        $this->db->query('INSERT INTO reservation (name, email, date, net, timeSlot, phoneNumber, coach) VALUES (:name, :email, :date, :net, :timeSlot, :phoneNumber, :coach)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':net', $data['net']);
        $this->db->bind(':timeSlot', $data['timeSlot']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':coach', $data['coach']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }


    }
?>
<?php
class M_Report
{        private $db;
    
        public function __construct(){
            $this->db = new Database;
        }
    
        public function getBookingDetails($data) {
            // Access invoice_date and invoice_due_date from the passed array
            $invoice_date = $data['invoice_date'];
            $invoice_due_date = $data['invoice_due_date'];
    
            // Now you can use them in your database query
            $this->db->query('SELECT * FROM bookings WHERE date >= :invoice_date AND date <= :invoice_due_date');
            $this->db->bind(':invoice_date',$invoice_date);
            $this->db->bind(':invoice_due_date',$invoice_due_date);
            return $this->db->resultSet();
        }
    }
    


?>
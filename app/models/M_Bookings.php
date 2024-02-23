<?php
class M_Bookings
{
    private $db;
    public function __construct()
    {
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

    public function last_inserted_id()
    {
        $this->db->query("SELECT MAX(id) AS lastID FROM bookings");
        $this->db->execute();
        $result = $this->db->single();
        return $result->lastID;
    }


    public function Make_Reservation($data)
    {
        $this->db->query("INSERT INTO bookings (name, email, phoneNumber, date, coach, bookingPrice, paymentStatus, paidPrice) VALUES (:name, :email, :phoneNumber, :date, :coach, :bookingPrice, :paymentStatus, :paidPrice)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':coach', $data['coach']);
        $this->db->bind(':bookingPrice', $data['bookingPrice']);
        $this->db->bind(':paymentStatus', $data['paymentStatus']);
        $this->db->bind(':paidPrice', $data['paidPrice']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function addTimeSlots($bookingId, $timeSlot, $netType)
    {
        $this->db->query("INSERT INTO time_slots (booking_id, timeSlot, netType) VALUES (:bookingId, :timeSlot, :netType)");
        $this->db->bind(':bookingId', $bookingId);
        $this->db->bind(':timeSlot', $timeSlot);
        $this->db->bind(':netType', $netType);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function findBooking($date, $timeSlot, $net)
    {
        $this->db->query('SELECT * FROM reservation WHERE date = :date && timeSlot = :timeSlot && net = :net');
        $this->db->bind(':date', $date);
        $this->db->bind(':timeSlot', $timeSlot);
        $this->db->bind(':net', $net);


        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteBooking($reservation__Id)
    {
        $this->db->query('DELETE FROM time_slots WHERE id=:id');
        $this->db->bind(':id', $reservation__Id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReservation($reservation__Id)
    {
        $this->db->query('DELETE FROM bookings WHERE id=:id');
        $this->db->bind(':id', $reservation__Id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
?>
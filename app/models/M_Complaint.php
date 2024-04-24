<?php
class M_Complaint
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function create($data)
    {
        $this->db->query('INSERT INTO complaint (user_id,name,email,message, is_replied) VALUES(:user_id,:name,:email,:message, :is_replied)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':message', $data['message']);
        $this->db->bind(':is_replied', $data['is_replied']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getComplaintsWithoutReplies()
    {
        $this->db->query('SELECT * FROM complaint WHERE is_replied = 0;');

        return $this->db->resultset();
    }

    public function getComplaints()
    {
        $this->db->query('SELECT * FROM complaint');
        return $this->db->resultset();
    }
    public function getComplaintById($complaintId)
    {
        $this->db->query('SELECT * FROM complaint WHERE id=:id');
        $this->db->bind(':id', $complaintId);
        return $this->db->single();
    }
    public function getComplaintEmailById($complaintId)
    {
        $this->db->query('SELECT email FROM complaint WHERE id=:id');
        $this->db->bind(':id', $complaintId);
        $result = $this->db->single();
        if ($result) {
            return $result->email;
        } else {
            return null;
        }

    }

    public function getUserImg($user_id)
    {
        $image = $this->db->query('SELECT img FROM user WHERE uid = :uid');
        if ($image) {
            return $image;
        } else {
            return null;
        }
    }
    public function updateComplaint($complaintId)
    {
        $this->db->query('UPDATE complaint SET is_replied = 1 WHERE id = :id');
        $this->db->bind(':id', $complaintId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>
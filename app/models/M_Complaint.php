<?php 
  class M_Complaint{
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
public function create($data){
        $this->db->query('INSERT INTO complaint (user_id,name,email,message) VALUES(:user_id,:name,:email,:message)') ;
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':user_id',$_SESSION['user_id']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':message',$data['message']);

       

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
        




    }
    public function getComplaints(){
        $this->db->query('SELECT * FROM complaint');

        return $this->db->resultset();
    }
    public function getComplaintById($complaintId){
        $this->db->query('SELECT * FROM complaint WHERE id=:id');
        $this->db->bind(':id',$complaintId);
        return $this->db->single();
    }
    public function getComplaintEmailById($complaintId){
        $this->db->query('SELECT email FROM complaint WHERE id=:id');
        $this->db->bind(':id',$complaintId);
        $result= $this->db->single();
        if ($result) {
            return $result->email; 
        } else {
            return null; 
        }
    
    }
   
    public function getUserImg($user_id)    {
        $image=$this->db->query('SELECT img FROM user WHERE uid = :uid');
        if ($image) {
            return $image; 
        } else {
            return null; 
        }
    }
    public function delete($complaintId){
        $this->db->query('DELETE FROM complaint WHERE id=:id');
        $this->db->bind(':id',$complaintId);
       

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
        



    }
}
  
?>
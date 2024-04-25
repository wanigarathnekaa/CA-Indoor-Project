<?php

class M_CompanyUsers
{
      private $db;
      public function __construct()
      {
            $this->db = new Database;
      }

    
      // login admin,owner and cashier
      public function loginCompanyUsers($email, $password)
      {
            $this->db->query('SELECT * FROM company_users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                  return $row;
            } else {
                  return false;
            }

      }


      // Find user by email
      public function findUserByEmail($email)
      {
            $this->db->query('SELECT * FROM company_users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if ($this->db->rowCount() > 0) {
                  return true;
            } else {
                  return false;
            }
      }

      public function findUser($email)
      {
            $this->db->query('SELECT * FROM company_users WHERE email = :email');
            $this->db->bind(':email', $email);

            return $this->db->single();
      }


      //get user role by email
      public function getUserRoleByEmail($email)
      {
            $this->db->query('SELECT role FROM company_users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            return $row;
      }

      //edit user
      public function editProfile($data)
      {
            $this->db->query('UPDATE company_users SET name=:name, email=:email ,phoneNumber=:phoneNumber, nic= :nic, image= :image WHERE email = :email');
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':phoneNumber', $data['phoneNumber']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':image', $data['filename']);

            if ($this->db->execute()) {
                  return true;
            } else {
                  return false;
            }
      }

      // get user progile pic
    public function getExistingImageFilename($email){
      $this->db->query('SELECT image FROM company_users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      if ($row) {
          return $row->image; 
      } else {
          return null; 
      }
  }


      //delete user
      public function deleteUser($email)
      {
            $this->db->query('DELETE FROM company_users WHERE email=:email');
            $this->db->bind(':email', $email);

            if ($this->db->execute()) {
                  return true;
            } else {
                  return false;
            }
      }


      public function updateCompanyUserPassword($email, $hashedPassword)
      {

            $this->db->query('UPDATE company_users SET password = :password WHERE email = :email');
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $hashedPassword);

            if ($this->db->execute()) {
                  return true;
            } else {
                  return false;
            }
      }

}

?>
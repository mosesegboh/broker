<?php
/*
 *@package Broker Test Assignment
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
use Broker\Libs\Database;

class User
{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function add($data) 
    {
        $this->db->query('INSERT INTO user (email, password, is_admin, created_at, updated_at) VALUES(:email, :password, :is_admin, :created_at, :updated_at)');

        //Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':is_admin', $data['is_admin']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));
        $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

      //delete users from the database
    public function delete($id)
    {
        //prepare statement
        $this->db->query('DELETE FROM users WHERE id = :id');

        //id param will be binded with the id variable
        $this->db->bind(':id', $id);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        } 
    }

    //Find product by email
    public function findUserByEmail($email) 
    {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //sku param will be binded with the sku variable
        $this->db->bind(':email', $email);

        //Check if sku already exist
        if($this->db->rowCount() > 0) {
            $results = $this->db->resultSet();

            return $results;
        } else {
            return false;
        }
    }

    public function single($id) 
    {
        $this->db->query("SELECT * FROM users WHERE id = :id ORDER BY id DESC");

        $results = $this->db->resultSet();

        return $results;
    }
}

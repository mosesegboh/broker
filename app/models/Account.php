<?php
/*
 *@package Broker Test Assignment
 *Model for the account table
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */

use Broker\Libs\Database;

class Account
{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    
    /**
     * all - Get all accounts from the database
     *
     * @return Array
     */
    public function all(): Array
    {
        $this->db->query("SELECT * FROM accounts ORDER BY id DESC");

        $results = $this->db->resultSet();

        return $results;
    }
    
    /**
     * single- return the account for a single user
     *
     * @param  Int $id
     * @return Array
     */
    public function single($id): Array
    {
        $this->db->query("SELECT * FROM accounts WHERE id = :id ORDER BY id DESC");

        $results = $this->db->resultSet();

        return $results;
    }
}

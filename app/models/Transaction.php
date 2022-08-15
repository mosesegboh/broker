<?php
/*
 *@package Broker Test Assignment
 *Model for transactions
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
use Broker\Libs\Database;

class Transaction 
{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    
    /**
     * add - Add a transaction
     *
     * @param  Array $data
     * @return Bool
     */
    public function add($data): Bool
    {
        $this->db->query('INSERT INTO transactions (amount, comment, due_date, account_id, debit, credit, transaction_type, created_at, updated_at) VALUES(:amount, :comment, :due_date, :account_id, :debit, :credit, :transaction_type, :created_at, :updated_at)');

        //Bind values
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':due_date', $data['due_date']);
        $this->db->bind(':account_id', $data['account_id']);
        $this->db->bind(':debit', $data['debit']);
        $this->db->bind(':credit', $data['credit']);
        $this->db->bind(':transaction_type', $data['transaction_type']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));
        $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * getAllTransactionByDate - Get all transactions sorted by date
     *
     * @return Array
     */
    public function getAllTransactionByDate(): Array
    {
        $this->db->query("SELECT * FROM transactions ORDER BY created_at");

        $results = $this->db->resultSet();

        return $results;
    }
    
    /**
     * getAllTransactionsByComment - Get all transactions sorted by comment
     *
     * @return Array
     */
    public function getAllTransactionsByComment(): Array
    {
        $this->db->query("SELECT * FROM transactions ORDER BY comment");

        $results = $this->db->resultSet();

        return $results;
    }
    
    /**
     * updateBalance - Update the balance for the user
     *
     * @param  Array $transactionUsers
     * @param  Int $balance
     * @param  Int $id
     * @param  Int $account_id
     * @return Bool
     */
    public function updateBalance($transactionUsers, $balance, $id, $account_id): Bool
    {
        $this->db->query("UPDATE transactions SET debit = :debit, credit = :credit, account_id = :account_id, balance = :balance WHERE id = :id");

        $this->db->bind(':debit', $transactionUsers[0]);
        $this->db->bind(':credit', $transactionUsers[1]);
        $this->db->bind(':balance', $balance);
        $this->db->bind(':account_id', $account_id);
        $this->db->bind(':id', $id);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * getLatest - Get the latest Tranaction for a user
     *
     * @return Array
     */
    public function getLatest(): Array
    {
        $this->db->query("SELECT * FROM transactions ORDER BY ID DESC LIMIT 1");

        $results = $this->db->resultSet();

        return $results;
    }
    
    /**
     * getLatestUserTransaction - Get the latest transaction for a user
     *
     * @param  mixed $account_id
     * @return Array
     */
    public function getLatestUserTransaction($account_id): Array
    {
        $this->db->query("SELECT * FROM transactions WHERE account_id = :account_id ORDER BY ID DESC LIMIT 1");

        $this->db->bind(':account_id', $account_id);

        $results = $this->db->resultSet();

        return $results;
    }
}

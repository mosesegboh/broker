<?php
/*
 *@package Broker Test Assignment
 *Class for managing users
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
namespace Broker\Classes;

use Broker\Libs\Controller;
use Broker\Interfaces\AccountInterface;

class AccountClass extends Controller implements AccountInterface
{ 
    public function __construct()
    {
        $this->accountModel = $this->model('Account');
        $this->transactionModel = $this->model('Transaction');
    }
    
    /**
     * getUser
     *
     * @param  mixed $user
     * @return void
     */
    public function getAccount($account): Array
    {
        return $user = $this->accountModel->single($account);
    }

    //tested
    public function getAll(): Array
    {
        return $accounts = $this->accountModel->all();
    }
   
    /**
     * getAccountBalance
     *
     * @param  Int $account_id
     * @return void
     */
    public function getAccountBalance($account_id): Int
    {
        return $this->transactionModel->getLatestUserTransaction($account_id)[0]->balance;
    }
    
    /**
     * getAllTransactionByDate - Get all transactions sorted by date
     *
     * @return Array
     */
    public function getAllTransactionByDate(): Array
    {
        return $this->transactionModel->getAllTransactionByDate();
    }
    
    /**
     * getAllTransactionsByComment - Get all transactions sorted by comment in alphabetical order
     *
     * @return Array
     */
    public function getAllTransactionsByComment(): Array
    {
        return $this->transactionModel->getAllTransactionsByComment();
    }
}

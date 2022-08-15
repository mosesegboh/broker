<?php
/*
 *@package Broker Test Assignment
 *Interface for Account Class
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
namespace Broker\Interfaces;

Interface AccountInterface
{    
    /**
     * withdraw amount from account
     *
     * @param  Array $data
     * @return Array
     */
    public function getAccount($data): Array;

     /**
     * transfer from one account to another account
     *
     * @return Array
     */
    public function getAll(): Array; 
    
    /**
     * getAllTransactionByDate
     *
     * @return Array
     */
    public function getAllTransactionByDate(): Array;
    
    /**
     * getAllTransactionsByComment- Get All transactions sorted by comment.
     *
     * @return Array
     */
    public function getAllTransactionsByComment(): Array;
    
    /**
     * getAccountBalance - Get Accout Balance for an account
     * @param Int $account_id - Account balance to be found
     * @return Int
     */
    public function getAccountBalance($account_id): Int;
}
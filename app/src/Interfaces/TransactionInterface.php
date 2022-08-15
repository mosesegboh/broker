<?php
/*
 *@package Broker Test Assignment
 *Interface for Transaction Class
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
namespace Broker\Interfaces;

Interface TransactionInterface
{    
    /**
     * deposit amount into account
     *
     * @param  Array $data
     * @return int balance
     */
    public function deposit($data): Int;

    /**
     * withdraw amount from account
     *
     * @param  Array $data
     * @return Int $balance
     */
    public function withdraw($data): Int;

     /**
     * transfer from one account to another account
     *
     * @param  Array $data
     * @return Array
     */
    public function transfer($data): Array; 
}
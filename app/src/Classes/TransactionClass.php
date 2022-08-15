<?php
/*
 *@package Broker Test Assignment
 *Class for managing Transactions
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
namespace Broker\Classes;

use Broker\Interfaces\TransactionInterface;
use Broker\Libs\Controller;

class TransactionClass extends Controller implements TransactionInterface
{    
    public function __construct()
    {
        $this->transactionModel = $this->model('Transaction');
    }

    /**
     * deposit amount into account
     *
     * @param  Array $amount
     * @param  mixed $account
     * @return void
     */
    public function deposit($data): Int
    {
        $data['balance'] = $this->transactionModel->getLatestUserTransaction($data['account_id'])[0]->balance;
          
        $this->transactionModel->add($data);

        $newUserBalance = $data['balance'] + $data['amount'];

        $this->transactionModel->updateBalance([0 => $data['debit'], 1 => $data['credit']], $newUserBalance, $this->transactionModel->getLatestUserTransaction($data['account_id'])[0]->id, $data['account_id']);

        return $newUserBalance;
    }

    /**
     * withdraw amount from account.
     *
     * @param  Array $data
     * @return Int
     */
    public function withdraw($data): Int
    {
        $data['balance'] = $this->transactionModel->getLatestUserTransaction($data['account_id'])[0]->balance;
          
        $this->transactionModel->add($data);

        $newUserBalance = $data['balance'] - $data['amount'];

        $this->transactionModel->updateBalance( [0 => $data['debit'], 1 => $data['credit']], $newUserBalance, $this->transactionModel->getLatest()[0]->id, $data['account_id']);

        return $newUserBalance;
    }

     /**
     * Transfer from one account to another account
     *
     * @param  Array $data
     * @return Array 
     */
    public function transfer($data): Array
    {
        //debit leg
        $data['balance'] = $this->transactionModel->getLatestUserTransaction($data['debit'])[0]->balance;
            
        $this->transactionModel->add($data);

        $latestTransaction = $this->transactionModel->getLatest();
    
        $newDebitAccountBalance = $data['balance'] - $data['amount'];

        $this->transactionModel->updateBalance([0 => $data['debit'], 1 => $data['credit']], $newDebitAccountBalance, $latestTransaction[0]->id, $data['debit']);
        
        //credit leg
        $data['balance'] = $this->transactionModel->getLatestUserTransaction($data['credit'])[0]->balance;

        $this->transactionModel->add($data);

        $latestTransaction = $this->transactionModel->getLatest();

        
        $newCreditAccountBalance = $data['balance'] + $data['amount'];

        $this->transactionModel->updateBalance([0 => $data['debit'], 1 => $data['credit']], $newCreditAccountBalance, $latestTransaction[0]->id, $data['credit']);

        return [$newDebitAccountBalance, $newCreditAccountBalance];
    }
}
<?php
/*
 *@package Broker Test Assignment
 *controller for account related requests
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
use Broker\Helpers\Middleware;
use Broker\Libs\Controller;
use Broker\Classes\AccountClass;

class AccountController extends Controller 
{
    public function __construct() {
        $this->account = new AccountClass(); 
        //making sure only athenticated and approved users can access methods
        $this->middleware = new Middleware();
        $this->middleware->adminOnly();
    }
    
    /**
     * getAll - get All transaction in the system
     *
     * @return void
     */
    public function getAll()
    {
        $accounts = $this->account->getAll();

        $this->view('home/index', $accounts);
    }
    
    /**
     * getAccountBalance - get the account balance of a particular user
     *
     * @return void
     */
    public function getAccountBalance()
    {
        //when the request is made
        if($_REQUEST['get_account_balance']!='' && $_REQUEST['get_account_balance'] == 'get_account_balance'){
            $data = [
                'account_id' => trim($_REQUEST['account_id'])
            ];

            $userAccountBalance = $this->account->getAccountBalance($data['account_id']);

            $this->view('home/index', $userAccountBalance);
        }
    }
    
    /**
     * getAllTransactionsByDate - Get all transactions sorted by date
     *
     * @return void
     */
    public function getAllTransactionsByDate()
    {
        $allTransactions = $this->account->getAllTransactionsByDate();

        $this->view('home/index', $allTransactions);
    }
    
    /**
     * getAllTransactionsByComment - Get all transactions sorted by comment in alphabetic order
     *
     * @return void
     */
    public function getAllTransactionsByComment()
    {
        $allTransactions = $this->account->getAllTransactionsByComment();

        $this->view('home/index', $allTransactions);
    }
}

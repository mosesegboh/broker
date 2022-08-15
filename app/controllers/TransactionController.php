<?php
/*
 *@package Broker Test Assignment
 *controller for account related requests
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
use Broker\Libs\Controller;
use Broker\Classes\TransactionClass;
use Broker\Helpers\Middleware;

class TransactionController extends Controller 
{
    public $transaction;
    
    public function __construct() {
        $this->transactionModel = $this->model('Transaction');
        $this->transaction = new TransactionClass(); 
        //making sure only athenticated and approved users can access methods
        $this->middleware = new Middleware();
        $this->middleware->adminOnly();
    }
    
    /**
     * deposit - deposit into account
     *
     * @return void
     */
    public function deposit()
    {
        //when a request is made
        if( $_REQUEST['deposit'] != ''  && $_REQUEST['deposit'] == 'deposit') {
            $data = [
                'amount' => trim($_REQUEST['amount']),
                'comment' => trim($_REQUEST['comment']),
                'due_date' => trim($_REQUEST['due_date']),
                'account_id' => trim($_REQUEST['account_id']),
                'debit' => trim($_REQUEST['debit_user']),
                'credit' => trim($_REQUEST['credit_user']),
                'transaction_type'=> trim($_REQUEST['deposit']),
                'balance'=> trim($_REQUEST['balance']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $deposited = $this->transaction->deposit($data);

            //render view
            $this->view('home/index', $deposited);
        }
    }
    
    /**
     * withdrawal - withdraw from account
     *
     * @return void
     */
    public function withdraw()
    {
        //when a request is made
        if($_REQUEST['withdrawal'] != ''  && $_REQUEST['withdrawal'] == 'withdrawal'){
            $data = [
                'amount' => trim($_REQUEST['amount']),
                'comment' => trim($_REQUEST['comment']),
                'due_date' => trim($_REQUEST['due_date']),
                'account_id' => trim($_REQUEST['account_id']),
                'debit' => trim($_REQUEST['debit_user']),
                'credit' => trim($_REQUEST['credit_user']),
                'transaction_type'=> trim($_REQUEST['withdraw']),
                'balance'=> trim($_REQUEST['balance']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
                
            $withdrew = $this->transaction->withdraw($data);

            $this->view('home/index', $withdrew);
        }
    }
    
    /**
     * transfer - transfer from one account to the other
     *
     * @return void
     */
    public function transfer()
    {
        //when request is made
        if ($_REQUEST['transfer'] != '' && $_REQUEST['transfer'] == 'transfer'){
            $data = [
                'amount' => trim($_REQUEST['amount']),
                'comment' => trim($_REQUEST['comment']),
                'due_date' => trim($_REQUEST['due_date']),
                'account_id' => trim($_REQUEST['account_id']),
                'debit' => trim($_REQUEST['debit_user']),
                'credit' => trim($_REQUEST['credit_user']),
                'transaction_type'=> trim($_REQUEST['transfer']),
                'balance'=> trim($_REQUEST['balance']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->transaction->transfer($data);
        }
    }
}

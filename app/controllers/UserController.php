<?php
/*
 *@package Broker Test Assignment
 *controller for user related requests
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */

use Broker\Libs\Controller;
use Broker\Classes\UserClass;

class UserController extends Controller 
{
    public function __construct() {
        $this->user = new UserClass();
    }
        
    /**
     * register- Register a user
     *
     * @return void
     */
    public function register()
    {
        //when the request is sent
        if(!empty($_REQUEST['register']) != '' && $_REQUEST['register'] == "register"){
            $data = [
                'email' => trim($_REQUEST['email']),
                'password' => password_hash(trim($_REQUEST['password']), PASSWORD_BCRYPT),
                'is_admin' => trim($_REQUEST['is_admin']),
                'created_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s'),
            ];
            
            //insert data into the Database
            $registered = $this->user->registerUser($data);
        }
    }

        
    /**
     * loginUser - Login  user
     *
     * @return void
     */
    public function loginUser()
    {
        //when request is made
        if(!empty($_REQUEST['login'])!=='' && $_REQUEST['login'] == "login"){
            $data = [
                'email' => trim($_REQUEST['email']),
                'password' => password_hash(trim($_REQUEST['password']), PASSWORD_BCRYPT),
            ];

            $this->user->loginUser($data);
        }
    }
}

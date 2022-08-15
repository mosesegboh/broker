<?php
/*
 *@package Broker Test Assignment
 *Class for managing users
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
namespace Broker\Classes; 

use Broker\Libs\Controller;
use Broker\Interfaces\UserInterface;

class UserClass extends Controller implements UserInterface
{ 
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    /**
     * loginUser
     *
     * @param  mixed $user
     * @return void
     */
    public function loginUser($data)
    {
        $user = $this->userModel->findUserByEmail($data['email']);

        if($user){
            $_SESSION['id'] = $data['id'];
            $_SESSION['admin'] = $data['admin'];
            $_SESSION['message'] = 'You are now logged in!';
            $_SESSION['type'] = 'success';
            if ($_SESSION['admin'] == 1) {
                header('location: ' . URLROOT . '/admin/dashboard.php');
            } else {
                header('location: ' . URLROOT . '/welcome');
            }		
            exit();
        } 
    }
    
    /**
     * registerUser
     *
     * @param  Array $data
     * @return void
     */
    public function registerUser($data)
    {
        $register = $this->userModel->add($data);

        if ($register) {
            $_SESSION['message'] = 'User created successfully!';
			$_SESSION['type'] = 'success';
            header('location: ' . URLROOT . '/home');
			exit();
        }
    }
}

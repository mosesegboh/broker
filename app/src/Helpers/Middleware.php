<?php
/*
 *@package Broker Test Assignment
 *Class for managing middleware for appicaiton
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */
namespace Broker\Helpers;

class Middleware
{        
    /**
     * Restrict access to only logged in users
     *
     * @param  string $redirect
     * @return void
     */
    public function userOnly($redirect = '/welcome'): void
    {
        if (empty($_SESSION['id'])) {
            $_SESSION['message'] = 'You need to login first';
            $_SESSION['type'] = 'error';
            header('location:' . URLROOT . $redirect );
            exit(0);
        }
    }

    /**
     * Restrict access to only admin
     *
     * @param  string $redirect
     * @return void
     */
    public function adminOnly($redirect = '/welcome') :void
    {
        if (empty($_SESSION['id']) || empty($_SESSION['admin'])) {
            $_SESSION['message'] = 'You are not authorized';
            $_SESSION['type'] = 'error';
            header('location:' . URLROOT . $redirect );
            exit(0);
        }
    }
    
     /**
     * Restrict access to only guests
     *
     * @param  string $redirect
     * @return void
     */
    public function guestOnly($redirect = '/welcome') :void
    {
        if (isset($_SESSION['id'])) {
            header('location:' . URLROOT . $redirect );
            exit(0);
        }
    }
}
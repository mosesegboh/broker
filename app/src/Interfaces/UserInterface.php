<?php
/*
 *@package Broker Test Assignment
 *Interface for Account Class
 *@author Egboh Moses <mosesegboh@yahoo.com>
 */

namespace Broker\Interfaces;

Interface UserInterface
{    
    /**
     * deposit amount into account
     *
     * @param  Array $data
     */
    public function loginUser($data);

    
    /**
     * registerUser
     *
     * @param  Array $data
     */
    public function registerUser($data);
}
<?php
    /*
    *@package Broker Test Assignment
    *set config values
    *@author Egboh Moses <mosesegboh@yahoo.com>
    */

    //Database params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'broker');

    //APPROOT
    define('APPROOT', dirname(dirname(__FILE__)));

    //URLROOT (Dynamic links)
    define('URLROOT', 'http://localhost/broker');

    //Sitename
    define('SITENAME', 'Broker Test');

    //Transactions
    define('CASH_DEPOSIT', 0);
    define('CASH_WITHDRAWAL', 1);

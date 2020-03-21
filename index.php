<?php
    // include_once "config.php";
    include_once "autoload.php";


    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    // header('Access-Control-Allow-Headers: Origin, Content-Type,Cookies');
    // header('Access-Control-Expose-Headers: Content-Disposition');

    session_start();

    error_log('Testing...'.print_r($_POST,true));
    //TOD:: create a session write fxn 
    if(isset($_POST['s']) && $_POST['m']=='l'){
        $s = $_POST['s'];
        $a = $_POST['a'];

        if(class_exists($s)) {
            $obj = new $s();
            if(method_exists($s,$a)) {
                echo $obj->{$a}($_POST);
            }
        }
    } 
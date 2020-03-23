<?php
    // include_once "config.php";
    include_once "autoload.php";


    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    // header('Access-Control-Allow-Headers: Origin, Content-Type,Cookies');
    // header('Access-Control-Expose-Headers: Content-Disposition');

    session_start();
    $POST = json_decode(file_get_contents('php://input'),true);

    //TOD:: create a session write fxn 
    if(isset($POST['s']) && $POST['m']=='l'){
        $s = $POST['s'];
        $a = $POST['a'];
        
        if(class_exists($s)) {
            $obj = new $s();
            if(method_exists($s,$a)) {
                echo $obj->{$a}($POST);
            }
        }
    } 
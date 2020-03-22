<?php

    include_once "lib/adodb/adodb.inc.php";
	include_once "lib/adodb/adodb-exceptions.inc.php";

    function __autoload($class_name){
        $class_name=strtolower($class_name);
        $class_file='classes/'.$class_name.'.php';

        if (file_exists(realpath($class_file))){ 
            include_once($class_file);
        }
        // else throw new ErrorException("Invalid service call",1,2);
        else die("Invalid service call".realpath($class_file));
        // elseif(file_exists(CONFIG_LIBPATH."dompdf/include/$class_name.cls.php"))
        //     include_once (CONFIG_LIBPATH."dompdf/include/$class_name.cls.php");
        // elseif(file_exists(CONFIG_LIBPATH."dompdf/$class_name.php"))
        //     include_once(CONFIG_LIBPATH."dompdf/$class_name.php");

        // else die("Invalid service call 2 $class_file".realpath($class_file));


    }

    spl_autoload_register('__autoload');
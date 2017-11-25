<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/22/2017
 * Time: 10:03 PM
 */
function redirect($location){
    header("Location: {$location}");
}

function ClassAutoloader($class){
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";

    if(is_file($the_path) && !class_exists($class)){
        include $the_path;
    }
    else{
        die("The file named {$class}.php was not found");
    }
}
spl_autoload_register('ClassAutoloader');


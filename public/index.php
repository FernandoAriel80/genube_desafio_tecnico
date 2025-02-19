<?php 
require_once '../autoload.php';


$request_url = explode("?", $_SERVER["REQUEST_URI"])[0];

if ($request_url == "/") {
    include '../views/home.php' ;
    
} else {
    echo "ruta no existe";
}


?>



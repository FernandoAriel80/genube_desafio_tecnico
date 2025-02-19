<?php
require_once '../autoload.php';

use App\Controllers\UserController;
use App\Controllers\AuthController;

session_start();



$request_url = explode("?", $_SERVER["REQUEST_URI"])[0];

if ($request_url == "/") {
  $userController = new UserController();
  $userController->index();
}

if ($request_url == "/login") {
  $authController = new AuthController();
  $authController->login();
  require '../views/auth/login.php';
}


/*  else {
  http_response_code(404);

  echo "ruta no existe";
} */
<?php
require_once '../autoload.php';

use App\Controllers\HomeController;
use App\Controllers\RoleUserController;
use App\Controllers\AuthController;

session_start();



$request_url = explode("?", $_SERVER["REQUEST_URI"])[0];

if ($request_url == "/" || $request_url == "/home") {
  $homeController = new HomeController();
  $homeController->index();
}

if ($request_url == "/permisos") {
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $roleUserController = new RoleUserController();
    $roleUserController->index();
  }
}

if ($request_url == "/cargar-roles") {
  require "../views/roles/create.php";
}
/* if ($request_url == "/inicia-sesion") {
  $authController = new AuthController();
  $authController->login();
  require '../views/auth/login.php';
} elseif ($request_url == "/registrar") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authController = new AuthController();
    $errors =  $authController->register();
  }
  require '../views/auth/register.php';
} */


/*  else {
  http_response_code(404);

  echo "ruta no existe";
} */
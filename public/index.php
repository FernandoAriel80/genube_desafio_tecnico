<?php
require_once '../autoload.php';

use App\Controllers\HomeController;
use App\Controllers\RoleUserController;
use App\Controllers\RoleController;
use App\Controllers\AuthController;
use App\Controllers\UserController;

//session_start();



$request_url = explode("?", $_SERVER["REQUEST_URI"])[0];

if ($request_url == "/" || $request_url == "/home") {
  $homeController = new HomeController();
  $homeController->index();
}

if ($request_url == "/permisos-usuarios") {
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $roleUserController = new RoleUserController();
    $roleUserController->index();
  }
} elseif ($request_url == "/asignar-permisos") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roleUserController = new RoleUserController();
    $roleUserController->store();
  }
}

if ($request_url == "/ver-roles") {
  $roleController = new RoleController();
  $roleController->index();
} elseif ($request_url == "/crear-rol") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roleController = new RoleController();
    $errors = $roleController->store();
  }
  require "../views/roles/create.php";
} elseif ($request_url == "/update-rol") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roleController = new RoleController();
    $roleController->update();
  } else {
    $roleController = new RoleController();
    $roleController->edit();
  }
} elseif ($request_url == "/deshabilitar-rol") {
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $roleController = new RoleController();
    $roleController->disable();
  }
} elseif ($request_url == "/habilitar-rol") {
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $roleController = new RoleController();
    $roleController->enable();
  }
}

if ($request_url == "/crear-usuario") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController = new UserController();
    $errors = $userController->store();
  }
  include '../views/users/create.php';
}
/* else {
  http_response_code(404);

  echo "ruta no existe";
} */



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

<?php
require_once '../autoload.php';

use App\Controllers\HomeController;
use App\Controllers\RoleUserController;
use App\Controllers\RoleController;
use App\Controllers\UserController;

$request_url = explode("?", $_SERVER["REQUEST_URI"])[0];

if ($request_url == "/" || $request_url == "/home") {
  $homeController = new HomeController();
  $homeController->index();
} elseif ($request_url == "/permisos-usuarios") {
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $roleUserController = new RoleUserController();
    $roleUserController->index();
  }
} elseif ($request_url == "/asignar-permisos") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roleUserController = new RoleUserController();
    $roleUserController->store();
  }
} elseif ($request_url == "/ver-roles") {
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
    $errors = $roleController->update();
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
} elseif ($request_url == "/crear-usuario") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController = new UserController();
    $errors = $userController->store();
  }
  include '../views/users/create.php';
} elseif ($request_url == "/actualizar-usuario") {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController = new UserController();
    $errors = $userController->update();
  } else {
    $userController = new UserController();
    $userController->edit();
  }
} elseif ($request_url == "/eliminar-usuario") {
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userController = new UserController();
    $userController->destroy();
  }
} else {
  include '../views/404.php';
}

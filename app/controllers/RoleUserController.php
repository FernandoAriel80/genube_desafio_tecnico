<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;

use App\Models\AssignedRole;
use DateTime;
use Exception;

class RoleUserController
{

    public function index()
    {

        try {
            $id = $_GET["id"];

            $user_model = new User();
            $user_roles = $user_model->getOneRole($id);

            $role_model = new Role();
            $roles = $role_model->all();

            $roles_id = [];

            foreach ($user_roles["roles"] as $role) {
               
                array_push( $roles_id , $role["role_id"]);
            }

            require '../views/users/index.php';
        } catch (Exception $e) {
            return "Error al obtener los usuarios y roles." . $e->getMessage();
        }
    }

    public function store()
    {
        $data = [
            "user_id" => $_POST["user_id"],
            "roles_id" => $_POST["roles"],
        ];
        if (empty($data["roles_id"])) {
            header("Location: /permisos-usuarios?id={$data["user_id"]}");
            exit();
        }

        try {
            $assigned_model = new AssignedRole();

            $response = $assigned_model->assign($data["user_id"], $data["roles_id"]);

            if ($response) {
                header("Location: /permisos-usuarios?id={$data["user_id"]}");
                exit();
            }
        } catch (Exception $e) {
            return "Error al guardar usuarios y sus roles" . $e->getMessage();
        }
    }

    public function edit() {}
}

<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;

use App\Models\AssignedRole;
use Exception;

class RoleUserController
{

    public function index()
    {

        try {
            $id = $_GET["id"];

            $user_model = new User();
            $user_roles = [];
            $current_user = $user_model->getOneRole($id);

            if (empty($current_user["roles"])) {
                $user_roles = $user_model->getOne($id);
            } else {
                $user_roles = $current_user;
                $role_db = [];
                foreach ($user_roles["roles"] as $role) {
                    array_push($role_db, $role["role_id"]);
                }
            }

            $role_model = new Role();
            $roles = $role_model->all();


            require '../views/roles_users/index.php';
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

        $user_model = new User();
        $user_roles = $user_model->getOneRole($data["user_id"]);


        $current_id = [];
        foreach ($user_roles['roles'] as $value) {
            if ($value["is_assigned"] == 1) {
                array_push($current_id, $value["role_id"]);
            }
        }
        //print_r($current_id);

        if (count($data["roles_id"]) == count($current_id)) {
            header("Location: /permisos-usuarios?id={$data["user_id"]}");
            exit();
        }

        $current_data = [];
        $assigned_model = new AssignedRole();

        if (count($data["roles_id"]) > count($current_id)) {
            foreach ($data["roles_id"] as $role) {
                if (!in_array($role, $current_id)) {
                    array_push($current_data, $role);
                }
            }
            $response = $assigned_model->assign($data["user_id"], $current_data);
            if ($response) {
                header("Location: /permisos-usuarios?id={$data["user_id"]}");
                exit();
            }
        } else {
            foreach ($current_id as $role) {
                if (!in_array($role, $data["roles_id"])) {
                    array_push($current_data, $role);
                }
            }
            $response = $assigned_model->delete($data["user_id"], $current_data);
            if ($response) {
                header("Location: /permisos-usuarios?id={$data["user_id"]}");
                exit();
            }
        }
    }
}

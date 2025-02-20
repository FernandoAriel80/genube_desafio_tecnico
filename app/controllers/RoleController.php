<?php

namespace App\Controllers;

//use App\Models\User;
use App\Models\Role;
use Exception;

class RoleController
{
    public function index()
    {
        $roles_model = new Role();
        $roles = $roles_model->all();
        require "../views/roles/index.php";
    }

    public function create()
    {
        $data = [
            "nombre" => $_POST["name"],
            "descripcion" => $_POST["description"],
        ];

        $validation = [];
        foreach ($data as $key => $value) {
            if ($data[$key] == "") {
                array_push($validation, "El $key es requerido.");
            }
        }

        if (empty($validation) == false) {
            return $validation;
        }

        try {
            $role_model = new Role();

            $response = $role_model->create([
                "name" => $data["nombre"],
                "description" => $data["descripcion"],
            ]);

            if ($response) {
                header("Location:/ver-roles");
                exit();
            }
        } catch (Exception $e) {
            return "Error al cargar un rol " . $e->getMessage();
        }
    }
}

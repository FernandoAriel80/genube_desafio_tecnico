<?php

namespace App\Controllers;

//use App\Models\User;
use App\Models\AssignedRole;
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

    public function store()
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

    public function edit()
    {
        $id = $_GET["id"];

        try {
            $role_model = new Role();

            $role = $role_model->getOne($id);
            return  include '../views/roles/update.php';
        } catch (Exception $e) {
            return "Error al cargar un rol para editar" . $e->getMessage();
        }
    }
    public function update()
    {

        $id = $_POST["id"];
        $data = [
            "name" => $_POST["name"],
            "description" => $_POST["description"],
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

            $response = $role_model->update($id, $data);

            if ($response) {
                header("Location:/ver-roles");
                exit();
            }
        } catch (Exception $e) {
            return "Error al actualizar un rol" . $e->getMessage();
        }
    }

    public function disable()
    {
        $id = $_GET["id"];
        try {
            $role_model = new Role();

            $response1 = $role_model->delete($id);
            if ($response1) {
                $assigned_model = new AssignedRole();

                $response2 = $assigned_model->remove($id);
                if ($response2) {
                    header("Location:/ver-roles");
                    exit();
                }
            }
        } catch (Exception $e) {
            return "Error al desactivar un rol" . $e->getMessage();
        }
    }

    public function enable()
    {
        $id = $_GET["id"];

        $role_model = new Role();

        $response1 = $role_model->enable($id);
        if ($response1) {
            $assigned_model = new AssignedRole();

            $response2 = $assigned_model->enable($id);
            if ($response2) {
                header("Location:/ver-roles");
                exit();
            }
        }
    }
}

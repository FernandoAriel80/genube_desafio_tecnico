<?php

namespace App\Controllers;

use App\Models\User;

use Exception;

class UserController
{

    public function index()
    {
        include '../views/users/create.php';
    }

    public function store()
    {
        try {
            $data = [
                "nombre" => $_POST["name"],
                "apellido" => $_POST["last_name"],
                "correo" => $_POST["email"],
                "clave" => $_POST["password"],
                "confirmacion" => $_POST["password_confirm"]
            ];
            $validation = [];
            foreach ($data as $key => $value) {
                if ($data[$key] == "") {
                    array_push($validation, "El $key es requerido.");
                }
            }
            if ($data["clave"] != $data["confirmacion"]) {
                array_push($validation, "La contraseñas son diferentes.");
            }
            $longitud = strlen($data["clave"]);
            if ($longitud <= 8) {
                array_push($validation, "La contraseña tiene que ser mayor a 8 caracteres.");
            }
            if (empty($validation) == false) {
                return $validation;
            }

            $user_model = new User();

            $response = $user_model->create([
                'name' => $data["nombre"],
                'last_name' => $data["apellido"],
                'email' => $data["correo"],
                'password' => password_hash($data["clave"], PASSWORD_DEFAULT),
            ]);
            if ($response) {
                header("Location:/");
                exit();
            }
        } catch (Exception $e) {
            return "Error al registrar usuario." . $e->getMessage();
        }
    }

    public function edit()
    {
        try {
            $id = $_GET["id"];

            $user_model = new User();

            $user = $user_model->getOne($id);
            return  include '../views/users/update.php';
        } catch (Exception $e) {
            return "Error al obtener usuario para editar." . $e->getMessage();
        }
    }

    public function update()
    {
        $id = $_POST["id"];
        $data = [
            "nombre" => $_POST["name"],
            "apellido" => $_POST["last_name"],
            "correo" => $_POST["email"],
            "clave" => $_POST["password"],
            "confirmacion" => $_POST["password_confirm"]
        ];
        $validation = [];
        foreach ($data as $key => $value) {
            if ($data[$key] == "" && $data["clave"] != "" && $data["confirmacion"] != "") {
                array_push($validation, "El $key es requerido.");
            }
        }
        if ($data["clave"] != $data["confirmacion"]) {
            array_push($validation, "La contraseñas son diferentes.");
        }
        $longitud = strlen($data["clave"]);
        if ($longitud <= 8 && $data["clave"] != "" && $data["confirmacion"] != "") {
            array_push($validation, "La contraseña tiene que ser mayor a 8 caracteres.");
        }
        if (empty($validation) == false) {
            return $validation;
        }

        try {
            $user_model = new User();
            $response = $user_model->update($id,[
                'name' => $data["nombre"],
                'last_name' => $data["apellido"],
                'email' => $data["correo"],
                'password' => password_hash($data["clave"], PASSWORD_DEFAULT),
            ]);
            if ($response) {
                header("Location:/");
                exit();
            }
        } catch (Exception $e) {
            return "Error al actualizar usuario." . $e->getMessage();
        }
    }

    public function destroy(){
        $id = $_GET["id"];
        try {
            $user_model = new User();

            $response = $user_model->delete($id);
            if ($response) {
                header("Location:/");
                exit();
            }
        } catch (Exception $e) {
            return "Error al eliminar usuario." . $e->getMessage();
        }
    }
}

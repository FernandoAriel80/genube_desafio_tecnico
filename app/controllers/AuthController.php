<?php

namespace App\Controllers;

use App\Models\User;
use Exception;

class AuthController
{
    public function register()
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
            if (empty($validation) == true) {
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
                header("Location:/inicia-sesion");
                exit();
            }
        } catch (Exception $e) {
            return "Error al registrar usuario." . $e->getMessage();
        }
    }

    public function login()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $user_model = new User();
                $user_verify = $user_model->verifyUser($email);

                if (password_verify($password, $user_verify["password"])) {

                    $token = bin2hex(random_bytes(32));

                    $response = $user_model->update($user_verify["id"], [
                        'token' => $token,
                    ]);
                    if ($response) {
                        $_SESSION["token"] = $token;
                        $_SESSION["user"] = $user_verify["name"] . " " . $user_verify["last_name"];
                        header("Location:/");
                        exit();
                    }
                }
            }
        } catch (Exception $e) {
            return "Error al iniciar sesion." . $e->getMessage();
        }
    }

    public function logout()
    {
        try {
            session_start();
            session_destroy();
            /*  header("Location: login.php");
            exit(); */
        } catch (Exception $e) {
            return "Error al cerrar sesion." . $e->getMessage();
        }
    }
}

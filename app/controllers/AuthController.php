<?php
namespace App\Controllers;
use App\Models\User;
use Exception;
class AuthController
{
    public function register()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST["name"];
                $last_name = $_POST["last_name"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                $user_model = new User();
                $response = $user_model->create([
                    'name' => $name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ]);
                if ($response) {
                    header("location:/login");
                    exit();
                }
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
                        $_SESSION["user"] = $user_verify["name"]." ". $user_verify["last_name"];
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

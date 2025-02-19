<?php

namespace App\Controllers;

use App\Models\User;
use Exception;

class UserController
{

    public function index()
    {

        try {
            $user_model = new User();
            //$users = $user_model->all();
            $users = "usuarios";
            
            require '../views/home.php';
        } catch (Exception $e) {
            return "Error al obtener los usuarios " . $e->getMessage();
        }
    }

    public function store()
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
                    'password' => $password,
                ]);
                if ($response) {
                    include '';
                }
            }
        } catch (Exception $e) {
            return "Error al obtener los usuarios " . $e->getMessage();
        }
    }
}

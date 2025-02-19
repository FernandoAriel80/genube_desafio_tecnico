<?php

require_once '../models/User.php';
class UserController
{

    private $user_model;

    public function __construct()
    {
        $this->user_model = new User();
    }

    public function index()
    {

        try {
            $users = $this->user_model->all();

            return $users;
        } catch (Exception $e) {
            return "Error al obtener los usuarios " . $e->getMessage();
        }
    }

    public function store()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST[""];
                $last_name = $_POST[""];
                $email = $_POST[""];
                $password = $_POST[""];
                $deleted_at = $_POST[""];
            }
        } catch (Exception $e) {
            return "Error al obtener los usuarios " . $e->getMessage();
        }
    }
}

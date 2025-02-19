<?php

namespace App\Controllers;

use App\Models\User;
use Exception;

class RoleUserController
{

    public function index()
    {

        try {
            $id = $_GET["id"];

            $user_model = new User();
            $user = $user_model->getOne($id);

            require '../views/roles/index.php';
        } catch (Exception $e) {
            return "Error al obtener los usuarios para editar " . $e->getMessage();
        }
    }

    public function store()
    {

    }

    public function edit(){
      
    }
}

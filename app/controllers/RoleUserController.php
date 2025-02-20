<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;
use Exception;

class RoleUserController
{

    public function index()
    {

        try {
            $id = $_GET["id"];

            $user_model = new User();
            $user = $user_model->getOne($id);

            $role_model = new Role();
            $roles = $role_model->all();

            require '../views/users/index.php';
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

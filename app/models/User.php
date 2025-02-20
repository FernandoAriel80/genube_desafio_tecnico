<?php

namespace App\Models;

use Config\Database;
use PDO;
use Exception;

class User
{
    private $db;
    private $table;

    public function __construct()
    {
        $this->table = "users";
        if ($this->db == null) {
            $db = new Database();

            $this->db = $db->getConnection();
        }
    }

    public function all()
    {

        $query = "SELECT * FROM " . $this->table . " WHERE deleted_at IS NULL";

        try {
            $stmt = $this->db->prepare($query);

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo "Error modelo al obtener usuarios" . $e->getMessage();
        }
    }

    public function getOne($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id AND deleted_at IS NULL";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo "Error modelo al obtener al usuario" . $e->getMessage();
        }
    }
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (name, last_name, email, password)VALUES(:name, :last_name, :email, :password)";
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":name", $data["name"]);
            $stmt->bindParam(":last_name", $data["last_name"]);
            $stmt->bindParam(":email", $data["email"]);
            $stmt->bindParam(":password", $data["password"]);

            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error modelo al crear el usuario" . $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        $updates = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) {

            $updates[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $query = "UPDATE " . $this->table . " SET " . implode(", ", $updates) . " WHERE id = :id";

        try {
            $stmt = $this->db->prepare($query);
            foreach ($params as $param => $value) {
                $stmt->bindValue($param, $value);
            }
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error modelo al actualizar el usuario: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table . " SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id";
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error modelo al eliminar el usuario" . $e->getMessage();
        }
    }

    public function getRoles()
    {
        $query = " SELECT u.*, r.*, ar.is_assigned, ar.create_date FROM " . $this->table . " u 
        JOIN assigned_roles ar ON ar.id = u.id
        JOIN roles r ON r.id = ar.id
        WHERE ar.is_assigned = 1";

        try {
            $stmt = $this->db->prepare($query);

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo "Error modelo al getRoles el usuario" . $e->getMessage();
        }
    }

    public function getOneRole($id)
    {
        $query1 = "SELECT u.* FROM " . $this->table . " u 
            JOIN assigned_roles ar ON ar.user_id = u.id
            JOIN roles r ON r.id = ar.role_id
            WHERE ar.user_id = :id
            LIMIT 1";

        $query2 = "SELECT r.* ,ar.* FROM roles r 
            JOIN assigned_roles ar ON ar.role_id = r.id
            WHERE ar.user_id = :id";

        try {
            $stmt1 = $this->db->prepare($query1);
            $stmt1->bindParam(":id", $id);
            $stmt1->execute();
            $user = $stmt1->fetch(PDO::FETCH_ASSOC); 

            $stmt2 = $this->db->prepare($query2);
            $stmt2->bindParam(":id", $id);
            $stmt2->execute();
            $roles = $stmt2->fetchAll(PDO::FETCH_ASSOC); 

            return [
                "user" => $user ?: [],  
                "roles" => $roles       
            ];
        } catch (Exception $e) {
            echo "Error en getOneRole: " . $e->getMessage();
            return []; 
        }
    }

    ///////////////
    public function verifyUser($email)
    {
        $query = "SELECT id ,name,last_name,password FROM " . $this->table . " WHERE id = :email AND deleted_at IS NULL";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":email", $email);

            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo "Error modelo al obtener al usuario" . $e->getMessage();
        }
    }
}

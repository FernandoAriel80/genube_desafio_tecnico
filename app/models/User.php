<?php

require_once '../../config/Database.php';

class User
{
    private $db;
    private $table;

    public function __construct()
    {
        $this->table = "users";
        if ($this->db == null) {
            $db = new Database();

            $this->db = $db->getConnectio();
        }
    }

    public function all()
    {

        $query = "SELECT * FROM " . $this->table . " WHERE deleted_at = NULL";

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
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id AND deleted_at = NULL";

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
        $query = "INSERT INTO " . $this->table . "(name, last_name, email, password)VALUES(':name', ':last_name', ':email', ':password')";
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

    public function update($data, $id)
    {
        $query = "UPDATE " . $this->table . " SET name = ':name', last_name = ':last_name', email = ':email', password = ':password' WHERE id = :id";
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":name", $data["name"]);
            $stmt->bindParam(":last_name", $data["last_name"]);
            $stmt->bindParam(":email", $data["email"]);
            $stmt->bindParam(":password", $data["password"]);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error modelo al actualizar el usuario" . $e->getMessage();
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
        $query = " SELECT u.*, r.*FROM " . $this->table . " u 
        JOIN assigned_roles ar ON ar.id = u.id
        JOIN roles r ON r.id = ar.id
        WHERE u.id = :id
        AND ar.is_assigned = 1";

        try {

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo "Error modelo al getOneRole el usuario" . $e->getMessage();
        }
    }
}

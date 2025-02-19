<?php

namespace App\Models;
use Config\Database;
use PDO;
use Exception;

class Role
{
    private $db;
    private $table;

    public function __construct()
    {
        $this->table = "roles";
        if ($this->db == null) {
            $db = new Database();

            $this->db = $db->getConnection();
        }
    }

    public function all()
    {

        $query = "SELECT * FROM ".$this->table. " WHERE deleted_at = NULL";

        try {
            $stmt = $this->db->prepare($query);

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo "Error modelo al obtener los roles" . $e->getMessage();
        }
    }

    public function getOne($id)
    {
        $query = "SELECT * FROM ".$this->table." WHERE id = :id AND deleted_at = NULL";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo "Error modelo al obtener un rol" . $e->getMessage();
        }
    }
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . "(name, description password)VALUES(':name', ':description')";
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":name", $data["name"]);
            $stmt->bindParam(":description", $data["description"]);

            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error modelo al crear el rol" . $e->getMessage();
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
            echo "Error modelo al eliminar el rol" . $e->getMessage();
        }
    }
}

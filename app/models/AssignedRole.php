<?php

namespace App\Models;

use Config\Database;
use PDO;
use Exception;

class AssignedRole
{
    private $db;
    private $table;

    public function __construct()
    {
        $this->table = "assigned_roles";
        if ($this->db == null) {
            $db = new Database();

            $this->db = $db->getConnection();
        }
    }

    public function assign($userId, $roleIds)
    {
        $query = "INSERT INTO " . $this->table . " (user_id, role_id) VALUES ";

        $values = [];
        $params = [];

        foreach ($roleIds as $index => $roleId) {
            $values[] = "(:user_id_$index, :role_id_$index)";
            $params[":user_id_$index"] = $userId;
            $params[":role_id_$index"] = $roleId;
        }

        $query .= implode(", ", $values);
        $stmt = $this->db->prepare($query);

        return $stmt->execute($params);
    }


    public function delete($userId, $roleIds)
    {
        // Construir placeholders para cada role_id en el array
        $placeholders = implode(',', array_fill(0, count($roleIds), '?'));

        // Nueva consulta DELETE en lugar de UPDATE
        $query = "DELETE FROM " . $this->table . " WHERE user_id = ? AND role_id IN ($placeholders)";

        $stmt = $this->db->prepare($query);

        // Unir el user_id con los valores de roleIds en un solo array
        $params = array_merge([$userId], $roleIds);

        return $stmt->execute($params);
    }

    // Eliminar la asignación de un rol a un usuario
    public function remove($id)
    {
        try {
            $query = "UPDATE " . $this->table . " SET is_assigned = 0 WHERE role_id = :id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id",$id);

            return $stmt->execute();
        } catch (Exception $e) {
            return "Error al eleminar un rol" . $e->getMessage();
        }
    }

    public function enable($id)
    {
        try {
            $query = "UPDATE " . $this->table . " SET is_assigned = 1 WHERE role_id = :id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id",$id);

            return $stmt->execute();
        } catch (Exception $e) {
            return "Error al eleminar un rol" . $e->getMessage();
        }
    }
}

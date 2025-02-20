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
    

    // Eliminar la asignación de un rol a un usuario
    public function remove($userId, $roleId)
    {
        $query = "UPDATE " . $this->table . " SET is_assigned = 0 WHERE user_id = :user_id AND role_id = :role_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':role_id', $roleId);
        return $stmt->execute();
    }
}

<?php

require_once '../../config/Database.php';

class Role
{
    private $db;
    private $table;

    public function __construct()
    {
        $this->table = "assigned_roles";
        if ($this->db == null) {
            $db = new Database();

            $this->db = $db->getConnectio();
        }
    }

    public function assign($userId, $roleId)
    {
        $query = "INSERT INTO " . $this->table . " (user_id, role_id) VALUES (:user_id, :role_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':role_id', $roleId);
        return $stmt->execute();
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

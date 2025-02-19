<?php

class Database{

    private string $DB_HOST = getenv('DB_HOST'); 
    private string $DB_NAME = getenv('APP_NAME'); 
    private string $DB_USER = getenv('DB_USER'); 
    private string $DB_PASSWORD = getenv('DB_PASSWORD');
    private PDO $connection;

    public function __construct(){
        try {
            $pdo = new PDO("mysql:host=$this->DB_HOST, dbname=$this->DB_NAME",$this->DB_USER, $this->DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $pdo;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function getConnectio(): PDO{
        return $this->connection;
    }

    
}
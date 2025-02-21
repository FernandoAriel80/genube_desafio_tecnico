<?php


namespace Config;
use PDO;
use PDOException;
class Database{

    private string $DB_HOST = "127.0.0.1"; 
    private string $DB_NAME = "genube_desafio_tecnico"; 
    private string $DB_USER = "root"; 
    private string $DB_PASSWORD = "";

    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host={$this->DB_HOST}; dbname={$this->DB_NAME};",$this->DB_USER, $this->DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function getConnection(){
        return $this->pdo;
    }


    
}
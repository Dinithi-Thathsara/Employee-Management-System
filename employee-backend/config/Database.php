<?php
class Database {
    private $host = "localhost";
    private $db_name = "office_db";
    private $username = "root";
    private $password = "DIni12#"; 
    public $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die(json_encode(["error" => $e->getMessage()]));
        }
    }
}

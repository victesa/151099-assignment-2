<?php 
    require_once('DatabaseInterface.php');
    
    class Database implements DatabaseInterface {

        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $database = 'taskmanager';
        private $conn;
    
        public function __construct() { 
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->database}";
                $pdo = new PDO($dsn, $this->user, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn = $pdo;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                die();
            }
        }
    
        public function getConnection() {
            return $this->conn;
        }
    }
    
    

?>
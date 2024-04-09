<?php
class Conexion {
    private $host = "localhost";
    private $puerto = 3306;
    private $db_name = "mensualidadesmejo";
    private $username = "root";
    private $password = "1994JHOEL";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=$this->puerto;dbname=" . $this->db_name, $this->username, $this->password);
            //echo "Conexion establecida...";
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
<?php
class Mensualidades
{

    private $conn;
    private $nombreDeLaTabla = "pagos";

    private $idPago;
    private $fechaRealizada;
    private $mesCorrespondiente;
    private $montoDepositado;
    private $fechaDesde;
    private $fechaHasta;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // Construir la consulta SELECT
        $query = "SELECT * FROM " . $this->nombreDeLaTabla . " ORDER BY idPago DESC";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornamos el stmt
        return $stmt;
    }

    public function create(string $fechaRealizada, string $mesCorrespondiente, int $montoDepositado)
    {
        $this->fechaRealizada = $fechaRealizada;
        $this->mesCorrespondiente = $mesCorrespondiente;
        $this->montoDepositado = $montoDepositado;

        // Construir la consulta INSERT INTO
        $query = "INSERT INTO " . $this->nombreDeLaTabla . " (fechaRealizada, mesCorrespondiente, montoDepositado) VALUES (:fecha, :mes, :monto)";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Vincular los valores de las propiedades a los parámetros en la consulta
        $stmt->bindParam(':fecha', $this->fechaRealizada);
        $stmt->bindParam(':mes', $this->mesCorrespondiente);
        $stmt->bindParam(':monto', $this->montoDepositado);

        // Ejecutar la consulta
        $stmt->execute();
    }

    public function update(int $idPago, string $fechaRealizada, string  $mesCorrespondiente, int $montoDepositado)
    {
        $this->idPago = $idPago;
        $this->fechaRealizada = $fechaRealizada;
        $this->mesCorrespondiente = $mesCorrespondiente;
        $this->montoDepositado = $montoDepositado;

        // Construir la consulta UPDATE
        $query = "UPDATE " . $this->nombreDeLaTabla . " SET fechaRealizada = :fecha, mesCorrespondiente = :mes, montoDepositado = :monto WHERE idPago = :id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Vincular los valores de las propiedades a los parámetros en la consulta
        $stmt->bindParam(':id', $this->idPago);
        $stmt->bindParam(':fecha', $this->fechaRealizada);
        $stmt->bindParam(':mes', $this->mesCorrespondiente);
        $stmt->bindParam(':monto', $this->montoDepositado);

        // Ejecutar la consulta
        $stmt->execute();
    }

    public function delete(int $idPago)
    {
        $this->idPago = $idPago;

        // Construir la consulta DELETE
        $query = "DELETE FROM " . $this->nombreDeLaTabla . " WHERE idPago = :id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Vincular el valor de la propiedad id al parámetro :id en la consulta
        $stmt->bindParam(':id', $this->idPago);

        // Ejecutar la consulta
        $stmt->execute();
    }

    public function sum(string $fechaDesde, string $fechaHasta)
    {
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;

        // Construir la consulta SELECT
        $query = "SELECT SUM(montoDepositado) FROM " . $this->nombreDeLaTabla . " WHERE fechaRealizada >= :fechaDesde AND fechaRealizada <= :fechaHasta";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Vincular el valor de la propiedad fechaDesde al parámetro :fechaDesde en la consulta
        // Vincular el valor de la propiedad fechaHasta al parámetro :fechaHasta en la consulta
        $stmt->bindParam(':fechaDesde', $this->fechaDesde);
        $stmt->bindParam(':fechaHasta', $this->fechaHasta);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornamos el stmt
        return $stmt;
    }

    public function buscarPorFecha(string $fechaDesde, string $fechaHasta){
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
        // Construir la consulta SELECT
        $query = "SELECT * FROM " . $this->nombreDeLaTabla . " WHERE fechaRealizada >= :fechaDesde AND fechaRealizada <= :fechaHasta ORDER BY idPago DESC";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Vincular el valor de la propiedad fechaDesde al parámetro :fechaDesde en la consulta
        // Vincular el valor de la propiedad fechaHasta al parámetro :fechaHasta en la consulta
        $stmt->bindParam(':fechaDesde', $this->fechaDesde);
        $stmt->bindParam(':fechaHasta', $this->fechaHasta);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornamos el stmt
        return $stmt;
    }
}

<?php
include_once("Autoload.php");

$database = new Conexion();
$db = $database->getConnection();

$usuario = new Mensualidades($db);

if (isset($_GET['idPago'])) {
    $idPago = $_GET['idPago'];
    $borrar = $usuario->delete($idPago);

    header('Location: index.php');
}
?>

<?php
include_once("Autoload.php");

$database = new Conexion();
$db = $database->getConnection();

$usuario = new Mensualidades($db);

// Verificar si se ha enviado el formulario de búsqueda
if (isset($_POST['buscar'])) {
    $fechaDesde = $_POST['fechaDesde'];
    $fechaHasta = $_POST['fechaHasta'];
    $stmt = $usuario->buscarPorFecha($fechaDesde, $fechaHasta); 
} else {
    $stmt = $usuario->read();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema para gestionar mensualidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #800080, #4B0082);"><!--height: 65px;-->
        <a class="navbar-brand" href="#">Pagos Al Banco</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Listar Pagos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2><br>Lista de Pagos</h2> <br>
        <a href="create.php" class="btn btn-primary mb-3"><img src="imagenes/flecha.png" alt="Agregar deposito" class="icono" style="width: 24px; height: 24px;"> Agregar Deposito</a>
        <a href="sum.php" class="btn btn-success mb-3"><img src="imagenes/calcular.png" alt="Calcular total" class="icono" style="width: 24px; height: 24px;"> Calcular Total</a>
        <a href="#" class="btn"> <!--Pongo la etiqueta de enlace para que el formulario para buscar este al lado de agregar deposito y calcular total-->
            <form method="post" action="" class="form-inline mb-3">
            <label>Buscar: &nbsp;</label>
                <div class="form-group mr-2">
                    <label for="fechaDesde">Desde: &nbsp;</label>
                    <input type="date" class="form-control" id="fechaDesde" name="fechaDesde" required>
                </div>
                <div class="form-group mr-2">
                    <label for="fechaHasta">Hasta: &nbsp;</label>
                    <input type="date" class="form-control" id="fechaHasta" name="fechaHasta" required>
                </div>
                <button type="submit" class="btn btn-primary" name="buscar"><img src="imagenes/lupa.png" alt="lupa" class="icono" style="width: 24px; height: 24px;"> Buscar</button>
            </form>
        </a>
        <table class="table">
            <thead style="background-color: #800080; color: white;">
                <tr>
                    <th>ID Pago</th>
                    <th>Fecha Realizada</th>
                    <th>Mes Correspondiente</th>
                    <th>Monto Depositado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $row['idPago'] ?></td>
                        <td><?= $row['fechaRealizada'] ?></td>
                        <td><?= $row['mesCorrespondiente'] ?></td>
                        <td><?= $row['montoDepositado'] ?> Bs.</td>
                        <td>
                            <a href="update.php?idPago=<?= $row['idPago'] ?>" class="btn btn-warning btn-sm"><img src="imagenes/editar.png" alt="Calcular total" class="icono" style="width: 24px; height: 24px;"> Editar</a>
                            <a href="delete.php?idPago=<?= $row['idPago'] ?>" class="btn btn-danger btn-sm"><img src="imagenes/borrar.png" alt="Calcular total" class="icono" style="width: 24px; height: 24px;"> Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>

<!--
CREATE TABLE pagos(
  idPago int NOT NULL PRIMARY KEY auto_increment,
  fechaRealizada date NULL,
  mesCorrespondiente varchar(30) NULL,
  montoDepositado decimal(9,2) NULL
);
-->
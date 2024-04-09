<?php
include_once("Autoload.php");

$database = new Conexion();
$db = $database->getConnection();

$usuario = new Mensualidades($db);
$suma = 0;

if (isset($_POST['submit'])) {
    $fechaDesde = $_POST['fechaDesde'];
    $fechaHasta = $_POST['fechaHasta'];

    $stmt = $usuario->sum($fechaDesde, $fechaHasta);
    $suma = $stmt->fetchColumn(); // Extraer el valor de la columna sumada

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

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #800080, #4B0082);"> <!-- height: 65px;-->
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
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h2><br><br>Defina el Rango para calcular el Total</h2> <br>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="desde">Desde:</label>
                        <input type="date" class="form-control" id="desde" name="fechaDesde" required>
                    </div>
                    <div class="form-group">
                        <label for="hasta">Hasta:</label>
                        <input type="date" class="form-control" id="hasta" name="fechaHasta" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit"><img src="imagenes/presupuesto.png" alt="Presupuesto" class="icono" style="width: 24px; height: 24px;"> Calcular</button>
                    <button type="reset" class="btn btn-primary"><img src="imagenes/limpiar.png" alt="Limpiar" class="icono" style="width: 24px; height: 24px;"> Limpiar</button>
                </form>
                <?php
                echo "<br>El total calculado es de: " . $suma . " Bs."; // linea en que se encuentra el error
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
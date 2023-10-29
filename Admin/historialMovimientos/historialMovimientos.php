<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login-logout/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHistorial.css">
    <title>Historial de Movimientos</title>
</head>
<body>
    <section>
        <div class="container">
            <div class="btnContent">
                <a href="../panelAdmin.php" class="btnRegresar">Regresar al panel de administrador</a>
            </div>
            <h2>Historial de Movimientos</h2>
            <form method="post" action="historialMovimientosResultado.php">
                <label for="fecha_desde">Fecha desde:</label>
                <input type="date" name="fecha_desde" id="fecha_desde">
                <label for="fecha_hasta">Fecha hasta:</label>
                <input type="date" name="fecha_hasta" id="fecha_hasta">
                <input type="submit" value="Filtrar">
            </form>
        </div>
    </section>
</body>
</html>

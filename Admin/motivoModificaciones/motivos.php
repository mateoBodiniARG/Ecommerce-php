<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login-logout/login.php");
    exit;
}

// Conexión a la base de datos
include('../../config/config.php');

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$fecha_desde = isset($_POST["fecha_desde"]) ? $_POST["fecha_desde"] : null;
$fecha_hasta = isset($_POST["fecha_hasta"]) ? $_POST["fecha_hasta"] : null;

// Consulta para obtener los motivos de modificaciones con el nombre del producto activo 
$consulta = 
"SELECT ticketmotivo.id, productos.nombre AS nombre_producto, ticketmotivo.motivo, DATE_FORMAT(ticketmotivo.fecha_creacion, '%d/%m/%Y') AS fecha_registro 
FROM ticketmotivo
INNER JOIN productos ON ticketmotivo.id_producto = productos.id
WHERE productos.activo = 1";

// Si se han enviado las fechas, se agrega el filtro a la consulta 
if ($fecha_desde && $fecha_hasta) {
    $consulta .= " AND ticketmotivo.fecha_creacion >= '$fecha_desde' AND ticketmotivo.fecha_creacion <= '$fecha_hasta'";
}

$consulta .= " ORDER BY ticketmotivo.fecha_creacion DESC";
$resultado = $conexion->query($consulta);

// Obtener el total de modificaciones
$totalModificaciones = $resultado->num_rows; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleMotivos.css">
    <title>Motivos de Modificaciones</title>
</head>
<body>
<section>
        <div class="container">
            <div class="btnContent">
                <a href="../panelAdmin.php" class="btnRegresar">Regresar al panel de administrador</a>
            </div>
            <h2>Filtrar fechas de motivos</h2>
            <form method="post" action="motivos.php">
                <label for="fecha_desde">Fecha desde:</label>
                <input type="date" name="fecha_desde" id="fecha_desde">
                <label for="fecha_hasta">Fecha hasta:</label>
                <input type="date" name="fecha_hasta" id="fecha_hasta">
                <input type="submit" value="Filtrar">
            </form>
        </div>
    </section> 
    
    <section>
        <div class="container">
            <h2>Motivos de Modificaciones</h2>
            <p class="totMod">Total de modificaciones hechas a productos activos hasta el momento: <?php echo $totalModificaciones; ?></p>
            <?php 
            // Si hay resultados, los muestra en la página
            if ($resultado->num_rows > 0) : ?>
                <div class="motivosContenido">
                    <ul class="motivosLista">
                    <?php // Mientras haya resultados los muestra en la página
                     while ($fila = $resultado->fetch_assoc()) : ?>
                        <li>
                            <strong>Producto:</strong> <?php echo $fila["nombre_producto"]; ?><br>
                            <strong>Motivo:</strong> <?php echo $fila["motivo"]; ?><br>
                            <strong>Fecha de modificacion:</strong> <?php echo $fila["fecha_registro"]; ?>
                        </li>
                    <?php endwhile; ?>
                </ul> 
                </div>
               
            <?php else : ?>
                <p>No se encontraron motivos de modificaciones.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>

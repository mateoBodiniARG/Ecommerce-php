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

// Consulta para obtener los motivos de modificaciones con el nombre del producto activo 
$consulta = 
"SELECT ticketmotivo.id, productos.nombre AS nombre_producto, ticketmotivo.motivo, ticketmotivo.fecha_creacion
FROM ticketmotivo
INNER JOIN productos ON ticketmotivo.id_producto = productos.id
WHERE productos.activo = 1";

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
                            <strong>Fecha de modificacion:</strong> <?php echo $fila["fecha_creacion"]; ?>
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

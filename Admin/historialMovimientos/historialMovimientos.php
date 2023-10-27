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

// Consulta para obtener el historial de movimientos con nombres de productos
$consulta = 
"SELECT movimientos_inventario.id, movimientos_inventario.id_producto, productos.nombre 
AS nombre_producto, movimientos_inventario.cantidad, movimientos_inventario.motivo, movimientos_inventario.descripcion, movimientos_inventario.fecha_registro 
FROM movimientos_inventario 
INNER JOIN productos 
ON movimientos_inventario.id_producto = productos.id 
ORDER BY movimientos_inventario.fecha_registro DESC";

$resultado = $conexion->query($consulta);
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
            <?php 
            if ($resultado->num_rows > 0) :
            ?>
            <table class="historialTable">
                <tr>
                    <th>ID</th>
                    <th>ID de Producto</th>
                    <th>Nombre de Producto</th>
                    <th>Cantidad</th>
                    <th>Motivo</th>
                    <th>Descripción</th>
                    <th>Fecha de Registro</th>
                </tr>
                <?php while ($fila = $resultado->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo $fila["id_producto"]; ?></td>
                    <td><?php echo $fila["nombre_producto"]; ?></td>
                    <td><?php echo $fila["cantidad"]; ?></td>
                    <td><?php echo $fila["motivo"]; ?></td>
                    <td><?php echo $fila["descripcion"]; ?></td>
                    <td><?php echo $fila["fecha_registro"]; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            <?php else : ?>
                <p>No se encontraron movimientos en el historial.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>

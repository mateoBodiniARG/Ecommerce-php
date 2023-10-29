<?php
// Conexión a la base de datos
include('../../config/config.php');

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener las fechas desde el formulario si se han enviado
$fecha_desde = isset($_POST["fecha_desde"]) ? $_POST["fecha_desde"] : null;
$fecha_hasta = isset($_POST["fecha_hasta"]) ? $_POST["fecha_hasta"] : null;

// Consulta para obtener el historial de movimientos con nombres de productos y fecha formateada
$consulta = 
"SELECT movimientos_inventario.id, movimientos_inventario.id_producto, productos.nombre AS nombre_producto, 
movimientos_inventario.cantidad, movimientos_inventario.motivo, movimientos_inventario.descripcion, 
DATE_FORMAT(movimientos_inventario.fecha_registro, '%d/%m/%Y') AS fecha_registro 
FROM movimientos_inventario 
INNER JOIN productos 
ON movimientos_inventario.id_producto = productos.id";

//Preguntar a Dante porque no me estaria tomando los extremos, por ejemplo:
//Fecha desde: 19/10/2023
//Fecha hasta: 23/10/2023
// El 19 y 23 no lo muestra.
if ($fecha_desde && $fecha_hasta) {
    $consulta .= " WHERE movimientos_inventario.fecha_registro >= '$fecha_desde' AND movimientos_inventario.fecha_registro <= '$fecha_hasta'";;
}


$consulta .= " ORDER BY movimientos_inventario.fecha_registro DESC";
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
            <form method="post" action="historialMovimientosResultado.php">
                <label for="fecha_desde">Fecha desde:</label>
                <input type="date" name="fecha_desde" id="fecha_desde">
                <label for="fecha_hasta">Fecha hasta:</label>
                <input type="date" name="fecha_hasta" id="fecha_hasta">
                <input type="submit" value="Filtrar">
            </form>

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

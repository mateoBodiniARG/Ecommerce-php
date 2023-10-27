<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];  
$operacion = $_POST['operacion'];
$descripcion = $_POST['descripcion'];

include('../../config/config.php');
$conexion = new mysqli($servername, $username, $password, $dbname);
// Obtener el stock actual del producto
$sql = "SELECT stock FROM productos WHERE id = $id_producto";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stock_actual = $row['stock'];

    // Actualizar el stock según la operación seleccionada
    if ($operacion === "aumentar") {
        $nuevo_stock = $stock_actual + $cantidad;
    } elseif ($operacion === "disminuir") {
        if ($cantidad > $stock_actual) {
            echo "Error: No hay suficiente stock para disminuir.";
            echo "<a href='./procesar.php'>Volver a cargar</a>";
            exit;
        }
        $nuevo_stock = $stock_actual - $cantidad;
    } else {
        echo "Error: Operación no válida.";
        exit;
    }

    // Actualizar el stock en la base de datos
    $sql = "UPDATE productos SET stock = $nuevo_stock WHERE id = $id_producto";
    if ($conexion->query($sql) === TRUE) {
        // Registrar el movimiento en la tabla de movimientos_inventario
        $sql = "INSERT INTO movimientos_inventario (id_producto, cantidad, motivo, descripcion) VALUES ($id_producto, $cantidad, '$operacion', '$descripcion')";
        if ($conexion->query($sql) === TRUE) {
            echo "<div class='mensaje-correcto'>
            <h2> Movimiento de inventario registrado con éxito. </h2>
            <p> <a href='../panelAdmin.php'>Regresar al panel</a> </p>
            </div>";
        } else {
            echo "Error al registrar el movimiento: " . $conexion->error;
        }
    } else {
        echo "Error al actualizar el stock del producto: " . $conexion->error;
    }
} else {
    echo "Error: Producto no encontrado.";
}

$conexion->close();
?>

</body>
</html>

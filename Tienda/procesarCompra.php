<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $idProducto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    include('../config/config.php');

    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para obtener el stock actual y la cantidad vendida del producto
    $consultaStock = "SELECT stock, cantidad_vendida FROM productos WHERE id = $idProducto";
    $resultadoStock = $conexion->query($consultaStock);

    if ($resultadoStock->num_rows == 1) {
        $fila = $resultadoStock->fetch_assoc();
        $stockActual = $fila['stock'];
        $cantidadVendida = $fila['cantidad_vendida'];

        if ($stockActual >= $cantidad) {
            // Si hay suficiente stock, resta la cantidad comprada del stock y aumenta la cantidad vendida
            $nuevoStock = $stockActual - $cantidad;
            $nuevaCantidadVendida = $cantidadVendida + $cantidad;

            // Actualiza el stock y la cantidad vendida
            $actualizarStock = "UPDATE productos SET stock = $nuevoStock, cantidad_vendida = $nuevaCantidadVendida WHERE id = $idProducto";

            if ($conexion->query($actualizarStock) === TRUE) {
                header('Location: tienda.php');
            } else {
                echo "Error al actualizar el stock del producto: " . $conexion->error;
            }
        } else {
            echo "No hay suficiente stock para esta compra.";
        }
    } else {
        echo "Producto no encontrado.";
    }

    $conexion->close();
}
?>

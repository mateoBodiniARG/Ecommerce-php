<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Enlaza tu archivo CSS -->
    <title>Modificar Producto</title>
</head>
<body>
    <h2>Modificar Producto</h2>
    <form method="post" action="editarProducto.php">
        <label for="producto">Seleccione un producto:</label>
        <select name="producto" required>
            <?php
            // Conexión a la base de datos (reemplaza con tus propios detalles)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ecommerce";

            $conexion = new mysqli($servername, $username, $password, $dbname);

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta SQL para obtener la lista de productos
            $consulta = "SELECT id, nombre FROM productos";
            $resultado = $conexion->query($consulta);

            // Genera las opciones de productos en el formulario
            while ($fila = $resultado->fetch_assoc()) {
                echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
            }

            $conexion->close();
            ?>
        </select>
        <input type="submit" value="Modificar Producto">
    </form>
</body>
</html>
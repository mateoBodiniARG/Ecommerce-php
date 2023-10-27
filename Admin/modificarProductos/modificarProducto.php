<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleModificar.css"> 
    <title>Modificar Producto</title>
</head>
<body>
    <h2>MODIFICAR PRODUCTO</h2>
    <form method="post" action="../editarProductos/editarProducto.php">
        <label for="producto">Seleccione el producto a modificar</label>
        <select name="producto" required>
            <?php
            session_start();

            if (!isset($_SESSION["usuario"])) {
                header("Location: login.php");
                exit;
            }
            // Conexión a la base de datos 
            include('../../config/config.php');


            $conexion = new mysqli($servername, $username, $password, $dbname);

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta SQL para obtener la lista de productos
            $consulta = "SELECT id, nombre FROM productos";
            $resultado = $conexion->query($consulta);

            // Recorre los resultados y los muestra en un elemento select
            while ($fila = $resultado->fetch_assoc()) {
                echo '<option value="' . $fila['id'] . '">' . $fila['id'] . ' - ' . $fila['nombre'] . '</option>';
            }
            
            $conexion->close();

            ?>
        </select>
        <input type="submit" value="Modificar Producto">
        <a href="../panelAdmin.php" class="regresarAdmin">Regresar al panel de administrador</a>
    </form>
</body>
</html>
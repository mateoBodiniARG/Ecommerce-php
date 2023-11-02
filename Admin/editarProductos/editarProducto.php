<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleEditarProducto.css">
    <title>Editar producto</title>
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST['producto'])) { 
        $id_producto = $_POST['producto'];

        // Conexión a la base de datos
        include('../../config/config.php');

        $conexion = new mysqli($servername, $username, $password, $dbname);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta SQL para obtener los datos del producto seleccionado
        $consulta = "SELECT * FROM productos WHERE id = $id_producto";
        $resultado = $conexion->query($consulta);

        // Consulta SQL para obtener todas las marcas
        $consultaMarcas = "SELECT * FROM marcas";
        $resultadoMarcas = $conexion->query($consultaMarcas);

        // Muestra el formulario con los datos del producto seleccionado
        if ($resultado->num_rows == 1) {
            $fila = $resultado->fetch_assoc();
            echo '<h2>Editar Producto</h2>';
            echo '<form method="post" action="../modificarProductos/guardarModificacion.php">';
            echo '<input type="hidden" name="id_producto" value="' . $id_producto . '">';
            echo '<label for="nombre">Nombre:</label>';
            echo '<input type="text" name="nombre" value="' . $fila['nombre'] . '" required><br>';
            echo '<label for="precio">Precio:</label>';
            echo '<input type="text" name="precio" value="' . $fila['precio'] . '" required><br>';
            echo '<label for="imagen">URL de la Imagen:</label>';
            echo '<input type="text" name="imagen" value="' . $fila['imagen'] . '" required><br>';
            echo '<label for="stock">Stock:</label>';
            echo '<input type="text" readonly name="stock" value="' . $fila['stock'] . '" required><br>';
            
            echo '<label for="id_marca">Marca:</label>';
            echo '<select name="id_marca">';
            while ($marca = $resultadoMarcas->fetch_assoc()) {
                $selected = ($marca['id'] == $fila['id_marca']) ? 'selected' : '';
                echo "<option value='{$marca['id']}' $selected>{$marca['nombre']}</option>";
            }
            echo '</select>';

            echo '<label for="motivo">Motivo de la modificación:</label>';
            echo '<input type="text" name="motivo" required><br>';
            
            echo '<label for="estado">Estado:</label>';
            echo '<select name="estado" required>';
            if ($fila['estado'] == 'disponible') {
                echo '<option value="disponible" selected>Disponible</option>';
                echo '<option value="no disponible">No Disponible</option>';
            } else {
                echo '<option value="no disponible" selected>No Disponible</option>';
                echo '<option value="disponible">Disponible</option>';
            }

            echo '<input type="submit" value="Guardar Modificaciones">';
            echo '<a href="../modificarProductos/modificarProducto.php" class="regresarAdmin">Regresar</a>';
            echo '</form>';

        } else {
            echo "Producto no encontrado.";
        }

        $conexion->close();
    } else {
        echo "No se ha seleccionado ningún producto.";
    }
    ?>
</body>
</html>


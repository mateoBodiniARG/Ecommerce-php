<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleTien.css">
    <title>Tienda en línea</title>
</head>
<body>
    <header>
        <h1>TIENDA</h1>
        <a href="../Home/home.html" class="boton-tienda">Regresar</a>
    </header>

    <section class="productos">
        <?php
        include('../config/config.php');


        $conexion = new mysqli($servername, $username, $password, $dbname);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta SQL para seleccionar los productos con estado "Disponible" de la tabla
        $consulta = "SELECT * FROM productos WHERE estado = 'Disponible'";
        $resultado = $conexion->query($consulta);
        
        // Recorre los resultados y muestra los productos en la página
        while ($fila = $resultado->fetch_assoc()) {
            echo '<div class="producto">';
            echo '<img src="' . $fila['imagen'] . '" alt="' . $fila['nombre'] . '">';
            echo '<h3>' . $fila['nombre'] . '</h3>';
            echo '<p>Precio: $' . $fila['precio'] . '</p>';
            echo '<form action="procesarCompra.php" method="post">';
            echo '<input type="hidden" name="id_producto" value="' . $fila['id'] . '">';

            echo '<div class="buttons-section">';
            echo '<label for="cantidad">Cantidad:</label>';
            echo '<input type="number" name="cantidad" value="1" required>';
            echo '<input type="submit" value="Comprar">';
            echo '</form>';
            echo '</div>'; 
            echo '</div>'; 
        }
        

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </section>


</body>
</html>

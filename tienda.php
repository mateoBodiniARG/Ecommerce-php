<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleTienda.css"> <!-- Enlaza tu archivo CSS -->
    <title>Tienda en línea</title>
</head>
<body>
    <header>
        <h1>Ecommerce</h1>
    </header>

    <section class="productos">
    <?php
    // Establece la conexión a la base de datos (reemplaza con tus propios detalles)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para seleccionar los productos de la tabla
    $consulta = "SELECT * FROM productos";
    $resultado = $conexion->query($consulta);

    // Recorre los resultados y muestra los productos
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo '<div class="producto">';
        echo '<img src="' . $fila['imagen'] . '" alt="' . $fila['nombre'] . '">';
        echo '<h3>' . $fila['nombre'] . '</h3>';
        echo '<p>Precio: $' . $fila['precio'] . '</p>';
        echo '<button>Comprar</button>';
        echo '</div>';
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
    ?>
</section>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleEstadisticas.css">
    <title>Estadísticas</title>
</head>
<body>
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

    // Obtener los 3 productos más vendidos
    $consultaProductosMasVendidos = "SELECT nombre, cantidad_vendida FROM productos ORDER BY cantidad_vendida DESC LIMIT 3";
    $resultadoProductosMasVendidos = $conexion->query($consultaProductosMasVendidos);

    // Obtener las 3 marcas más compradas (por cantidad de productos comprados)
    $consultaMarcasMasCompradas =
    "SELECT marcas.nombre AS Marca, SUM(productos.cantidad_vendida) AS Cantidad_Productos_Vendidos
    FROM productos 
    INNER JOIN marcas  ON productos.id_marca = marcas.id
    GROUP BY marcas.nombre
    ORDER BY Cantidad_Productos_Vendidos DESC
    LIMIT 3
    ";


    $resultadoMarcasMasCompradas = $conexion->query($consultaMarcasMasCompradas);

    // Obtener los productos con bajo stock (menos de 10)
    $consultaProductosBajoStock = "SELECT nombre, stock FROM productos WHERE stock < 10";
    $resultadoProductosBajoStock = $conexion->query($consultaProductosBajoStock);
    ?>

    <h2>Estadísticas</h2>

    <div class="estadistica">
        <h3>Los 3 productos más vendidos:</h3>
        <ul>
            <?php
            while ($fila = $resultadoProductosMasVendidos->fetch_assoc()) {
                echo "<li>{$fila['nombre']} - Vendidos: {$fila['cantidad_vendida']}</li>";
            }
            ?>
        </ul>
    </div>

    <div class="estadistica">
        <h3>Las 3 marcas más compradas:</h3>
        <ul>
            <?php
            while ($fila = $resultadoMarcasMasCompradas->fetch_assoc()) {
                echo "<li>{$fila['Marca']} - Compradas: {$fila['Cantidad_Productos_Vendidos']}</li>";
            }
            ?>
        </ul>
    </div>

    <div class="estadistica">
        <h3>Productos con bajo stock (menos de 10):</h3>
        <ul>
            <?php
            while ($fila = $resultadoProductosBajoStock->fetch_assoc()) {
                echo "<li>{$fila['nombre']} - Stock: {$fila['stock']}</li>";
            }
            ?>
        </ul>
    </div>

    <a href="../panelAdmin.php" class="regresarAdmin">Regresar</a>
</body>
</html>

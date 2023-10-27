<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="errorGuardar.css">
    <title>Guardar modificacion</title>
</head>
<body>
  <?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_producto = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];
    $stock = $_POST["stock"];
    $estado = $_POST["estado"];
    $marca = $_POST["id_marca"]; 
    $motivo = $_POST["motivo"];

    // Conexión a la base de datos
    include('../../config/config.php');

    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Validación para no permitir establecer "Disponible" si el stock es 0 o menos
    if ($estado === "Disponible" && $stock <= 0) {
        echo '<div class="error-container">';
        echo '<p class="error-mensaje">No se puede establecer el estado a "Disponible" si el stock es 0 o menos.</p>';
        echo '<a href="./modificarProducto.php">Volver a intentar</a>';
        echo '</div>';
        exit;
    }
     else {
        $consulta = "UPDATE productos SET nombre = '$nombre', precio = '$precio', imagen = '$imagen', stock = '$stock', estado = '$estado', id_marca = '$marca' WHERE id = $id_producto";
        // Ejecutar la consulta
        if ($conexion->query($consulta) === TRUE) {
            // Si se actualizó correctamente, se guarda el motivo en la tabla ticketMotivo y redirecciona a la página de modificarProducto.php
            $consultaMotivo = "INSERT INTO ticketMotivo (id_producto, motivo) VALUES ($id_producto, '$motivo')";
            $conexion->query($consultaMotivo);

            header("Location: modificarProducto.php");
        } else {
            echo "Error al actualizar el producto: " . $conexion->error;
        }
    }

    $conexion->close();
} 
?>  
</body>
</html>

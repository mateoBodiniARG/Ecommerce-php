<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login proceso</title>
</head>
<body>
   <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    include('../config/config.php');
    // Conexión a la base de datos
    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para verificar las credenciales del administrador
    $sql = "SELECT * FROM administradores WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        // Las credenciales son válidas, redirigir al panel de administración
        $_SESSION["usuario"] = $usuario;
        header("Location: ../Admin/panelAdmin.php");
    } else {
        // Las credenciales son incorrectas, mostrar un mensaje de error
        echo "<p class='error-message'>Credenciales incorrectas! <a href='./login.php'>Volver a intentar</a></p>";

    }

    $conexion->close();
}
?> 
</body>
</html>


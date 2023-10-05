
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
   <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    // Conexión a la base de datos (reemplaza con tus propios detalles)
    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM administradores WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        // Las credenciales son válidas, redirigir al panel de administración
        $_SESSION["usuario"] = $usuario;
        header("Location: panelAdmin.php");
    } else {
        // Las credenciales son incorrectas, mostrar un mensaje de error
        echo "<p class='error-message'>Credenciales incorrectas! <a href='login.php'>Volver a intentar</a></p>";

    }

    $conexion->close();
}
?> 
</body>
</html>


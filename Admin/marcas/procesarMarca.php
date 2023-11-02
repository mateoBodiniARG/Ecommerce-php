<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Procesar registro exitoso!</title>
</head>
<body>
 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
   include('../../config/config.php');
    $nombre = $_POST["nombre"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO marcas (nombre) VALUES ('$nombre')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='mensaje-correcto'>
        <h2> Marca agregada correctamente! </h2>
        <p> <a href='../panelAdmin.php'>Regresar al panel</a> </p>
        </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
   
</body>
</html>


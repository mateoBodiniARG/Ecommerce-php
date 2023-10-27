<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
    $nombre = $_GET["nombre"];

    include('../../config/config.php');

    // Realiza una consulta para verificar si la marca ya existe
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT nombre FROM marcas WHERE nombre = '$nombre'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "existe";
    } else {
        echo "no_existe";
    }

    $conn->close();
}
?>

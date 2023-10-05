<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login-logout/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleAdmin.css">
    <title>Panel administrador</title>
</head>
<body>
    <section>
       <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION["usuario"]; ?>!</h2>
        <div class="menu">
            <a href="agregar_producto.php">Agregar Producto</a> 
            <a href="modificarProducto.php">Modificar Producto</a> 
            <a href="eliminar_producto.php">Eliminar Producto</a>
            <a href="tienda.php">Ver Productos</a> 
            <a href="logout.php" class="logOut">Cerrar Sesión</a> 
        </div>
    </div> 
    </section>
    
</body>
</html>

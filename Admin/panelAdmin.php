<?php
// Inicia la sesión
session_start();
// Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión (login.php)
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
    <link rel="stylesheet" href="styleAdminPanel.css">
    <title>Panel Administrador</title>
</head>
<body>
    <section>
        <div class="container">
            <h2>Bienvenido, <?php echo $_SESSION["usuario"]; ?>!</h2>
            <div class="menu">
                <a href="./procesarRegistro/procesar.php">Cargar movimiento</a> 
                <a href="./agregarProductos/index.php">Cargar nuevo producto</a> 
                <a href="./modificarProductos/modificarProducto.php">Modificar Producto</a> 
                <a href="./verProductos/index.php">Ver Productos</a> 
                <a href="./marcas/agregarMarca.html">Cargar nueva marca</a> 
                <a href="./registrarAdmin/registro.html">Agregar administrador</a>
                <a href="./motivoModificaciones/motivos.php">Motivos de Modificaciones</a> 
                <a href="./historialMovimientos/historialMovimientos.php">Historial movimientos</a> 
                <a href="./estadisticas/estadisticas.php">ESTADISTICAS</a> 
                <a href="../Login/logout.php" class="logOut">Cerrar Sesión</a> 
            </div>
        </div> 
    </section>
</body>
</html>

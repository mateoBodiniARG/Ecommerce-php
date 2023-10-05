<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inicio de sesion</title>
</head>
<body>
<h2>Iniciar Sesión</h2>
<section class="formLogin">
    <form method="POST" action="loginProceso.php">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</section>
    
</body>
</html>
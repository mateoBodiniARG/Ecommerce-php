<?php
session_start();

// Destruye la sesión actual
session_destroy();

// Redirige al usuario al formulario de inicio de sesión
header("Location: login.php");
exit;
?>

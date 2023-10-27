<?php
session_start();

// Destruye la sesión actual
session_destroy();

// Redirige al usuario (admin) al formulario de inicio de sesión (login.php) 
header("Location: ./login.php");
exit;
?>

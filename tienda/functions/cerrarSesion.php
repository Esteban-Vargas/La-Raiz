<?php
session_start();

// Verifica si hay una sesión antes de intentar destruirla
if (isset($_SESSION['nombre_s'])) {
    // Destruye la sesión
    session_destroy();
}

// Redirige a la página principal
header("Location: ../index.php");
exit(); // Asegura que el script se detenga después de la redirección
?>
<?php

//session_start();
  // Verificar si se debe destruir la sesión
  if (!$_SESSION['username']) {
    session_destroy(); // Destruir la sesión
    session_unset();
    header("Location: ../index.html"); // Redirigir a la página de inicio de sesión
    exit(); // Asegurarse de que no se ejecute más código después de la redirección
}


?>
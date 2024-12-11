<?php

$dest_sesion = $_GET['dest_sesion'];
if($dest_sesion == 1){
    session_destroy(); // Destruir la sesión
    session_unset();
    header("Location: ../index.html"); // Redirigir a la página de inicio de sesión
    exit(); 
}

?>



                    <a href="<?php  echo $_SERVER['PHP_SELF'].'?dest_sesion=1';                     
                    ?>" type="button" class="btn btn-success sesion">Cerrar sesión</a>

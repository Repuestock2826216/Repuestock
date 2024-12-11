<?php

include "conexionDb.php";

session_start();
// Control de caché
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

$email = $_POST['email'];
$pass = $_POST['password'];

// Ejemplo de uso
if (validarEmail($email)) {

$sql = "SELECT * FROM usuario where email = '$email' and password = BINARY '$pass'";
$resultado = $conexionDb->query($sql);
$consulta = mysqli_num_rows($resultado);

    if ($consulta == 1) {
      
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
        $_SESSION['username'] = $row['nombre'];
        $_SESSION['rol'] = $row['rol'];
        $idUsuario = $row['idUsuario'];
        if ($row['rol'] == 'administrador') {
            header("location: administrador/usuarios.php?idUsuario=$idUsuario");
        } elseif ($row['rol'] == 'logistica') {
            header("location: logistica/productos.php?idUsuario=$idUsuario");
        } elseif ($row['rol'] == 'ingeniero') {
            header("location: ingeniero/productos.php?idUsuario=$idUsuario");
        }

        
    } else {
        echo "<script>alert('DATOS NO SON VALIDOS.');location='index.html';</script>";
    }
} else {
    echo "<script>alert('El correo no es valido.');location='index.html';</script>";
}





function validarEmail($email) {
    return preg_match('/^[\w\.-]+@[a-zA-Z\d\.-]+\.(com|co|es)$/', $email);
}
?>
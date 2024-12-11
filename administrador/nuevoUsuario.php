<?php

    include '../conexionDb.php';

    session_start();

    require '../logout.php';
    
    $idUsuario = $_GET['idUsuario'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../JS/validaciones.js"></script>
    <title>Crear nuevo usuario</title>
</head>
<body>
    <div class="formulario">
        <h3>Crear nuevo usuario</h3>
        <form onsubmit="return validarCorreo()" action="guardarUsuario.php?idUsuario=<?php echo $idUsuario;?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombre"  name="nombre" placeholder="Ingrese el nombrel del usuario" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email"  name="email" placeholder="Ingrese el correo del usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password"  name="password" placeholder="Ingrese contraseña para usuario" required>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular"  name="celular" placeholder="Ingrese celular del usuario" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label><br>
                <select id="rol" name="rol">
                    <option value="" selected>Seleccione el rol del usuario</option>
                    <option value="administrador">Administrador</option>
                    <option value="logistica">Logística</option>
                    <option value="ingeniero">Ingeniero</option>
                </select>
            </div>
            <div class="boton">
                <a href="usuarios.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-secondary">VOLVER</button></a>
                <!-- <input type="submit" value="GUARDAR" class="btn btn-primary"> -->
                <button type="submit">GUARDAR</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php

    include '../conexionDb.php';

    session_start();

    require '../logout.php';

    $idUsuario = $_GET['idUsuario'];

    // consulta proveedor
    $sql = "SELECT * FROM proveedor";
    $resultado = $conexionDb->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../JS/validaciones.js"></script>
    <title>Nuevo cliente</title>
</head>
<body>
    <div class="formulario">
        <h3>Crear nuevo cliente</h3>
        <form onsubmit="return validarClienteNuevo()" action="guardarCliente.php?idUsuario=<?php echo $idUsuario;?>" method="POST">
            <div class="mb-3">
                <label for="nombreCliente" class="form-label">Nombre del cliente</label>
                <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombreCliente"  name="nombreCliente" placeholder="Ingrese en nombre del Laboratorio" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion"  name="direccion" placeholder="Ingrese la dirección del laboratorio" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="ciudad"  name="ciudad" placeholder="Ciudad de laboratorio" required>
            </div>
            <div class="mb-3">
                <label for="telCliente" class="form-label">Telefóno de contacto</label>
                <input type="text" class="form-control" id="telCliente"  name="telCliente" placeholder="Ingrese telefóno de contacto" required>
            </div>
            <div class="mb-3">
                <label for="nombreContacto" class="form-label">Nombre de contacto</label>
                <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombreContacto"  name="nombreContacto" placeholder="Ingrese el no0mbre de contacto" required>
            </div>
            <div class="boton">
                <a href="clientes.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-secondary">VOLVER</button></a>
                <!--<input type="submit" value="GUARDAR" class="btn btn-primary">-->
                <button type="submit">GUARDAR</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
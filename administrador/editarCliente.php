<?php

    include '../conexionDb.php';

    session_start();

    require '../logout.php';

    $idUsuario = $_GET['idUsuario'];
    $idCliente = $_GET['idCliente'];

    $sql = "SELECT * FROM cliente where idCliente= '$idCliente'";
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="../JS/validaciones.js"></script>
        <title>Editar cliente</title>
    </head>
    <body>
        <div class="formulario">
            <h3>Editar cliente</h3>
            <form action="actualizarCliente.php?idCliente=<?php echo $idCliente;?>&idUsuario=<?php echo $idUsuario;?>" method="POST">
                <div class="mb-3">
                    <label for="nombreCliente" class="form-label">Nombre del cliente</label>
                    <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombre"  name="nombre" value="<?php echo $row['nombreCliente'];?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion"  name="direccion" value="<?php echo $row['direccion'];?>">
                </div>
                <div class="mb-3">
                    <label for="ciudad" class="form-label">Ciudad</label>
                    <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="ciudad"  name="ciudad" value="<?php echo $row['ciudad'];?>">
                </div>
                <div class="mb-3">
                    <label for="telCliente" class="form-label">Teléfono contacto</label>
                    <input type="text" class="form-control" id="telCliente"  name="telCliente" value="<?php echo $row['telCliente'];?>">
                </div>
                <div class="mb-3">
                    <label for="nombreContacto" class="form-label">Nombre de contacto</label>
                    <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombreContacto"  name="nombreContacto" value="<?php echo $row['nombreContacto'];?>">
                </div>
                <div class="boton">
                    <a href="clientes.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-secondary">VOLVER</button></a>
                    <!-- <input type="submit" value="GUARDAR" class="btn btn-primary"> -->
                    <button type="submit">GUARDAR</button>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
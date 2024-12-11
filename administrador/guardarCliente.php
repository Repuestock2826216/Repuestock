<?php

    require '../conexionDB.php';

    session_start();

    require '../logout.php';

    $idUsuario = $_GET['idUsuario'];
    $nombreCliente = $_POST['nombreCliente'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $telCliente = $_POST['telCliente'];
    $nombreContacto =  $_POST['nombreContacto'];

    $sql = "INSERT INTO cliente(nombreCliente,direccion,ciudad,telCliente,nombreContacto) VALUES('$nombreCliente','$direccion','$ciudad','$telCliente','$nombreContacto')"; 
    $resultado = $conexionDb->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Guardar nuevo cliente</title>
</head>
<body>
    <div>
        <?php
            if($resultado){
        ?>
        <div class="alert alert-success alerta" role="alert">
            <div>
                <h3>Cliente creado correctamente</h3> 
            </div>
            <div>
                <a href="clientes.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
            </div>
        </div>
        
        <?php
            }else{
        ?>
        <h2>Error al crear cliente</h2>
        <?php
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
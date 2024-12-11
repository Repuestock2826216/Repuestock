<?php

    require '../conexionDB.php';
    

    session_start();

    require '../logout.php';


    $idCliente = $_GET['idCliente'];
    $idUsuario = $_GET['idUsuario'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $telCliente = $_POST['telCliente'];
    $nombreContacto =  $_POST['nombreContacto'];

    $sql = "UPDATE cliente SET direccion='$direccion',ciudad='$ciudad',telCliente='$telCliente',nombreContacto='$nombreContacto' WHERE idCliente='$idCliente'";
    $resultado = $conexionDb->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Actualizar usuario</title>
</head>
<body>
    <div>
        <?php
            if($resultado){
        ?>
        <div class="alert alert-success alerta" role="alert">
            <div>
                <h3>Cliente actualizado correctamente</h3> 
            </div>
            <div>
                <a href="clientes.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
            </div>
        </div>
        <?php
            }else{
        ?>
        <div class="alert alert-danger alerta" role="alert">
            <div>
                <h3>Error al actualizar</h3> 
            </div>
            <div>
                <a href="clientes.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</body>
</html>
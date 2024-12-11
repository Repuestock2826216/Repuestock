<?php

    require '../conexionDB.php';

    session_start();

    require '../logout.php';

    $idUsuario1 = $_GET['idUsuario1'];
    $idUsuario = $_GET['idUsuario'];
    $password = $_POST['password'];
    $Hotmail   = $_POST['email'];
    $rol = $_POST['rol'];
    $celular = $_POST['celular'];
    // podria activar o inactivar usuario?

    $sql = "UPDATE usuario SET password='$password',rol='$rol',celular='$celular', email='$Hotmail'   WHERE idUsuario='$idUsuario1'";
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
                <h3>Usuario actualizado correctamente</h3> 
            </div>
            <div>
                <a href="usuarios.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
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
                <a href="usuarios.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</body>
</html>
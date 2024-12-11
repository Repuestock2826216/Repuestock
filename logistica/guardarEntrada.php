<?php

    require '../conexionDB.php';

    session_start();

    require '../logout.php';

    $idUsuario = $_GET['idUsuario'];
    $idProducto = $_GET['idProducto'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];

   
    // consulta para tomar el stock actual del producto
    $sql = "SELECT stock, stockMax FROM producto where idProducto= '$idProducto'";
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    // suma de stock actual y de cantidad de la entrada
    $newCantidad = $row['stock'] + $cantidad;

    if($newCantidad > $row['stockMax']){?>

        <script>alert("la cantidad Supera el Stock Maximo!!");
           window.location="../logistica/entrada.php?idProducto="+<?php echo $idProducto ?>+"&idUsuario="+<?php echo $idUsuario ?>
        </script>
       
        <?php
       }
    else {
     // guardar entrada en tabla ingreso
     $date = date("Y-m-d");
     $sql = "INSERT INTO ingreso(idproducto,fechaIngreso,cantidad,idUsuario) VALUES('$idProducto','$date','$cantidad','$idUsuario')"; 
     $resultado1 = $conexionDb->query($sql);
 

    // consulta para actualizar el stock del producto con la nueva cantidad
    $sql = "UPDATE producto SET stock='$newCantidad' WHERE idProducto='$idProducto'";
    $resultado2 = $conexionDb->query($sql);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Entrada de producto</title>
</head>
<body>
    <div>
        <?php
            if($resultado and $resultado1 and $resultado2){
        ?>
        <div class="alert alert-success alerta" role="alert">
            <div>
                <h3>Entrada de producto realizada</h3> 
            </div>
            <div>
                <a href="productos.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
            </div>
        </div>
        
        <?php
            }else{
        ?>
        <div class="alert alert-danger alerta" role="alert">
            <div>
                <h3>Error al ingresar producto</h3> 
            </div>
            <div>
                <a href="productos.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</body>
</html>

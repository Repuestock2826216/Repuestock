<?php

    require '../conexionDB.php';

    session_start();

    require '../logout.php';

    $idUsuario = $_GET['idUsuario'];
    $parteNumero = $_POST['parteNumero'];
    $nombre = $_POST['nombre'];
    $stock = $_POST['stock'];
    $stockMin = $_POST['stockMin'];
    $stockMax = $_POST['stockMax'];
    $idProveedor = $_POST['idProveedor'];
    $ubicacion = $_POST['ubicacion'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO producto(parteNumero,nombre,stock,stockMIn,stockMax,idProveedor,ubicacion,estado) VALUES('$parteNumero','$nombre','$stock','$stockMin','$stockMax','$idProveedor','$ubicacion','$estado')"; 
    $resultado = $conexionDb->query($sql);

    $sql = "SELECT idProducto FROM producto WHERE parteNumero='$parteNumero'"; // se realiza la consulta del nuevo registro para tomar el idProducto
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
    $idProducto = $row['idProducto'];   

    $date = date("Y-m-d"); // se toma la fecha actual para tener registro de cuando se hizo el ingreso
    $sql1 = "INSERT INTO ingreso(idproducto,fechaIngreso,cantidad) VALUES('$idProducto','$date','$stock')"; 
    $resultado1 = $conexionDb->query($sql1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Guardar producto</title>
</head>
<body>
<div>
        <?php
            if($resultado){
        ?>
        <div class="alert alert-success alerta" role="alert">
            <div>
                <h3>Producto creado correctamente</h3> 
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
                <h3>Error al guardar</h3> 
            </div>
            <div>
                <a href="productos.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-info">OK</button></a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
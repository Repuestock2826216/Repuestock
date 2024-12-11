<?php

require '../conexionDB.php';

session_start();

require '../logout.php';

$idProducto = $_GET['idProducto'];
$idUsuario  = $_GET['idUsuario'];
$partNum    = $_POST['parteNumero'];
$nom        = $_POST['nombre'];
// $idProvee   = $_POST['idProveedor'];
$ubi        = $_POST['ubicacion'];
$stock      = $_POST['stock'];
$cantidad   = $_POST['cantidad'];
$fecha      = $_POST['fecha'];

$stockN = $stock - $cantidad;

if ($stockN < 0) {   ?>

 <script>alert("la cantidad solicitada supera el stock!!");
    window.location="../ingeniero/solicitarProducto.php?idProducto="+<?php echo $idProducto ?>+"&idUsuario="+<?php echo $idUsuario ?>
 </script>

 <?php
}
else {

$sql = "UPDATE producto SET stock='$stockN' WHERE parteNumero='$partNum'";
$sql1 = "INSERT INTO pedido(idProducto,cantidad,fecha) 
        VALUES ('$idProducto','$cantidad','$fecha')";

$resultado = $conexionDb->query($sql);
$resultado2 = $conexionDb->query($sql1);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Solicitud del producto</title>
</head>

<body>
    <div>
        <?php
        if ($resultado) {
        ?>
            <div class="alert alert-success alerta" role="alert">
                <div>

                    <h3>Producto Solicitado correctamente</h3>
                </div>
                <div>
                    <a href="productos.php?idUsuario=<?php echo $idUsuario; ?>"><button type="button" class="btn btn-info">OK</button></a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger alerta" role="alert">
                <div>
                    <h3>Error al Solicitar</h3>
                </div>
                <div>
                    <a href="productos.php?idUsuario=<?php echo $idUsuario; ?>"><button type="button" class="btn btn-info">OK</button></a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>
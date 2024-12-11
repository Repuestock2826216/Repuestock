<?php

require '../conexionDB.php';

session_start();

require '../logout.php';

// declaro variables
$idUsuario  = $_GET['idUsuario'];
$IdPedido0  = $_POST['IdPedido'];
$cantidad0  = $_POST['Cantidad'];
$idProd     =$_POST['IdProducto'];
$stocknuv   =$_POST['stock'];
$devolucion = $cantidad0 + $stocknuv;

//inicia proceso
if ($devolucion < 0) {   ?>

    <script>alert("error!!");
       window.location="/ingeniero/pedidos.php?IdProducto="+<?php echo $idProd  ?>+"&idUsuario="+<?php echo $idUsuario ?>
    </script>
   
    <?php
   }
   else {
   
    $sql = "DELETE FROM pedido WHERE IdPedido='$IdPedido0'";
    $sql1 = "UPDATE producto SET stock='$devolucion' WHERE IdProducto='$idProd'";
   
    $resultado0 = $conexionDb->query($sql);
    $resultado2 = $conexionDb->query($sql1);
   }

?>

<!-- // inicia el htm -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Eliminar Pedido</title>
</head>

<body>
    <div>
        <?php
        if ($resultado0) {
        ?>
            <div class="alert alert-success alerta" role="alert">
                <div>
                    <h3>El pedido se Elimino correctamente</h3>
                </div>
                <div>
                    <a href="pedidos.php?idUsuario=<?php echo $idUsuario; ?>"><button type="button" class="btn btn-info">OK</button></a>
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
                    <a href="pedidos.php?idUsuario=<?php echo $idUsuario; ?>"><button type="button" class="btn btn-info">OK</button></a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>
<?php

include '../conexionDb.php';

session_start();

ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

require '../logout.php';

$idUsuario = $_GET['idUsuario'];

$where = "";

if (!empty($_POST)) {
    $valor = $_POST['campo'];
    if (!empty($valor)) {
        $where = "WHERE nombreProveedor LIKE '%$valor'";
    }
}

// consulta usuario logueado
$sql = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
$resultado = $conexionDb->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

// consulta todos los proveedores
$sql4 = "SELECT pro.nombre , pro.stock, p.idProveedor, p.nombreProveedor FROM proveedor p inner join producto pro ON pro.idProveedor = p.idProveedor  $where";
$resultado4 = $conexionDb->query($sql4);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../logistica.css">
    <title>Administrador <?php echo $row['nombre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <!--cabeza-->
        <div class="row">
            <div class="col">
                <img src="../logo.jpg" alt="RepueStock" class="logo">
            </div>
            <div class="col">
                <h6 class="user"><strong>Bienvenid@: <?php echo $row['nombre']; ?></strong></h6>
                <h6 class="user"><strong><?php echo strtoupper($row['rol']); ?></strong></h6>
            </div>
            <div class="col boton1">
                <?php
                    include '../salir_session.php';
                ?>
                </div>
        </div>
        <!--pestañas-->
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" aria-current="page" href="productos.php?idUsuario=<?php echo $idUsuario; ?>">PRODUCTOS</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="inventario.php?idUsuario=<?php echo $idUsuario; ?>">INVENTARIO</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="#">PROVEEDORES</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="pedidos.php?idUsuario=<?php echo $idUsuario; ?>">PEDIDOS</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--contenido -->
        <div class="tab-content" id="myTabContent">
            <!--inventario-->
            <div class="tab-pane fade show active">
                <div class='row busqueda'>
                    <div class="col">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method='POST'>
                            <b>Nombre: </b><input type="text" id="campo" name="campo">
                            <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-warning table-striped table-bordered table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Id proveedor</th>
                                <th>Nombre del Proveedor</th>
                                <th>Producto</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row4 = $resultado4->fetch_array(MYSQLI_ASSOC)) {
                            ?>
                                <tr>
                                    <td class="table-warning"><?php echo $row4['idProveedor']; ?></td>
                                    <td class="table-warning"><?php echo $row4['nombreProveedor']; ?></td>
                                    <td class="table-warning"><?php echo $row4['nombre']; ?></td>
                                    <td class="table-warning"><?php echo $row4['stock']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
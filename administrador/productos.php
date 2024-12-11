<?php

    include '../conexionDb.php';

    session_start();

    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    
    require '../logout.php';
  
    $idUsuario = $_GET['idUsuario'];
    
    // consulta usuario logueado
    $sql = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    // consulta para productos
    $sql1 = "SELECT idProducto,parteNumero,nombre,stock,stockMin,stockMax,producto.idProveedor,ubicacion,estado,proveedor.nombreProveedor FROM producto INNER JOIN proveedor ON producto.idProveedor= proveedor.idProveedor ORDER BY producto.idProducto";
    $resultado1 = $conexionDb->query($sql1);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../logistica.css">
        <title>Administrador <?php echo $row['nombre'];?></title>
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
                    <h6 class="user"><strong>Bienvenid@: <?php echo $row['nombre'];?></strong></h6>
                    <h6 class="user"><strong><?php echo strtoupper($row['rol']);?></strong></h6>
                </div>
                <div class="col boton1">
                <?php
                    include '../salir_session.php';
                ?>
                </div>
             <!--pestañas-->
            <div class="row" >
                <div class="col">
                <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="usuarios.php?idUsuario=<?php echo $idUsuario;?>">USUARIOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" aria-current="page" href="#">PRODUCTOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="inventario.php?idUsuario=<?php echo $idUsuario;?>">INVENTARIO</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="proveedores.php?idUsuario=<?php echo $idUsuario;?>">PROVEEDORES</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="clientes.php?idUsuario=<?php echo $idUsuario;?>">CLIENTES</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--contenido -->
            <div class="tab-content" id="myTabContent">
                <!--productos-->
                <div class="tab-pane fade show active" background="yellow">
                    <br>
                    <div>
                        <a href="nuevoProducto.php?idUsuario=<?php echo $idUsuario;?>" type="button" class="btn btn-primary">Crear nuevo producto</a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-warning table-striped table-bordered table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Id producto</th>
                                    <th>Parte número</th>
                                    <th>Nombre</th>
                                    <th>stock</th>
                                    <th>Stock mínimo</th>
                                    <th>Stock máximo</th>
                                    <th>Proveedor</th>
                                    <th>Ubicación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row1 = $resultado1->fetch_array(MYSQLI_ASSOC)){
                                        if($row1['estado']==1){
                                            $estado = 'Activo';
                                        }else{
                                            $estado = 'Inactivo';
                                        };
                                ?>
                                <tr>
                                    <td class="table-warning"><?php echo $row1['idProducto'];?></td>
                                    <td class="table-warning"><?php echo $row1['parteNumero'];?></td>
                                    <td class="table-warning"><?php echo $row1['nombre'];?></td>
                                    <td class="table-warning"><?php echo $row1['stock'];?></td>
                                    <td class="table-warning"><?php echo $row1['stockMin'];?></td>
                                    <td class="table-warning"><?php echo $row1['stockMax'];?></td>
                                    <td class="table-warning"><?php echo $row1['nombreProveedor'];?></td>
                                    <td class="table-warning"><?php echo $row1['ubicacion'];?></td>
                                    <td class="table-warning"><?php echo $estado;?></td>
                                    <td class="table-warning">
                                        <a href="editarProducto.php?idProducto=<?php echo $row1['idProducto'];?>&idUsuario=<?php echo $row['idUsuario'];?>" type="button" class="btn btn-secondary">Editar</a>
                                    </td>
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
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

    // consulta inventario
    $sql3 = "SELECT producto.idProducto,producto.parteNumero,producto.nombre,proveedor.nombreProveedor as nombreProveedor,sum(ingreso.cantidad) as cantidadIngreso, producto.stock,producto.ubicacion,producto.estado FROM producto LEFT JOIN proveedor ON producto.idProveedor = proveedor.idProveedor LEFT JOIN ingreso ON producto.idProducto = ingreso.idProducto GROUP BY producto.idProducto;";
    $resultado3 = $conexionDb->query($sql3);

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
               <?php

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
                            <a class="nav-link" aria-current="page" href="productos.php?idUsuario=<?php echo $idUsuario;?>">PRODUCTOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active"  href="#">INVENTARIO</a>
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
                <!--inventario-->
                <div class="tab-pane fade show active">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-warning table-striped table-bordered table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Id producto</th>
                                    <th>Parte número</th>
                                    <th>Nombre</th>
                                    <th>Proveedor</th>
                                    <th>Entradas</th>
                                    <!-- <th>Salidas</th> -->
                                    <th>Stock actual</th>
                                    <th>Ubicación</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row3 = $resultado3->fetch_array(MYSQLI_ASSOC)){
                                        if($row3['estado']==1){
                                            $estado = 'Activo';
                                        }else{
                                            $estado = 'Inactivo';
                                        };
                                ?>
                                <tr>
                                    <td class="table-warning"><?php echo $row3['idProducto'];?></td>
                                    <td class="table-warning"><?php echo $row3['parteNumero'];?></td>
                                    <td class="table-warning"><?php echo $row3['nombre'];?></td>
                                    <td class="table-warning"><?php echo $row3['nombreProveedor'];?></td>
                                    <td class="table-warning"><?php echo $row3['cantidadIngreso'];?></td>
                                    <!-- <td class="table-warning"><?php echo $row3['cantidadSalida'];?></td> -->
                                    <td class="table-warning"><?php echo $row3['stock'];?></td>
                                    <td class="table-warning"><?php echo $row3['ubicacion'];?></td>
                                    <td class="table-warning"><?php echo $estado;?></td>
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
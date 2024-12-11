<?php 
    
    include '../conexionDb.php';

    session_start();
    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

    require '../logout.php';
  
    $idUsuario = $_GET['idUsuario'];
    
    $where = "";

    if(!empty($_POST)){
        $valor = $_POST['campo'];
        if(!empty($valor)){
            $where = "WHERE nombre LIKE '%$valor%'";
        }
    }

    // consulta usuario logueado
    $sql = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    // consulta para productos
    $sql1 = "SELECT idProducto,parteNumero,nombre,stock,stockMin,stockMax,producto.idProveedor,ubicacion,estado,proveedor.nombreProveedor FROM producto INNER JOIN proveedor ON producto.idProveedor= proveedor.idProveedor $where ORDER BY producto.idProducto ";
    $resultado1 = $conexionDb->query($sql1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../logistica.css">
        <script src="http://code.jquery.com/jquery-3.7.1.js"></script>
        <title>Logística <?php echo $row['nombre'];?></title>
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
            </div>
             <!--pestañas-->
            <div class="row" >
                <div class="col">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" aria-current="page" href="#">PRODUCTOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="inventario.php?idUsuario=<?php echo $idUsuario;?>">INVENTARIO</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="pedidos.php?idUsuario=<?php echo $idUsuario;?>">PEDIDOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="envios.php?idUsuario=<?php echo $idUsuario;?>">ENVÍOS</a>
                        </li>
                    </ul>

                </div>
                
            </div>
            <!--contenido -->
            <div class="tab-content" id="myTabContent">
                <!--productos-->
                <div class="tab-pane fade show active" background="yellow">
                    <div class='row busqueda'>
                        <div class="col">
                            <form action="<?php $_SERVER['PHP_SELF'];?>" method='POST'>
                                <b>Nombre del producto: </b><input type="text" id="campo" name="campo">
                                <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-primary">
                                
                            </form>
                            
                        </div>
                        
            </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-warning table-striped table-bordered table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Id producto</th>
                                    <th>Parte número</th>
                                    <th>Nombre</th>
                                    <th>Stock</th>
                                    <th>stock mín</th>
                                    <th>stock máx</th>
                                    <th>Proveedor</th>
                                    <th>Ubicación</th>
                                    <th>Estado</th>
                                    <th colspan="2">Acciones</th>
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
                                    <td class="table-warning"><span id="idProducto"><?php echo $row1['idProducto'];?></span></td>
                                    <td class="table-warning"><?php echo $row1['parteNumero'];?></td>
                                    <td class="table-warning"><?php echo $row1['nombre'];?></td>
                                    <td class="table-warning"><?php echo $row1['stock'];?></td>
                                    <td class="table-warning"><?php echo $row1['stockMin'];?></td>
                                    <td class="table-warning"><?php echo $row1['stockMax'];?></td>
                                    <td class="table-warning"><?php echo $row1['nombreProveedor'];?></td>
                                    <td class="table-warning"><?php echo $row1['ubicacion'];?></td>
                                    <td class="table-warning"><?php echo $estado;?></td>
                                    <td class="table-warning">
                                        <a href="entrada.php?idProducto=<?php echo $row1['idProducto'];?>&idUsuario=<?php echo $row['idUsuario'];?>" type="button" class="btn btn-info">Entrada</a>
                                        <a href="editarProducto.php?idProducto=<?php echo $row1['idProducto'];?>&idUsuario=<?php echo $row['idUsuario'];?>" type="button" class="btn btn-secondary">Editar</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!-- Modal para ver imagen -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Imagen del producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="imagen" class="img-fluid" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            
            <script>
                        $(document).on("click",".btnModal",function(){
                            var ruta = $(this).data('ruta');
                            console.log(ruta);
                            $('#imagen').attr('src',ruta);
                            $('#exampleModal').modal();
                        });
                    </script> 
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
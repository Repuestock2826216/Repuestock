<?php

    include '../conexionDb.php';

    session_start();

    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

    require '../logout.php';
  
    $where = "";

    if(!empty($_POST)){
        $valor = $_POST['campo'];
        if(!empty($valor)){
            $where = "WHERE nombreCliente LIKE '%$valor%'";
        }
    }

    $idUsuario = $_GET['idUsuario'];
    
    // consulta usuario logueado
    $sql = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

     // consulta todos los clientes
     $sql2 = "SELECT * FROM cliente $where";
     $resultado2 = $conexionDb->query($sql2);

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
            </div>
             <!--pestañas-->
            <div class="row" >
                <div class="col">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="usuarios.php?idUsuario=<?php echo $idUsuario;?>">USUARIOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="productos.php?idUsuario=<?php echo $idUsuario;?>">PRODUCTOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="inventario.php?idUsuario=<?php echo $idUsuario;?>">INVENTARIO</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  href="proveedores.php?idUsuario=<?php echo $idUsuario;?>">PROVEEDORES</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" aria-current="page" href="#">CLIENTES</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--contenido -->
            <div class="tab-content" id="myTabContent">
                <!--usuarios-->
                <div class="tab-pane fade show active" background="yellow">
                    <div class='row busqueda'>
                        <div class="col">
                            <form action="<?php $_SERVER['PHP_SELF'];?>" method='POST'>
                                <b>Nombre de Laboratorio: </b><input type="text" id="campo" name="campo">
                                <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-primary">
                            </form>
                        </div>
                        <div class="col">
                            <a href="nuevoCliente.php?idUsuario=<?php echo $idUsuario;?>" type="button" class="btn btn-primary">Crear nuevo cliente</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-warning table-striped table-bordered table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre laboratorio</th>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Telefóno</th>
                                    <th>Nombre de contacto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row2 = $resultado2->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <tr>
                                    <td class="table-warning"><?php echo $row2['nombreCliente'];?></td>
                                    <td class="table-warning"><?php echo $row2['direccion'];?></td>
                                    <td class="table-warning"><?php echo $row2['ciudad'];?></td>
                                    <td class="table-warning"><?php echo $row2['telCliente'];?></td>
                                    <td class="table-warning"><?php echo $row2['nombreContacto'];?></td>
                                    <td class="table-warning">
                                        <a href="editarCliente.php?idCliente=<?php echo $row2['idCliente'];?>&idUsuario=<?php echo $row['idUsuario'];?>" type="button" class="btn btn-secondary">Editar</a>
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
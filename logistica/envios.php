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
            $where = "WHERE nombre LIKE '%$valor'";
        }
    }

    $idUsuario = $_GET['idUsuario'];

    // consulta usuario logueado
    $sql = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    // consulta envíos
    $sql5 = "SELECT * FROM envio ";
    $resultado5 = $conexionDb->query($sql5);
    $columnas1 = mysqli_num_rows($resultado5);


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
                            <a class="nav-link" href="productos.php?idUsuario=<?php echo $idUsuario;?>">PRODUCTOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link"  href="inventario.php?idUsuario=<?php echo $idUsuario;?>">INVENTARIO</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link"  href="pedidos.php?idUsuario=<?php echo $idUsuario;?>">PEDIDOS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" aria-current="page"  href="#">ENVÍOS</a>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
            <!--contenido -->
            <div class="tab-content" id="myTabContent">
                <!--envíos-->
                <div class="tab-pane fade show active" id="envios" role="tabpanel" aria-labelledby="envios-tab">
                <?php
                        if($columnas1 > 0 ){
                    ?>
                            <div class="table-responsive">
                                <table class="table table-warning table-striped table-bordered table-sm align-middle">
                                    <thead>
                                        <tr>
                                            <th>Id Envio</th>
                                            <th>Fecha de envío</th>
                                            <th>Número de guia</th>
                                            <th>Id de pedido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row5 = $resultado5->fetch_array(MYSQLI_ASSOC)){
                                        ?>
                                        <tr>
                                            <td class="table-warning"><?php echo $row5['idEnvio'];?></td>
                                            <td class="table-warning"><?php echo $row5['fechaEnvio'];?></td>
                                            <td class="table-warning"><?php echo $row5['numeroGuia'];?></td>
                                            <td class="table-warning"><?php echo $row5['idPedido'];?></td>
                                           
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    <?php
                        }else{
                            echo "<h4>No hay envíos</h4>"; 
                        }
                    ?>
                </div>
            </div>
        </div>  
        </div>                    
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
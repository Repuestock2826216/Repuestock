<?php

session_start();
// Control de caché
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include '../conexionDb.php';

require '../logout.php';

$logout = $_GET['logout'];



$where = "";

if (!empty($_POST)) {
    $valor = $_POST['campo'];
    if (!empty($valor)) {
        $where = "WHERE nombre LIKE '%$valor%'";
    }
}

$idUsuario = $_GET['idUsuario'];

// consulta usuario logueado
$sql = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
$resultado = $conexionDb->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

// consulta todos los usuarios
$sql2 = "SELECT * FROM usuario $where";
$resultado2 = $conexionDb->query($sql2);



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
                <h6 class="user"><strong>Bienvenid@: <?php echo $_SESSION['username']; ?></strong></h6>
                <h6 class="user"><strong><?php echo strtoupper($_SESSION['rol']); ?></strong></h6>
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
                        <a class="nav-link active" aria-current="page" href="#">USUARIOS</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="productos.php?idUsuario=<?php echo $idUsuario; ?>">PRODUCTOS</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="inventario.php?idUsuario=<?php echo $idUsuario; ?>">INVENTARIO</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="proveedores.php?idUsuario=<?php echo $idUsuario; ?>">PROVEEDORES</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="clientes.php?idUsuario=<?php echo $idUsuario; ?>">CLIENTES</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--contenido -->
        <div class="tab-content" id="myTabContent">
            <!--usuarios-->
            <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab" background="yellow">
                <div class='row busqueda'>
                    <div class="col">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method='POST'>
                            <b>Nombre: </b><input type="text" id="campo" name="campo">
                            <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="col">
                        <a href="nuevoUsuario.php?idUsuario=<?php echo $idUsuario; ?>" type="button" class="btn btn-primary">Crear nuevo usuario</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-warning table-striped table-bordered table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Celular</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row2 = $resultado2->fetch_array(MYSQLI_ASSOC)) {
                                $usuario1 = $row2['idUsuario'];
                            ?>
                                <tr>
                                    <td class="table-warning"><?php echo $row2['idUsuario']; ?></td>
                                    <td class="table-warning"><?php echo $row2['nombre']; ?></td>
                                    <td class="table-warning"><?php echo $row2['email']; ?></td>
                                    <td class="table-warning"><?php echo $row2['celular']; ?></td>
                                    <td class="table-warning"><?php echo $row2['rol']; ?></td>
                                    <td class="table-warning">
                                        <a href="editarUsuario.php?idUsuario1=<?php echo $usuario1; ?>&idUsuario=<?php echo $row['idUsuario']; ?>" type="button" class="btn btn-secondary">Editar</a>
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
<?php

include '../conexionDb.php';

session_start();

require '../logout.php';

$idProducto = $_GET['idProducto'];
$idUsuario = $_GET['idUsuario'];
$sql = "SELECT * FROM producto where idProducto= '$idProducto'";
$resultado = $conexionDb->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

$idProveedor = $row['idProveedor'];

$sql1 = "SELECT * FROM proveedor WHERE idProveedor=$idProveedor";
$resultado1 = $conexionDb->query($sql1);
$row1 = $resultado1->fetch_array(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../JS/validaciones.js"></script>
    <title>Inicio de sesión</title>
</head>

<body>
    <div class="formulario">
        <h3>Solicitar producto</h3>
        <form action="actualizarProducto.php?idProducto=<?php echo $idProducto; ?>&idUsuario=<?php echo $idUsuario; ?>" method="POST">
            <div class="mb-3">
                <label for="parteNumero" class="form-label">Número de parte</label>
                <input type="text" class="form-control" id="parteNumero" name="parteNumero" value="<?php echo $row['parteNumero']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $row['stock']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="stockMin" class="form-label">Cantidad a solicitar</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $row2['cantidad']; ?>">
            </div>
            <div class="mb-3">
                <label for="idProveedor" class="form-label">Proveedor</label><br>
                <input type="text" class="form-control" id="idProveedor" name="idPorveedor" value="<?php echo $row1['nombreProveedor']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación bodega</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo $row['ubicacion']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Fecha de Solucitud</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $row['ubicacion']; ?>">
            </div>
            <div class="boton">
                <a href="productos.php?idUsuario=<?php echo $idUsuario; ?>"><button type="button" class="btn btn-secondary">VOLVER</button></a>
                <!-- <input type="submit" value="GUARDAR" class="btn btn-primary"> -->
                <button type="submit">GUARDAR</button> 
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
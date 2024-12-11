<?php

    require '../conexionDb.php';

    session_start();

    require '../logout.php';

    $idProducto = $_GET['idProducto'];
    $idUsuario = $_GET['idUsuario'];
    $sql = "SELECT * FROM producto where idProducto= '$idProducto'";
    $resultado = $conexionDb->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ingreso</title>
</head>
<body>

    <div class="formulario">
        <h3>Entrada de producto</h3>
        <form action="guardarEntrada.php?idProducto=<?php echo $idProducto;?>&idUsuario=<?php echo $idUsuario;?>" method="POST">
            <div class="mb-3">
                <label for="idProducto" class="form-label">Parte número</label>
                <input type="text" class="form-control" name="parteNumero" value="<?php echo $row['parteNumero'];?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre'];?>" readonly>
            </div class="mb-3">
            <div class="mb-3">
                <label for="stock" class="form-label">Cantidad en Inventario</label>
                <input type="number" class="form-control" name="stock" value="<?php echo $row['stock'];?>" readonly>
            </div class="mb-3">
            <div class="mb-3">
                <label for="stockMax" class="form-label">stockMax</label>
                <input type="number" class="form-control" name="stockMax" value="<?php echo $row['stockMax'];?>" readonly>
            </div class="mb-3">
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad a ingresar</label>
                <input type="number" class="form-control" name="cantidad" required>
            </div>
            <div class="boton" >
                <a href="productos.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-secondary">VOLVER</button></a>
                <input type="submit" value="GUARDAR" class="btn btn-primary">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
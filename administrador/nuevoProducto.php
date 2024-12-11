<?php

    include '../conexionDb.php';

    session_start();

    require '../logout.php';

    $idUsuario = $_GET['idUsuario'];

    // consulta proveedor
    $sql = "SELECT * FROM proveedor";
    $resultado = $conexionDb->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../JS/validaciones.js"></script>
    <title>Nuevo producto</title>
</head>
<body>
    <div class="formulario">
        <h3>Crear nuevo producto</h3>
        <form action="guardarProducto.php?idUsuario=<?php echo $idUsuario;?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="parteNumero" class="form-label">Número de parte</label>
                <input type="text" class="form-control" id="parteNumero"  name="parteNumero" placeholder="Ingrese en número de parte" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombre"  name="nombre" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock"  name="stock" placeholder="Ingrese stock actual" required>
            </div>
            <div class="mb-3">
                <label for="stockMin" class="form-label">Stock Mínimo</label>
                <input type="number" class="form-control" id="stockMin"  name="stockMin" placeholder="Ingrese stock mínimo" required>
            </div>
            <div class="mb-3">
                <label for="stockMax" class="form-label">Stock Máximo</label>
                <input type="number" class="form-control" id="stockMax"  name="stockMax" placeholder="Ingrese stock máximo" required>
            </div>
            <div class="mb-3">
                <label for="idProveedor" class="form-label">Proveedor</label><br>
                <select id="idProveedor" name="idProveedor">
                    <option value="" selected>Seleccione un proveedor</option>
                    <?php
                        while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['idProveedor'];?>"><?php echo $row['nombreProveedor']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación bodega</label>
                <input type="text" class="form-control" id="ubicacion"  name="ubicacion" placeholder="Ingrese la ubicación en bodega" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label><br>
                <select id="estado" name="estado">
                    <option value="" selected>Seleccione el estado del producto</option>
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </select>
            </div>

            <div class="boton">
                <a href="productos.php?idUsuario=<?php echo $idUsuario;?>"><button type="button" class="btn btn-secondary">VOLVER</button></a>
                <!-- <input type="submit" value="GUARDAR" class="btn btn-primary"> -->
                <button type="submit">GUARDAR</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
require ("../conexionDb.php");
// Select que llena los campos segun el id del equipo

session_start();

require '../logout.php';

$IdPedido = $_GET['IdPedido'];
$idUsuario = $_GET['idUsuario'];
$sql = "SELECT p.nombre,p.stock, p.IdProducto, pe.IdPedido, pe.Cantidad, pe.fecha 
        FROM pedido pe INNER JOIN producto p 
        ON pe.idProducto = p.idProducto where IdPedido= '$IdPedido'";
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
    <script src="../JS/validaciones.js"></script>
    <title>Inicio de sesión</title>
</head>

<body>
    <div class="formulario">
        <h3>Envio del Pedido</h3>
        <form action="guardarEnvio.php?IdPedido=<?php echo $IdPedido; ?>&idUsuario=<?php echo $idUsuario; ?>" method="POST">
            <div class="mb-3">
                <label for="idPedido" class="form-label">Id Pedido</label>
                <input type="number" class="form-control" id="idPedido" name="idPedido" value="<?php echo $row['IdPedido']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="IdProducto" class="form-label">Id Producto</label>
                <input type="number" class="form-control" id="IdProducto" name="IdProducto" value="<?php echo $row['IdProducto']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input onkeydown="bloquearNumeros(event)" type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="Cantidad" name="Cantidad" value="<?php echo $row['Cantidad']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Cantidad actual en el inventario</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $row['stock']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Fecha" class="form-label">Fecha del Pedido</label>
                <input type="date" class="form-control" id="Fecha" name="Fecha" value="<?php echo $row['fecha']; ?>"readonly>
            </div>
            <div class="mb-3">
                <label for="numeroGuia" class="form-label">numero de Guia</label>
                <input type="text" class="form-control" id="numeroGuia" name="numeroGuia" placeholder="Ingrese numero de Guia" required>
            </div>
            <div class="mb-3">
                <label for="fechaEnvio" class="form-label">Fecha de Envio</label>
                <input type="date" class="form-control" id="fechaEnvio" name="fechaEnvio">
            </div>
            <div class="boton">
                <a href="pedidos.php?idUsuario=<?php echo $idUsuario; ?>"><button type="button" class="btn btn-secondary">VOLVER</button></a>
                <!-- <input type="submit" value="GUARDAR" class="btn btn-primary"> -->
                <button type="submit" class="btn btn-success">Enviar</button> 
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php

    require 'conexionDb.php';

    session_start();

    require '../logout.php';
    
    $sql = "SELECT * FROM producto";
    $resultado = $conexionDb->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <div>
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php
                    while($row = $resultado->fetch_array(MYSQLI_ASSOC)){
                ?>
                <tr>
                    <td><?php echo $row['idProducto'];?></td>
                    <td><?php echo $row['nombre'];?></td>
                    <td><?php echo $row['cantidad'];?></td>
                    <td><a href="ingreso.php?idProducto=<?php echo $row['idProducto'];?>">Ingreso</a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
include '../conexionDb.php';

session_start();

require '../logout.php';

$idPedido = $_REQUEST['IdPedido'];

$borrarPedido = ("DELETE From pedido where idPedido='".$idPedido."' ");
mysqli_query($conexionDb,$borrarPedido)
?>
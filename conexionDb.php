<?php



    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'repuestockfinal';
    
    $conexionDb = new mysqli($server,$user,$pass,$db);

    if($conexionDb-> connect_errno){
        die('Error conectando a la DB'.$mysqli->connect_error);
    }

?>
<?php

    $host = 'linkedbar.es';
    $db = 'restaureat';
    $user = 'bar';
    $pass = 'DAW2023';

    $con = mysqli_connect($host, $user, $pass, $db);
    if(!$con){
        die("Fallo en la conexión ". mysqli_connect_error());
    }

    $idProducto = isset($_GET['idProducto']) ? $_GET['idProducto'] : NULL;

    $sql = "SELECT COUNT(*) as count FROM productoTieneCategoria WHERE producto_idProducto = ".$idProducto;
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
    
    echo $count;



    
?>

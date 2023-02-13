<?php

    $host = 'linkedbar.es';
    $db = 'restaureat';
    $user = 'bar';
    $pass = 'DAW2023';

    if(isset($_GET['valor_input']) && $_GET['tipo_input'] == 'etiqueta'){
        $valor_input = $_GET['valor_input'];
        $con = mysqli_connect($host, $user, $pass, $db);
        if(!$con){
            die("Fallo en la conexión ". mysqli_connect_error());
        }
        $query = "SELECT DISTINCT * FROM etiqueta WHERE alergeno = 0";
        $result = mysqli_query($con, $query);
        $registros = array();
        while($row = mysqli_fetch_assoc($result)) {
            $registros[] = $row;
        }
        
        echo json_encode($registros);

        mysqli_close($con);
    }

<?php
$host = 'linkedbar.es';
$db = 'restaureat';
$user = 'bar';
$pass = 'DAW2023';

$nombreEtiqueta = $_GET['etiqueta'];
$nombreEtiquetaNormal = $_GET['etiquetaNormal'];

$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    die("Fallo en la conexión " . mysqli_connect_error());
}
$pasar = true;
$result =  $con->query("SELECT nombre FROM etiqueta");
$array = array();

while ($row = mysqli_fetch_array($result)) {
    $nombre = $row['nombre'];
    $array[] = $nombre;
    strtolower($nombre);
    str_replace("á", "a", $nombre);
    str_replace("é", "e", $nombre);
    str_replace("í", "i", $nombre);
    str_replace("ó", "o", $nombre);
    str_replace("ú", "u", $nombre);
}
if(in_array($nombreEtiqueta, $array)){
    $pasar = false;
    echo "existe";
    
}else{
    $con->query("INSERT INTO etiqueta (nombre,alergeno,img) VALUES ('$nombreEtiqueta',0,'')");
    $pasar = true;
    // cogemos el id de la etiqueta que acabamos de insertar
    $lastId = $con->insert_id;

    // hacemos una consulta para obtener los datos de la etiqueta que acabamos de insertar
    $query = $con->query("SELECT * FROM etiqueta WHERE idEtiqueta='$lastId' ORDER BY idEtiqueta DESC LIMIT 1");

    // pasamos los datos de la etiqueta a un array
    $etiqueta = $query->fetch_assoc();

    //devolvemos el array en formato json
    echo json_encode($etiqueta);
}

<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();
//Capturar los datos
$json = file_get_contents('php://input');
//Procesar los datos
$datos = json_decode($json, true);

print_r($datos);

if(is_array($datos)){
    $id_transaccion = $datos['detalles'];
}


?>
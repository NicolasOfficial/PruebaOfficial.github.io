<?php
class Database{
private $hostname = "localhost";
private $database = "tienda_online";
private $username = "webshop";
private $password = "Hola741My789";
private $charset = "utf8";


function conectar()
{

    try{

    
$conexion = "mysql:host=".$this->hostname."; dbname=".$this->database."; charset=".$this->charset;

$opcions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];

$pdo = new PDO($conexion, $this->username, $this->password, $opcions);

return $pdo;
}catch(PDOException $e){
    echo "error conexion".$e->getMessage();
    exit;
}
}



}
















?>
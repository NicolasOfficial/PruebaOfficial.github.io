
<?php
//   https://www.php.net/manual/es/funcref.php

//   https://www.php.net/manual/es/ref.math.php
?>

<?php

//Te dice donde esta el (ultimo error)
print_r(error_get_last());


?>

<?php
//Numeros aleatorios
$numA = rand(1, 10);

echo "Numero aleatorio".$numA;



?>

<?php

//Valor max y min
$val = min(6, 7, 10, 34);
echo "El valor mas alto es ".$val;



?>

<?php
// Este muestra la zona horaria que quieras
date_default_timezone_set('Mexico/General');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'La zona horaria del script difiere de la zona horaria de la configuracion ini.'."<br/>";
} else {
    echo 'La zona horaria del script y la zona horaria de la configuración ini coinciden.';
}



$Hoy=date("Y - m - d - h - i - s")."<br/>";
echo $Hoy;


$Hoy1=date("e")."<br/>";
echo $Hoy1;




?>

<?php




?>

<?php




?>

<?php




?>
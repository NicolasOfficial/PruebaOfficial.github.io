<?php

define("CLIENT_ID", "AcCSn9S_hh_MXFn6lU6sCG9m5RbY-pGtZ8sYf4FbzeW0MlSQPJT6LRbZAvLL4vSEHz9DiFLDUfIKO5er");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "ABC123_759.758-J*4");
define("MONEDA", "$");

//Seciones
session_start();
$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}


?>
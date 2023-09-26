<?php

// <div class="d-flex justify-content-between aling-items-center">    (Se utilza para dejar un espacio en medio de los botones Detalles y agregar)
//hola


require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
//print_r($_SESSION);

//$lista_carrito = array();

if($productos != null){
foreach($productos as $clave => $cantidad){



$sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo = 1 ");
$sql->execute([$clave]);
$lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);

//session_destroy();
//print_r($_SESSION);
        }
    }else{
        header("Location: Proyectopainicial.php");
        exit;
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" 
     crossorigin="anonymous">

   


</head>
<body>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" 
crossorigin="anonymous"></script>

<!– Este es la cabezera de la pagina –>
<div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="Proyectopainicial.php" class="btn btn-info" aria-current="page">Inicio</a></li>
        <li class="nav-item"><a href="#" class="btn btn-outline-info">Iniciar secion</a></li>
     
 
        <li class="nav-item"><a href="#" class="btn btn-outline-info">About</a></li>

        <li class="nav-item"><a href="checkout.php" class="btn btn-info" aria-current="page">
          Carrito <span id="num_cart" class="badge bg-light text-dark"><?php echo $num_cart; ?></span>
        </a></li>



        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-info" type="submit">Search</button>

 

        </form>
      </ul>
    </header>
  </div>


<!– Aquie estan las secciones de productos–>

<main>
  <div class="container">


    <div class="row">
      <div class="col-6">

          <h4>Detalles de pago</h4>
          <div id="paypal-button-container"></div>
        </div>

      <div class = "col-6">


        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>SubTotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lista_carrito == null) {
                        echo '<tr><td colspan="5" class="text-center"><b>Lista Vacia</b></td></tr>';
                    }else{
                        $total = 0;
                        foreach($lista_carrito as $producto){
                            $_id = $producto['id'];
                            $nombre = $producto['nombre'];
                            $precio = $producto['precio'];
                            $descuento = $producto['descuento'];
                            $cantidad = $producto['cantidad'];
                            $precio_desc = $precio - (($precio * $descuento )/100);
                            $subtotal = $cantidad * $precio_desc;
                            $total += $subtotal;
                            
                        
                    
                    ?>

                    <tr>
                        <td><?php echo $nombre ?></td>
                        <td>
                            <div id="subtotal_<?php echo $_id;  ?>" name="subtotal[]"><?php  echo MONEDA.number_format($subtotal, 2, '.', ',' ); ?></div>
                        </td>

                      
                    </tr>
                    <?php } ?>

                    <tr>
                       
                        <td colspan="2"><p class="h3 text-end" id="total"><?php echo MONEDA.number_format($total, 2, '.', ',')  ?></p></td>
                    </tr>
                </tbody>
                <?php } ?>

            </table>

        </div>



        </div>
          

    </div>
  </div>


</main>

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID;  ?>&currency=<?php echo CURRENCY; ?>"></script>

<script>

    paypal.Buttons({
        style:{
            color: 'white',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $total;  ?>
                    }

                }]
            });
        },

        onApprove: function(data, actions){
          let URL = 'clases/captura.php'
            actions.order.capture().then(function (detalles){
                console.log(detalles)
               // window.location.href="Proyectopagoscompletado.html"
                
               let url = 'clases/captura.php'
                return fetch(url, {
                    method: 'post',
                    headers:{
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        detalles: detalles
                    })
                })
            });

        },
        onCancel: function(data){
            alert("Pago cancelado")
            console.log(data);


        }

    }).render('#paypal-button-container');
</script>




</body>
</html>
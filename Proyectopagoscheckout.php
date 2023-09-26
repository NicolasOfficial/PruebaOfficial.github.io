<?php

// PASO 1: Primero creamos una cuenta en paypal
// PASO 2: Te metes a la pagina paypal debeloper
//PASO 3: Creas una aplicacion en la pagina de paypal, seccion aplicaciones y credenciales
//PASO 4: copias el client id
//PASO 5: Te metes a paypal checkout debeloper



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!– Paso 6 insertas el script de checkout debeloper y pegas el clien id  –>
    <script src="https://www.paypal.com/sdk/js?client-id=AcCSn9S_hh_MXFn6lU6sCG9m5RbY-pGtZ8sYf4FbzeW0MlSQPJT6LRbZAvLL4vSEHz9DiFLDUfIKO5er&currency=MXN"></script>
</head>
<body>
   


<div id="paypal-button-container"></div>




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
                        value: 8500
                    }

                }]
            });
        },

        onApprove: function(data, actions){
            actions.order.capture().then(function (detalles){
                console.log(detalles);
               // window.location.href="Proyectopagoscompletado.html"
                
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
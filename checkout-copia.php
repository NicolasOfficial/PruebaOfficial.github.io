<?php

// <div class="d-flex justify-content-between aling-items-center">    (Se utilza para dejar un espacio en medio de los botones Detalles y agregar)
//hola


require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
//print_r($_SESSION);
//Muestra los arrays
$lista_carrito = array();

if($productos != null){
foreach($productos as $clave => $cantidad){



$sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo = 1 ");
$sql->execute([$clave]);
$lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);

//session_destroy();
//print_r($_SESSION);
        }


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

     <link rel="stylesheet" href="BotoneS.css">
   


</head>
<body>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" 
crossorigin="anonymous"></script>



 <!--Aqui empieza Modo oscuro-->

 <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
      <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
  </svg>


    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                aria-label="Toggle theme (auto)">
          <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
          <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
              Light
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
              Dark
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
              Auto
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
        </ul>
      </div>

      <script src="./modo-oscuro.js" defer></script>

<!-- Aqui termina Modo oscuro-->

<!-- Aqui empieza la cabezera-->

<header class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark" aria-label="Tenth navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas-body">

          <ul class="navbar-nav flex-grow-1 justify-content-between nav nav-pills">
      <li class="nav-item"><a href="index.html" class="btn btn-outline-warning">Casa</a></li>
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

          </div>
        </div>
</header>

    
    <!-- Aqui termina la cabezera-->   

<!– Aquie estan las secciones de productos–>

<main>
<div class="container">


<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
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
                <td><?php echo MONEDA.number_format($precio_desc, 2, '.', ','); ?></td>
                <td> 
                    <input type="number" min= "1" max="10" step="1" value="<?php  echo $cantidad  ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>) ">
                </td>
                <td>
                    <div id="subtotal_<?php echo $_id;  ?>" name="subtotal[]"><?php  echo MONEDA.number_format($subtotal, 2, '.', ','); ?></div>
                </td>
                <td>
                    <a href="#" id="Eliminar" class="btn btn-danger btn-sn" data-bs-id="<?php echo $_id;   ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                  
                </td>
              
            </tr>
            <?php } ?>

            <tr>
                <td colspan="3"></td>
                <td colspan="2"><p class="h3" id="total"><?php echo MONEDA.number_format($total, 2, '.', ',')  ?></p></td>
            </tr>
        </tbody>
        <?php } ?>

    </table>

</div>

<?php if($lista_carrito != null) {  ?>
  <div class="row">
    <div class="col-md-5 offset-md-7 d-grid gap-2">
        
        <a href="pago.php" class="btn-neon">
                    <span id="span1"></span>
                    <span id="span2"></span>
                    <span id="span3"></span>
                    <span id="span4"></span>
                    Realizar Pago
                </a>
    </div>
  </div>
<?php  } ?>
</div>
  
</main>

<?php   // Modal de eliminar  ?>

<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta del Modal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el producto de la lista?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id = "btn-elimina" type="button" class="btn btn-danger" onclick= "eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>









<script>
//  javascrip = Intercambio de datos



    let eliminaModal = document.getElementById('eliminaModal')
    eliminaModal.addEventListener('show.bs.modal', function(event){
        let button = event.relatedTarget
        let id = button.getAttribute('data-bs-id')
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
        buttonElimina.value = id

    })

  function actualizaCantidad( cantidad, id){
      let url = 'clases/actualizar_carrito.php'
      let formData = new FormData()
      formData.append('action', 'agregar')
      formData.append('id', id)
      formData.append('cantidad', cantidad)
     
      fetch(url, {
        method: 'POST',
        body: formData, 
        mode: 'cors'


      }).then(response => response.json())
        .then(data => {
          if(data.ok){

            let divsubtotal = document.getElementById('subtotal_' + id)
            divsubtotal.innerHTML = data.sub 

            let total = 0.00
            let list = document.getElementsByName('subtotal[]')

            for(let i = 0; i < list.length; i++){
                total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
            }
            total = new Intl.NumberFormat('en-US',{
                minimunFractionDigits: 2
            }).format(total)
            document.getElementById('total').innerHTML = '<?php echo MONEDA;  ?>' + total

          }
        })

  }

  
  function eliminar(){
      let botonElimina = document.getElementById('btn-elimina')
      let id = botonElimina.value

      let url = 'clases/actualizar_carrito.php'
      let formData = new FormData()
      formData.append('action', 'eliminar')
      formData.append('id', id)
  
     
      fetch(url, {
        method: 'POST',
        body: formData, 
        mode: 'cors'


      }).then(response => response.json())
        .then(data => {
          if(data.ok){
            location.reload()

          }
        })

  }




</script>








</body>
</html>
<?php

// <div class="d-flex justify-content-between aling-items-center">    (Se utilza para dejar un espacio en medio de los botones Detalles y agregar)
//hola


require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
print_r($_SESSION);

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

<!– Este es la cabezera de la pagina –>
<div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="btn btn-info" aria-current="page">Inicio</a></li>
        <li class="nav-item"><a href="#" class="btn btn-outline-info">Iniciar secion</a></li>
     
 
        <li class="nav-item"><a href="#" class="btn btn-outline-info">About</a></li>

        <li class="nav-item"><a href="#" class="btn btn-info" aria-current="page">
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
                <td><?php echo MONEDA.number_format($precio_desc, 2, '.', ',' ); ?></td>
                <td> 
                    <input type="number" min= "1" max="10" step="1" value="<?php  echo $cantidad  ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>) ">
                </td>
                <td>
                    <div id="subtotal_<?php echo $_id;  ?>" name="subtotal[]"><?php  echo MONEDA.number_format($subtotal, 2, '.', ',' ); ?></div>
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
    <a href="#" class="btn-neon">
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


<div class="spinner-border text-primary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-border text-secondary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-border text-success" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-border text-danger" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-border text-warning" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-border text-info" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-border text-light" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-border text-dark" role="status">
  <span class="visually-hidden">Loading...</span>
</div>

<div class="spinner-grow text-primary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-danger" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-warning" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-info" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-light" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-dark" role="status">
  <span class="visually-hidden">Loading...</span>
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
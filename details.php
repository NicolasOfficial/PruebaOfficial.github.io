<?php

// <div class="d-flex justify-content-between aling-items-center">    (Se utilza para dejar un espacio en medio de los botones Detalles y agregar)
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id']: '';
$token = isset($_GET['token']) ? $_GET['token']: '';

if($id == '' || $token == '' ){
  echo 'Error al procesar la peticion';
  exit;
}else{

  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

  if($token == $token_tmp){
   
    $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo = 1");
    $sql->execute([$id]);

    if($sql->fetchColumn() > 0){
    
    
      $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo = 1 LIMIT 1");
      $sql->execute([$id]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $precio = $row['precio'];
    $descuento = $row['descuento'];
    $precio_desc = $precio - (($precio * $descuento) / 100);
    $dir_images = "Imagespro/productos/" . $id . "/";
    $rutaImg = $dir_images . "protoboard.jpg";
    if(!file_exists($rutaImg)){
        $rutaImg = "Imagespro/no-foto.jpg";

    }

    $imagenes = array();
    if(file_exists($dir_images)){


    
    $dir = dir($dir_images);


    while(($archivo = $dir->read()) != false){
        if($archivo != 'protoboard.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpg'))){
   
          $imagenes[] = $dir_images . $archivo;
      }
    }
    $dir->close();
}
    





    }

    

  }else{
    echo 'Error al procesar la peticion';
    exit;
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

   


</head>
<body>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" 
crossorigin="anonymous"></script>

<!– Este es la cabezera de la pagina –>
<div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="Proyectopainicial.php" class="nav-link active" aria-current="page">Inicio</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Iniciar secion</a></li>
     
 
        <li class="nav-item"><a href="#" class="nav-link">About</a></li>

        <li class="nav-item"><a href="checkout.php" class="nav-link active" aria-current="page">
          Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
        </a></li>

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>

 

        </form>
      </ul>
    </header>
  </div>


<!– Aquie estan las secciones de productos–>



<main>
      <div class="container">
      <hr class="featurette-divider">

          <div class="row">

            <div class="col-md-6 order-md-1">
            <div id="carouselImages" class="carousel slide">
  <div class="carousel-inner">
        <div class="carousel-item active">

          <img src="<?php  echo $rutaImg; ?>"  width="200" width="700"  class="d-block w-100" >
        </div>

        <?php   foreach($imagenes as $img ){ ?>
        <div class="carousel-item">

        <img src="<?php  echo $img; ?>"  width="200" width="700"  class="d-block w-100">
        </div>
        <?php }  ?>




  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


          
        </div>

        <div class="col-md-6 order-md-2">

            <h2><?php echo $nombre;  ?></h2>

            <?php if($descuento > 0) { ?>

              <p><del><?php echo MONEDA.number_format($precio, 2, '.', ','); ?></del></p>
              <h2>
                <?php echo MONEDA.number_format($precio_desc, 2, '.', ','); ?>
                <small class="text-success"><?php echo $descuento;  ?>% descuento</small>
              </h2>

              <?php } else{ ?>

              

            <h2><?php echo MONEDA.number_format($precio, 2, '.', ','); ?></h2>

                <?php } ?>

            <p class="lead">
              <?php  echo $descripcion;  ?>
            </p>
            <div class="d-grid gap-3 col-5 mx-auto">
              <button class="btn btn-primary" type="button">comprar ahora</button>
              <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id; ?>,'<?php echo $token_tmp; ?>')">agregar al carrito</button>

            </div>


        </div>
      </div>
      <hr class="featurette-divider">
  </div>


</main>


<!– Usando javascrip para boton token carrito (PETICION DE AJAX)–>

<script>

  function addProducto( id, token){
      let url = 'clases/carrito.php'
      let formData = new FormData()
      formData.append('id', id)
      formData.append('token', token)
      fetch(url, {
        method: 'POST',
        body: formData, 
        mode: 'cors'


      }).then(response => response.json())
        .then(data => {
          if(data.ok){
            let elemento = document.getElementById("num_cart")
            elemento.innerHTML = data.numero
          }
        })

  }



</script>






</body>
</html>
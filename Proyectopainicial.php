<?php

// <div class="d-flex justify-content-between aling-items-center">    (Se utilza para dejar un espacio en medio de los botones Detalles y agregar)
//hola


require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo = 1 ");
$sql->execute();
$resultado = $sql->fetchALL(PDO::FETCH_ASSOC);

//session_destroy();
//print_r($_SESSION);x

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">''
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
      <li class="nav-item"><a href="Iniciohome.php" class="btn btn-outline-warning">Casa</a></li>
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

<hr class="featurette-divider">
<?php foreach($resultado as $row) { ?>
    <div class="row featurette">

      <div class="col-md-7 order-md-2">

        <h2 class="featurette-heading fw-normal lh-1"><?php  echo $row['nombre'];   ?><span class="text-body-secondary"></span></h2>
        <p class="lead"></p>
        <p class="card-text">$ <?php  echo number_format( $row['precio'], 2, '.', ',');   ?></p>

        <div class="btn-group">
            <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-light">Detalles</a>
        </div>
        <button class="btn btn-info" type="button" onclick="addProducto(<?php echo $row['id']; ?>,'<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">agregar al carrito</button>
      </div>



      <div class="col-md-5 order-md-1">


                      <?php
                          $id = $row['id'];
                          $imagen = "Imagespro/productos/" . $id . "/protoboard.jpg";

                          if (!file_exists($imagen)){
                              $imagen = "Imagespro/no-foto.jpg";
                          }

                      ?>

        <img src="<?php  echo $imagen;  ?>" width="200" width="700">

      </div>
    </div>
       <hr class="featurette-divider">

    <?php } ?>

  


</main>



<script>
// Usando javascrip 
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botones colores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" 
     crossorigin="anonymous">

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" 
crossorigin="anonymous"></script>
<style>
        .nav-link {
            color: green;
        }
 
        .nav-item>a:hover {
            color: green;
        }
 
        /*code to change background color*/
        .navbar-nav>.active>a {
            background-color: #C0C0C0;
            color: green;
        }
    </style>
   <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
      <li class="nav-item"><a href="#" class="nav-link">Casa</a></li>
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Inicio</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Iniciar secion</a></li>
     
 
        <li class="nav-item"><a href="#" class="nav-link">About</a></li>



        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>

 

        </form>
      </ul>
    </header>
  </div>

                 






</body>
</html>
 
   
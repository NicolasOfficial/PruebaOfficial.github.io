<?php

public class EmpleadoDecorator implements Person {
    private Empleado empleado;
    public EmpleadoDecorator(Empleado empleado){
        this.empleado = empleado;
    }
    public String getName(){
        // llama al método de la clase empleado 
        String name = empleado.getName();
        // Asegúrate de que la primera letra está en mayúsculas
        name = Character.toUpperCase(name.charAt(0)) 
        + name.substring(1, name.length());
        return name;
    }
    }

    $Empleado = $nombre.Empleado();

    $hub = $nombre['baki'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<p><?php echo $hub['Nombre'];?></p>




    
</body>
</html>
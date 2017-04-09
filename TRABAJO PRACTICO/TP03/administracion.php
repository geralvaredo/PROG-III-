
<?php 

require("Empleado.php");


    $legajo = $_POST['legajo'] ;
    
    $nombre = $_POST['nombre'] ;
    $apellido = $_POST['apellido'] ;
    $dni = $_POST['dni'] ;
    $sexo = $_POST['sexo'] ;
    $sueldo = $_POST['sueldo'] ;
    

$e1 = new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo);


   Empleado::Guardar($e1) ;



?>

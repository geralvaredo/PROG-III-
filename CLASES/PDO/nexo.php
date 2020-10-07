<?php
include("clases/cd.php");
include("clases/AccesoDatos.php");
$caso = $_POST['caso'];
switch ($caso) {
    case 'traerTodos':
           $comp = cd::TraerTodoLosCds();
           print_r($comp);
          echo $json = json_encode($comp);
            $obj = json_decode($json);
            $cd = new Producto $obj[0]->titulo;

           
           //var_dump($json);
           //var_dump($obj);
            // foreach($json);
            break;
   case 'guardar':



   case 'modificar':
   case 'borrar':
   case 'traerPorId':     
   
           
    default:
        # code...
        break;
} 



?>
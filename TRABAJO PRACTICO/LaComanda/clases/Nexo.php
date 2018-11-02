<?php  
//include("clases/AccesoDatos.php");
//include("empleadoAPI.php");

$caso = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'] ;
$entidad = $_SERVER ['entidad'] ;
switch ($caso) {
    case 'GET': 
                echo "HOLA GET"; 
                 echo $entidad ;    
        break;
    case 'POST':
               echo "POST";
        break;
    case 'PUT':
                echo "PUT";
                //header('Location:' . $entidad);
        break;
    case 'DELETE':
                  echo "DELETE";     
                //header('Location:' . $entidad);
        break; 
        default:
    
        break;
}
/*
echo "<pre>" ;
print_r(Empleado::traerEmpleados());
echo "</pre>" ;
echo "<pre>" ;
print_r(Encuesta::traerEncuesta());
echo "</pre>" ;
*/
?>
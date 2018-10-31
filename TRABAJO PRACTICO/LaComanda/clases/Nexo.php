<?php  
include("AccesoDatos.php");
include("empleadoAPI.php");

$caso = $_SERVER['REQUEST_METHOD'];
$entidad = $_SERVER['REQUEST_URI'] ;
switch ($entidad) {
    case '/empleado': 
                     
        break;
    case 'POST':
                header('Location:' . $entidad);
        break;
    case 'PUT':
                header('Location:' . $entidad);
        break;
    case 'DELETE':
                header('Location:' . $entidad);
        break; 
        default:
    
        break;
}

echo "<pre>" ;
print_r(Empleado::traerEmpleados());
echo "</pre>" ;
echo "<pre>" ;
print_r(Encuesta::traerEncuesta());
echo "</pre>" ;

?>
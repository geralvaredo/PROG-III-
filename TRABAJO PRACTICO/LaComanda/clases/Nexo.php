<?php  
include("AccesoDatos.php");
include("Empleado.php");
include("Encuesta.php");
echo "<pre>" ;
print_r(Empleado::traerEmpleados());
echo "</pre>" ;
echo "<pre>" ;
print_r(Encuesta::traerEncuesta());
echo "</pre>" ;

?>
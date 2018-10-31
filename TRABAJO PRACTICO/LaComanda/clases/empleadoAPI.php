<?php 
include("Empleado.php");


class EmpleadoAPI extends Empleado implements IApiEmpleado
{
    $app->group("/empleado", function(){
        $this->post("/",\EmpleadoAPI::class . ':empleados');
    });    
    
    public function empleados(){
        $persona = Empleado::traerEmpleados();
        $response = $response->withJson($persona,200);
        return $response;
    }  
}

interface IApiEmpleado{
    public function empleados();
}
//la api es el manejador ABM de la entidad;



?>
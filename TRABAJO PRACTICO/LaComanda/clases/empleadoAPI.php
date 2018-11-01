<?php 
include("clases/Empleado.php");

class EmpleadoAPI extends Empleado implements IApiEmpleado
{
    /*/$app->group("/empleado", function(){
        $this->post("/",\EmpleadoAPI::class . ':empleados');
    });   
    */
    public function listar($request, $response){
        $personas = Empleado::traerEmpleados();
        $newResponse = $response->withJson($personas,200);
        return $newResponse;
    }

    public function listarEmpleado($request, $response,$id){
        $persona = Empleado::listarPorId($id);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    }  
    
    public function borrarEmpleado($request, $response,$id){
        $persona = Empleado::borrarPorId($id);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    } 

    public function insertarEmpleado($request, $response,$obj){
        $persona = Empleado::insertar($obj);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    }
    
    public function modificarEmpleado($request, $response,$obj){
        $persona = Empleado::modificar($obj);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    }

}

interface IApiEmpleado{
    public function listar($request, $response);
    public function listarEmpleado($request, $response,$id);
    public function borrarEmpleado($request, $response,$id);
    public function insertarEmpleado($request, $response,$obj);
    public function modificarEmpleado($request, $response,$obj);
}
//la api es el manejador ABM de la entidad;



?>
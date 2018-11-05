<?php 
include("clases/Empleado.php");

class EmpleadoAPI extends Empleado implements IApiEmpleado
{
   
    public function listar($request, $response){
        $personas = Empleado::traerEmpleados();
        $newResponse = $response->withJson($personas,200);
        return $newResponse;
    }

    public function listarEmpleado($request, $response,$args){
        $id = $args['id'];
        $persona = Empleado::listarPorId($id);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    }  
    
    public function borrarEmpleado($request, $response){
        $id = $request->getAttribute('id');
        //$id = $obj['id'];  
        $persona = Empleado::borrarPorId($id);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    } 

    public function insertarEmpleado($request, $response){
        $obj = $request->getParsedBody();
       // var_dump($obj);
        $p = new Empleado();
        $p->nombre = $obj['nombre'] ;
        $p->idPuesto = $obj['idPuesto'] ;     
        var_dump($p);             
        $persona = Empleado::insertar($p);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    }
    
    public function modificarEmpleado($request, $response){
        // para realizar el put en el postman se debe realizar en el body como 'x-www-form-urlencoded'
        // para obtener los parametros se usa getContents
        $obj = explode("&",$request->getBody()->getContents()) ;               
        $empleado = new Empleado();              
        $empleado->id = substr($obj[0],3);          
        $empleado->nombre =  substr($obj[1],7);
        $empleado->idPuesto = substr($obj[2],9);
        $persona = Empleado::modificar($empleado);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;
    }

}

interface IApiEmpleado{
    public function listar($request, $response);
    public function listarEmpleado($request, $response,$id);
    public function borrarEmpleado($request, $response);
    public function insertarEmpleado($request, $response);
    public function modificarEmpleado($request, $response);
}
//la api es el manejador ABM de la entidad;



?>
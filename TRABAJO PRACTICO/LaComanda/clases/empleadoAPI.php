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
        //$p = new Empleado();
        //$p->nombre = $obj['nombre'] ;
        //echo $p->nombre;
        /*$p->nombre = $args['nombre'];
        $p->idPuesto = $args['idPuesto'];
        echo $p->nombre ;   -*/      
        /*$persona = Empleado::insertar($p);
        $newResponse = $response->withJson($persona,200);
        return $newResponse;*/ 
    }
    
    public function modificarEmpleado($request, $response){
        $obj = $request->getParsedBody();        
        var_dump($obj);
        $empleado = new Empleado();         
         $empleado->id = $obj['id'] ;          
          $empleado->nombre = $obj['nombre'];
         $empleado->idPuesto = $obj['idPuesto'];
        //$persona = Empleado::modificar($empleado);
        //$newResponse = $response->withJson($persona,200);
       // return $newResponse;
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
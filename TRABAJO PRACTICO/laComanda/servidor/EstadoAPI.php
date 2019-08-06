<?php
include("laComanda/clases/Estado.php");
include("laComanda/clases/IApiEstado.php");


class EstadoAPI extends Estado implements IApiEstado{

    function __construct()
    {
    }

    public function insertarEstado($request, $response){
        
        $clase = new stdclass();
        $clase->respuesta = "";
        $perfil = $_REQUEST['perfil'];
        if($perfil != "socio"){
            $clase->respuesta =  "no tiene permisos para asignar un empleado al pedido" ;
        }else{
            $obj = $request->getParsedBody();       
            $duplicado = Estado::estadoExistente($obj['estado']); 
            if($duplicado == NULL){
               $estadoOK = Estado::insertar($obj['estado']);
               if($estadoOK){
                $clase->respuesta = "El estado se ingreso correctamente" ;
               }   
                else{
                    $clase->respuesta= "Hubo un error. Intente de nuevo";
                }
            }
            else{
                $clase->respuesta="El estado ya se encuentra registrado en el sistema, intente con otro";            
            } 
        }                   
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function bajaEstado ($request,$response){
        $obj = $request->getParsedBody();
        $clase = new stdclass();
        $existe = (Estado::idEstado($obj['id'])[0]['Id']);
        if($existe != NULL){
            $eliminado = Estado::eliminar($obj['id']);
            if($eliminado){
                $clase->respuesta = "El estado se elimino correctamente" ;
            }
            else {
                $clase->respuesta = "El estado no se pudo eliminar, intentelo de nuevo" ;
            }
        }else {
            $clase->respuesta = "No existe ese estado, intentelo de nuevo" ;
        }
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }
    
    public function modifEstado ($request,$response){
        $obj = $request->getParsedBody();
        $clase = new stdclass();
         $existe = Estado::idEstado($obj['id']);        
        if($existe != NULL){
            $modificado = Estado::modificacion($obj['id'],$obj['nombre']);
            if($modificado){
                $clase->respuesta = "El estado se modifico correctamente" ;
            }
            else {
                $clase->respuesta = "El estado no se pudo modificar, intentelo de nuevo" ;
            }
        }else {
            $clase->respuesta = "No existe ese estado, intentelo de nuevo" ;
        }
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }
    

}


?>
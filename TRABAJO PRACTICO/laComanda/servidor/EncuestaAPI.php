<?php
include("laComanda/clases/Encuesta.php");
include("laComanda/clases/IApiEncuesta.php");
class EncuestaAPI extends Encuesta implements IApiEncuesta
{
       
	  
	 function __construct()
	 {
	 }
      
     public function insertarEncuesta($request, $response){
         $token = $request->getHeader('token')[0]; 
            $clase = new stdclass();            
            $usuario = (Usuario::traeId (AutentificadorJWT::ObtenerData($token))[0][0]);
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $fecha = date("d/m/Y");
            $idPedido = (Pedido::pedidoIdFecha($fecha,$usuario)[0]['id']);                               
            if($idPedido != NULL){
                $obj=$request->getParsedBody();
                $hayEncuesta = Encuesta::EncuestaPorIdPedido($idPedido);
                if($hayEncuesta == NULL){
                    $cantMaxima =  strlen( $obj['comentario']) ;                
                    if($cantMaxima < 67){
                        $encuesta = new Encuesta($idPedido,$obj['resto'],$obj['cocinero'],$obj['mozo'],$obj['comentario']); 
                        if(Encuesta::insertar($encuesta)) {
                            $clase->respuesta="La calificacion fue ingresada exitosamente";
                        }
                        else{
                            $clase->respuesta="La calificacion no se pudo ingresar, intentelo de nuevo";
                        }
                        
                    }
                    else{
                        $clase->respuesta="La cantidad maxima es de 66 caracteres para un comentario, por favor realice un comentario breve";
                    }  
                    
                }
                else{
                    $clase->respuesta="La calificacion ya ha sido registrada";
                } 
            }else {
                $clase->respuesta="Debe ingresar realizar un pedido antes de ingresar una encuesta";
            }
            
            $newResponse=$response->withJson($clase, 401);
            return $newResponse;
     }
      
     public function bajaEncuesta($request, $response){
        $token = $request->getHeader('token')[0]; 
        $clase = new stdclass();
        $newResponse = "";
        $usuario = (Usuario::traeId (AutentificadorJWT::ObtenerData($token))[0][0]);        
        $idPedido = ((Pedido::PedidoIdPorCliente($usuario))[0]['id']);
        $hayEncuesta = Encuesta::EncuestaPorIdPedido($idPedido);
        if($hayEncuesta != NULL){
            $encuestaEliminada = Encuesta::eliminar($idPedido);
            if($encuestaEliminada){
                $clase->respuesta="Se Elimino la calificacion exitosamente";
            }
        }else {
            $clase->respuesta="No existe una calificacion con ese pedido";
        }

        $newResponse=$response->withJson($clase, 401);
        return $newResponse;

     }
     
     public function modifEncuesta($request, $response){
        $token = $request->getHeader('token')[0]; 
        $clase = new stdclass();
        $newResponse = "";
        $clase->respuesta= "";
        $usuario = (Usuario::traeId(AutentificadorJWT::ObtenerData($token))[0][0]);        
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date("d/m/Y");
        $idPedido = (Pedido::pedidoIdFecha($fecha,$usuario)[0]['id']);
         $obj=$request->getParsedBody();
           if($idPedido != NULL){            
            $hayEncuesta = Encuesta::EncuestaPorIdPedido($idPedido);            
            $e = new Encuesta ($idPedido,$obj['resto'],$obj['cocinero'],$obj['mozo'],$obj['comentario']);                       
            if($hayEncuesta != NULL){               
                $encuestaModificada = Encuesta::modificacion($e) ;
                if($encuestaModificada){
                $clase->respuesta= "Se modifico la calificacion exitosamente"; 
                }
                else{
                    $clase->respuesta= "No se pudo modificar la calificacion, intentelo de nuevo";
                }
            }else {
                    $encuestaInsertada = Encuesta::insertar($e);                   
                    if($encuestaInsertada){
                        $clase->respuesta = "Se inserto la calificacion exitosamente";  
                    }
                    else {
                        $clase->respuesta = "No se pudo insertar la calificacion, intentelo de nuevo";
                    }
            }
        }else {
            $clase->respuesta = "No existe el pedido para realizar la calificacion, ingrese otro por favor";            
        }     
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
     }
    
	  
}



?>
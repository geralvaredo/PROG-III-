<?php

require_once "AutentificadorJWT.php";
require_once "Usuario.php";
require "Horarios.php" ;
class MiddlewareAPI
{
    public function VerificarUsuario($request, $response, $next) {         
		$clase = new stdclass();
		$clase->respuesta="";
        $esValido = false ;		
		$newResponse = "";
		$token = $request->getHeader('token')[0];
			
		try 
		{			
			AutentificadorJWT::verificarToken($token);
			$esValido=true;      
		}
		catch (ExpiredException $e){ 
			$clase->excepcion=$e->getMessage();
		}
		if($esValido){
			$newResponse = $next($request, $response);
		}    
		else{			
			$clase->respuesta="Solo usuarios registrados";			
			$newResponse = $response->withJson($clase, 501);  
		}  
				  
		 return $newResponse;
    }

    public function VerificarPerfilUsuario($request, $response, $next){        
        $clase= new stdclass();
        $clase->respuesta="";
        $newResponse = "" ;        
        $token = $request->getHeader('token')[0];       
        $nombreUsuario=AutentificadorJWT::ObtenerData($token);
        $unUsuario= (Usuario::traeUsuario($nombreUsuario)[0]['IdPuesto']);        
        $_REQUEST['perfil'] = "";        
        switch ($unUsuario) {
            case 1:
                $_REQUEST['perfil'] = "golondrina" ;                
                break;
            case 2:
                $_REQUEST['perfil'] = "bartender" ;                
                break;
            case 3:
                $_REQUEST['perfil'] = "cervecero" ;                
                break;
            case 4:
                $_REQUEST['perfil'] = "cocinero" ;                
                break;
            case 5:
                $_REQUEST['perfil'] = "mozo" ;               
                break;
            case 6:
                $_REQUEST['perfil'] = "socio" ;                
                break;
            case 7:
                $_REQUEST['perfil'] = "cliente" ;                
                break;                        
            default:
                $_REQUEST['perfil'] = "otro" ;                
                break;
                      
        } 
        $newResponse=$next($request,$response);
        return $newResponse;
    }    

    public function loginUsuario($request, $response,$next){
       
        $std = new stdClass();
        $email = "" ;        
        $idEmpleado = "" ;
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date("d/m/Y");
        $hora = date("H:i:s"); 
        $ingreso = "" ;
        $egreso = "" ;        
        $newResponse = "";
       // $obj->ruta = $request->getAttribute('route')->getName();
        try{            
            $obj=$request->getParsedBody();
            $usu = Usuario::traeUsuario($obj["email"]);
            //print_r($usu);
            if($usu != NULL){
                $idEmpleado = (Usuario::traeId($usu[0][0])[0][0]);                        
                $horario = Horarios::traerHorarioPorIdEmpleado($idEmpleado,$fecha);                               
                if($horario == NULL){
                        $ingreso = $hora ;                        
                        $hor = new Horarios($idEmpleado,$fecha,$ingreso,$egreso);
                        Horarios::insertarHorario($hor);                                            
                    }else {
                         if($horario[0][2] != null && $horario[0][3] == null){
                            $egreso = $hora ;                            
                            $hor = new Horarios($idEmpleado,$fecha,$ingreso,$egreso);
                            Horarios::ActualizarEgreso($hor);
                         }else {
                            $std->excepcion = "Error , El usuario ya se egreso" ;
                           return  $newResponse = $response->withJson($std, 401);
                        }
                    }
                                        
                   return $newResponse = $next($request, $response);
                
            }
        }
        catch (Exception $e){        
            
        }

         
    }
}
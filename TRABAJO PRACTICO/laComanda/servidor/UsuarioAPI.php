<?php
include("laComanda/clases/Usuario.php");
include("laComanda/clases/IApiUsuario.php");


class UsuarioAPI extends Usuario implements IApiUsuario,iExport{

    function __construct()
    {
    }

    public function insertarUsuario($request, $response){
        
        $clase = new stdclass();
        $clase->respuesta = "";
        $newResponse = "";       
        $obj = $request->getParsedBody();
        $duplicado = Usuario::traeUsuario($obj["email"]);
        if($duplicado == NULL){   
            
            $p = new Usuario($obj['email'],$obj['clave'],$obj['nombre'],$obj['apellido'],$obj['puesto']);                      
            $personaOK = Usuario::insertar($p); 
            if($personaOK){
                $clase->respuesta = "El usuario $p->email se ingreso correctamente" ;
            }else{
                $clase->respuesta= "Hubo un error. Intente de nuevo";
            }
        }
        else{
            $clase->respuesta="El usuario ya se encuentra registrado en el sistema";
            $newResponse= $response->withJson($clase, 401);
        }            
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function bajaUsuario ($request,$response){
        $obj = $request->getParsedBody();
        $clase = new stdclass();
        $clase->respuesta = "";
        $perfil = $_REQUEST['perfil'] ; 
        if($perfil != "socio"){
            $clase->respuesta = "no posee permisos para eliminar un usuario" ;
             
         }else {
             $id = $obj['id'] ;
            $usuario = Usuario::traeIdPass($id);
            if($usuario != NULL){                
               $usuarioBorrado = Usuario::borrarUsuario($id);
               if($usuarioBorrado){
                   $clase->respuesta = "El usuario ha sido borrado exitosamente" ;
               } else {
                   $clase->respuesta = "El usuario no se ha podido borrar, inténtelo nuevamente" ;
               } 
            }else {
               $clase->respuesta = "El usuario no existe, inténtelo con otro usuario" ;
            }
         }
         
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function modifUsuario($request, $response){
        $clase = new stdclass();
        $obj = $request->getParsedBody();
        $token = $obj['token'];        
        $nombreUsuario = AutentificadorJWT::ObtenerData($token);        
        $idP = (Usuario::traeUsuario($nombreUsuario)[0]['IdPuesto']);
        $id = (Usuario::traeId($nombreUsuario)[0]['id']);        
        $u = new Usuario($obj['email'],$obj['clave'],$obj['nombre'],$obj['apellido'],$idP);
        $modificado = Usuario::modificacion($u,$id);
        if($modificado){
            $clase->respuesta = "El usuario ha sido modificados exitosamente" ;
        }
        else {
            $clase->respuesta = "El usuario no ha sido modificado, intentelo de nuevo" ;
        }

        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }
    
    public function tokenUsuario($request, $response){
        $clase = new stdclass();
        $clase->respuesta="";
        $output = $response;
        $obj=$request->getParsedBody();
        $usu = usuario::traeUsuario($obj["email"]);
        if($usu!=NULL){
            $unUsuario = new Usuario($usu[0][0],$usu[0][1],$usu[0][2],$usu[0][3],$usu[0][4]);
            //var_dump($unUsuario);
            if ($unUsuario != NULL){
                if ($obj["clave"] == $unUsuario->clave) {
                    $token = AutentificadorJWT::CrearToken($unUsuario->email);
                    $_REQUEST['token'] = $token ;
                    $output = $token;
                }
                else {
                    $clase->respuesta="La clave es incorrecta";
                    $output=$response->withJson($clase, 401);
                }
            }
        }
        else {
            $clase->respuesta="El nombre no se encontro, Ingrese nuevamente";
            $output=$response->withJson($clase, 401);
        }
        
        return $output;
    }

    public function listadoClientes($request, $response){
        $personas = Usuario::clienteHorarios();
        $newResponse = $response->withJson($personas,200);
        return $newResponse;
    }

    public function listarEmpleados($request, $response){
        $personas = Usuario::listadoEmpleados();
        $newResponse = $response->withJson($personas,200);
        return $newResponse;
    }

    public function exportPDF($request, $response){
        $horarios = Horarios::horariosVista();
        $pdf = myPDF::exportarExcel($request,$response,$horarios,'horarios');
        $newResponse = $response->withJson($$pdf,200);
        return $newResponse;
    }
    public function exportExcel($request, $response){
        $horarios = Horarios::horariosVista();
        $pdf = myPDF::exportarExcel($request,$response,$horarios,'horarios');
        $newResponse = $response->withJson($pdf,200);
        return $newResponse;
    }
}


?>
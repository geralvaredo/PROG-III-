<?php
include("laComanda/clases/Pedido.php");
include("laComanda/clases/IApiPedido.php");
include("laComanda/clases/Iexport.php");
include("laComanda/clases/PDF.php");
class PedidoAPI extends Pedido implements IApiPedido,iExport{

    function __construct(){
    }

    
    public function pedidosIdEmpleado($request,$response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $clase->lista = "" ;
        $listado = "" ;
        $perfil = $_REQUEST['perfil'] ; 
        // var_dump($perfil);
         if($perfil == "socio"){
            $listado =  Pedido::traerPedidoSocio();
             
         }
         else{
                $token = $request->getHeader('token')[0];
                $emailEmpleado = AutentificadorJWT::ObtenerData($token);              
                $empleado = Usuario::traeId($emailEmpleado);        
                $idEmpleado = $empleado[0][0];
                $pedido = Pedido::traerPedidoEmpleado($idEmpleado);
                if($pedido != NULL){
                    $listado = $pedido ;
                }
                else {
                    $clase->respuesta = "No tiene pedidos asignados";
                }
         }         
         $output = $response->withJson($clase, 401) ;
        return $output; 
    }

    public function asignarEmpleado ($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $obj = $request->getParsedBody();
        
        $perfil = $_REQUEST['perfil'];
        if($perfil != "socio"  && $perfil != "mozo" ){
            $clase->respuesta =  "no tiene permisos para asignar un empleado al pedido" ;
        }else {
                $empleado = $obj['empleado'] ;
                $pedido = $obj['pedido'] ;
                $producto = $obj['producto'] ;
                $existePedido = Pedido::traePedidoExistente($pedido);        
                if($existePedido != NULL){
                    $pedidoAsignado = PedidoPuesto::existeAsignacionProd($pedido,$empleado,$producto);					
                    if($pedidoAsignado == NULL){
                        $prodPedido = Pedido::tieneProducto($pedido,$producto);							
                            if($prodPedido != NULL){                
                            $empleadoOK = PedidoPuesto::asignacion($pedido,$empleado,$producto) ;
                            if($empleadoOK){
                                $clase->respuesta = "se asigno el empleado al pedido";
                            }
                            else{
                                $clase->respuesta =  "no se asigno el empleado correctamente, intentelo de nuevo" ;
                            }
                        }else {
                            $clase->respuesta =  "El pedido no posee ese producto" ;
                        }
                    }else {
                        $clase->respuesta =  "ya esta asignado el pedido al empleado con ese producto" ;
                    }
                    
                }else {
                    $clase->respuesta =  "no existe el pedido , intentelo de nuevo" ;
                }
        } 
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function reasignarEmpleado($request, $response){
        $obj = $request->getParsedBody();
        $clase = new stdclass();
        $perfil = $_REQUEST['perfil'] ; 
        if($perfil != "socio"){
            $clase->respuesta = "no posee permisos para eliminar un usuario" ;
             
         }else {
                $pedido =  $obj['pedido'] ;
                $empleado = $obj['empleado'] ;
                $producto = $obj['producto'] ;
                $existe = PedidoPuesto::existeAsignacionProd($pedido,$empleado,$producto) ; 
                if($existe == NULL){
                    $modificado = PedidoPuesto::reasignar($pedido,$empleado,$producto) ;
                    if($modificado){
                        $clase->respuesta = "se modifico la asignacion al pedido exitosamente";
                    }
                    else {
                        $clase->respuesta = "No se pudo modificar la asignacion, intentelo de nuevo";
                    }            
                }
                else{
                    $clase->respuesta = "El pedido ya estaba asignado con ese empleado, intente con otro" ;
                }
         }         
        
        $newResponse = $response->withJson($clase, 401);
        return $newResponse;
    }

    public function bajaAsignacion($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $obj = $request->getParsedBody();
        $empleado = $obj['empleado'] ;
        $pedido = $obj['pedido'];
        $existe = PedidoPuesto::existeAsignacion($pedido,$empleado) ;
        if($existe != NULL){
            $eliminado = PedidoPuesto::eliminarAsignacion($pedido,$empleado) ;
            if($eliminado){
                $clase->respuesta = "se elimino la asignacion al pedido exitosamente";
            }
            else {
                $clase->respuesta = "No se ha podido eliminar la asignacion al pedido, intentelo de nuevo";
            }            
        }
        else{
            $clase->respuesta =  "No existe ninguna asignacion de empleado con ese pedido, intentelo de nuevo" ;
        }
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function cambioPedido($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $obj = $request->getParsedBody();        
        $pedido = $obj['pedido'];               
        $estado = $obj['estado'];
        $producto = $obj['producto'] ;
        $pedidoOK = "";
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $hora = date("H:i:s");
            if($estado == 2){
               $pedidoOK = Pedido::pedidoEnPreparacion($hora,$estado,$pedido,$producto);
            }
            if($estado == 3){
                $horaFin = Pedido::traerEstimacion($pedido);
                if($horaFin != NULL){
                    $pedidoOK = Pedido::pedidoParaServir($hora,$estado,$pedido,$producto);
                }
                else {
                    $clase->respuesta = "Debe estimar cuanto tardara el pedido antes de servirlo" ;
                }
                
            }   
            
        if($pedidoOK){
            $clase->respuesta = "Se actualizo el pedido correctamente" ;
        }
        else{
            $clase->respuesta = "Hubo un error. Intente de nuevo" ;
        } 
        $newResponse=$response->withJson($clase, 401);
            return $newResponse;
    }
    
    public function estimacion($request, $response){
            $obj = $request->getParsedBody();   
            $pedido = $obj['pedido'];   
            $tiempo = $obj['tiempo'];
            $producto = $obj['producto'] ;
            $clase = new stdclass();
            $clase->respuesta = "";
            $pedidoOK = Pedido::EstadoPedEstimacion($pedido,$tiempo,$producto);
            if($pedidoOK){
               $clase->respuesta = "se actualizo la estimacion de la preparacion"; 
            }
            else{
                $clase->respuesta = "no se pudo estimar la preparacion, intentelo de nuevo"; 
            }
            $newResponse=$response->withJson($clase, 401);
            return $newResponse;
    }

    public function horaPedido($request, $response){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $obj = $request->getParsedBody(); 
        $id = $obj['id'] ;
        $prod = $obj['producto'] ;
        $hora = date('H:i:s');
        $clase = new stdclass();
        $clase->respuesta = "";
        $pedidoOK = Pedido::actualizarHora($id,$hora,$prod); 
        if($pedidoOK){
            $clase->respuesta = "se actualizo la fecha del pedido";  
        }
        else {
            $clase->respuesta = "no se pudo actualizo la fecha del pedido"; 
        }

        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function cancelarPedido($request, $response){
        $obj = $request->getParsedBody();
        $clase = new stdclass();
        $idPedido = $obj['pedido'];
        $estado = $obj['estado'] ;
        $existe = Pedido::traePedidoExistente($idPedido);        
        if($existe != null){
            switch ($estado) {
                case 7:
                        $pedidoCerrado = Pedido::cerrar($idPedido,$estado);
                        if($pedidoCerrado){
                            $clase->respuesta = "El pedido ya fue cerrado exitosamente" ;
                        }else {
                            $clase->respuesta = "El pedido no se pudo cerrar, intentelo de nuevo" ;
                        }                        
                    break;
                case 8:
                        $cancelarOk = Pedido::cerrar($idPedido,$estado);
                        if($cancelarOk){
                            $clase->respuesta = "El pedido fue cancelado exitosamente" ;
                            }else {
                            $clase->respuesta = "No se ha podido cancelar el pedido, intentelo de nuevo" ;
                            }
                    break;
                default:
                    # code...
                    break;
            }
            
            
        }else {
            $clase->respuesta = "No existe el pedido ingresado, intentelo de nuevo" ;
        }       
        
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function insertarPedido($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $newResponse = "";       
        $obj = $request->getParsedBody();
        $token = $request->getHeader('token')[0];
        $emailCliente = AutentificadorJWT::ObtenerData($token);              
        $idCliente = (Usuario::traeId($emailCliente)[0][0]);  
        //$mesa = new Mesa(null,$idCliente,null) ;     
        $mesaOK = Mesa::mesaPorIdCliente($idCliente);        
        if($mesaOK != null){
            foreach ($obj as $pedido) {
               $pedidoOK = $this->armarPedido($idCliente,$pedido['producto'],$pedido['cantidad']); 
            }             
            if($pedidoOK){
                    $clase->respuesta = "El pedido se ingreso correctamente" ;
                    
            }else{
                    $clase->respuesta= "Hubo un error. Intente de nuevo";
                }
        }else{
                $clase->respuesta= "Debe Solicitar una mesa antes de realizar un pedido";
         }
       
            $newResponse=$response->withJson($clase, 401);
            return $newResponse;
    }

    public function enviarFoto($request,$response){
       $clase = new stdclass();
        $clase->respuesta = "";
        $obj = $request->getParsedBody();
        $id = $obj['id'] ;         
        $descRepetida = (Foto::traerFoto($id));        
        $ruta = 'laComanda/clases/fotos/' ;  
        $archivo = "" ;      
        if($descRepetida == NULL || !$descRepetida ){            
            
            $archivo = $ruta . $_FILES['foto']['name'] ;
            move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);
            $foto = PedidoAPI::marcaDeAgua($archivo,$_FILES['foto']['name']);
            unlink($archivo) ; 
            $f = new Foto ($id , $foto) ;            
            $fotoOK = Foto::insertarFoto($f) ;            
            if($fotoOK){
                $clase->respuesta = "la Foto fue asociada correctamente";
            }
            else{
                $clase->respuesta= "Hubo un error al subir la foto, intentelo mas tarde";
            }
        }
        else{
            $clase->respuesta= "el pedido ya tiene una foto asociada";
        }
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;   
    } 

    public function modificarFoto($request,$response){
        $clase = new stdclass() ;
        $clase->respuesta = "" ;
        $obj = $request->getParsedBody();
        $id = $obj['id'] ; 
        $descRepetida = (Foto::traerFoto($id));        
        $ruta = 'laComanda/clases/fotos/' ;
        $archivo = "";
        if($descRepetida != NULL || !$descRepetida){           
            $archivo = $ruta . $_FILES['foto']['name'] ;
            move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);
            $foto = PedidoAPI::marcaDeAgua($archivo,$_FILES['foto']['name']);
            unlink($archivo) ; 
            $f = new Foto ($id,$foto); 
            $archivoViejo = $ruta . $descRepetida->descripcion ;
            unlink($archivoViejo);           
            if(Foto::actualizarFoto($f)){
                $clase->respuesta= "se actualizo la foto del pedido correctamente"; 
            };
        }
        else{
            $clase->respuesta= "Error, ingrese el id del pedido correctamente"; 
        }

        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function bajaFoto($request,$response){
        $clase = new stdclass() ;
        $clase->respuesta = "" ;
        $obj = $request->getParsedBody();
        $id = $obj['id'] ; 
        $descRepetida = (Foto::traerFoto($id));
        if($descRepetida != NULL || !$descRepetida){
            if(Foto::borrarFoto($id)){
                $clase->respuesta = "la foto fue borrada exitosamente" ;
            }
            else{
                $clase->respuesta = "no se pudo borrar la foto , intentelo de nuevo" ;
            }
        }else{
            $clase->respuesta = "no existe la foto con ese id" ;
        }

        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function bajaPedido($request, $response){       
        $clase = new stdclass();
        $perfil = $_REQUEST['perfil'] ;
        $obj = $request->getParsedBody(); 
        if($perfil != "socio"){
            $clase->respuesta = "no posee permisos para eliminar un usuario" ;
             
         }else {
                 $token = $request->getHeader('token')[0];
                date_default_timezone_set("America/Argentina/Buenos_Aires");
                $fecha = date("d/m/Y");                      
                $emailEmpleado = AutentificadorJWT::ObtenerData($token);        
                $idEmpleado = (Usuario::traeId($emailEmpleado)[0][0]);             
                $idPedido = $obj['pedido'] ;
                $existe = Pedido::traePedidoExistente($idPedido);                                
                if($existe == NULL){
                    $clase->respuesta = "El cliente no tiene ningun pedido o ya fue borrado recientemente" ; 
                }else{
                        $pedidoEliminado = Pedido::eliminarPedidos($idPedido);
                        if($pedidoEliminado){
                        $clase->respuesta = "El pedido ha sido borrado exitosamente" ;             
                        }else {
                        $clase->respuesta = "El pedido no ha podido ser borrado, inténtelo de nuevo" ;
                        }
                    }
         }
        
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
    }

    public function modifPedido($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $newResponse = "";
        $pedidoOK = "";       
        $obj = $request->getParsedBody();
        $token = $request->getHeader('token')[0];
        $emailCliente = AutentificadorJWT::ObtenerData($token);
        $idCliente = (Usuario::traeId($emailCliente)[0][0]);        
        foreach ($obj as $pedido) {
                $existe = Pedido::traePedidoExistente($pedido['pedido']) ;                
                if($existe != NULL){
                    $pedidoOK = $this->modificarPedido($idCliente,$pedido['pedido'],$pedido['producto'],$pedido['productoId'],$pedido['cantidad']) ;
                    if($pedidoOK){
                        $clase->respuesta = "El pedido se modifico correctamente" ;
                    }else{
                        $clase->respuesta = "El pedido no existe o ya fue borrado, intentelo de nuevo";
                    } 
                }else {
                    $clase->respuesta= "El pedido no existe o ya fue borrado, intentelo de nuevo";   
                }           
            }  
            $newResponse=$response->withJson($clase, 401);
            return $newResponse;
    }

    public function listaPedidos($request, $response){              
           $pedidos = Pedido::v_listaPedidos();
           Tabla::mostrarTablaPedido($pedidos);             
    }

    public function exportPDF($request, $response){
        $pedidos = Pedido::v_listaPedidos();
        $pdf = myPDF::exportarPDF($request,$response,$pedidos,'pedidos');
        $newResponse = $response->withJson($pdf,200);
        return $newResponse;
    }

    public function exportExcel($request, $response){
        $pedidos = Pedido::v_listaPedidos();
        $pdf = myPDF::exportarExcel($request,$response,$pedidos,'pedidos');
        $newResponse = $response->withJson($pdf,200);
        return $newResponse;
    }

    public function listaPedidoPorSectorEmpleado($request, $response){
        $obj = $request->getParsedBody();
        $puesto = $obj['puesto'] ;
        $fecha = $obj['fecha'] ;
        $personas = Pedido::operacionSectorEmpleado($puesto,$fecha);
        $newResponse = $response->withJson($personas,200);
        return $newResponse;
    }

    public function listaPedidoPorEmpleado($request, $response){
        $personas = Pedido::operacionEmpleado();
        $newResponse = $response->withJson($personas,200);
        return $newResponse;
    }

    public function listaPedidoPorSector($request, $response){
        $obj = $request->getParsedBody();
        $sector = $obj['sector'] ;
        $personas = Pedido::operacionSector($sector);
        $newResponse = $response->withJson($personas,200);
        return $newResponse;
    }

    public function listaPedidoMasVendido($request, $response){
        $pedido = (Pedido::pedidosMasVendidos());        
        $pedidoMax = array(); 
        //var_dump($pedido);
        foreach ($pedido as $ped) {            
            $pedidoMax[] = (Producto::pedidoIdDescripcion($ped['productoId'])[0]['descripcion']);            
        }
        $clase = new stdclass();
            if(sizeof($pedidoMax) > 0 ){
                $clase->respuesta = "Lo que mas se vendio es " ;
            foreach ($pedidoMax as $ped) {
               $clase->respuesta .= $ped .  ", " ;
            }
            $rest = substr($clase->respuesta,0,-2);
            $clase->respuesta = $rest ;
        }    
        $newResponse = $response->withJson($clase,200);
        return $newResponse;       
        
    }

    public function listaPedidoMenosVendido($request, $response){
        $pedido = (Pedido::pedidoMenosVendido());
         $pedidoMin = array(); 
        foreach ($pedido as $ped) {            
            $pedidoMin[] = (Producto::pedidoIdDescripcion($ped['productoId'])[0]['descripcion']);
           } 
       
        $clase = new stdclass();
            if(sizeof($pedidoMin) > 0 ){
                $clase->respuesta = "Lo que menos se vendio es " ;
            foreach ($pedidoMin as $ped) {
               $clase->respuesta .= $ped .  "," ;
            }
            $rest = substr($clase->respuesta,0,-1);
            $clase->respuesta = $rest ;
        }    
        $newResponse = $response->withJson($clase,200);
        return $newResponse;
    }

    public function entregasDemoradas($request,$response){
        $clase = new stdclass();
        $pedidoHora = Pedido::pedidosHoras();
        $pedidosDemorados = array ();
        $totalMinutos = array ();
        $pedidos[] = "" ;
        $i = 0;        
        foreach ($pedidoHora as $ped){
            if($ped['horaFin'] = NULL || $ped['horaFin'] = 0) {
                continue;
            }else{
                    $horaInicio = new DateTime($ped['horaInicio']) ;
                    $horaTermino = new DateTime( $ped['horaFin']) ;
                    $intervalo  = $horaInicio->diff($horaTermino);
                    $totalMinutos [] = ($intervalo->d * 24 * 60) + ($intervalo->h * 60) + $intervalo->i;            
                    if($totalMinutos[$i] > $ped['tiempo'] ){
                        $pedidosDemorados[] = $ped['id'];
                 }
                    $i = $i + 1;
            } 
        }
        foreach($pedidosDemorados as $ped){
           $pedidos[] = (Pedido::traerPedidoPorId($ped)[0]);
        } 
        //var_dump($pedidos) ;      
         $clase->titulo = "Los Pedidos Demorados" ;
         if($pedidos != null){
            $clase->respuesta =  $pedidos;
         }
         else{
            $clase->respuesta = "No hubo pedidos Demorados" ;
         }
         
        $newResponse = $response->withJson($clase,200);
        return $newResponse;
    }

    public function cancelaciones($request,$response){
        $pedidosCancelados = Pedido::pedidosCancelados();
        $newResponse = $response->withJson($pedidosCancelados,200);
        return $newResponse;
    }

    public function armarPedido($cliente,$prod,$cant){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date("d/m/Y");
        $horaInicio = date("H:i:s");
        $existePedido = Pedido::pedidoIdFecha($fecha,$cliente);
        $idPedido = "";
        if($existePedido != NULL){
            $idPedido = $existePedido[0][0];
        }
        else{
            $pedido = Pedido::traerUltimoPedido();
            $ultimoPedido = $pedido->id ;
            $numero = substr($ultimoPedido,4);            
            $numero = $numero + 1 ;            
            $numeroConCeros = str_pad($numero, 2, "0", STR_PAD_LEFT);
            $idPedido = 'CM-'. $numeroConCeros  ;    
        } 
        $estado = 1 ;		
        $p = new Pedido($fecha,$idPedido,$cliente,$estado,$horaInicio,$prod,$cant);                
        $pedidoOK = Pedido::insertarPed($p);
        return $pedidoOK;
    }
    
    public function modificarPedido($idCliente,$idPedido,$producto,$prodModif,$cantidad){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date("d/m/Y");
        $horaInicio = date("h:i:s");            
        $existePedido = (Pedido::pedidoIdFecha($fecha,$idCliente));           
        $estado = (Pedido::traeEstado($idPedido,$producto)[0]['estado']);        
        $pedidoOK = "" ;
        if($existePedido != NULL){            
            $p = new Pedido($fecha,$idPedido,$idCliente,$estado,$horaInicio,$producto,$cantidad);
            //var_dump($p);
            $pedidoOK = Pedido::modificar($p,$prodModif);           
        } 
        else {
           $pedidoOK = false ;
        }
        return $pedidoOK;
    }

    public function marcaDeAgua($original,$nombre){
        $im = imagecreatefromjpeg($original);
        // Primero crearemos nuestra imagen de la estampa manualmente desde GD
        $marca_agua = imagecreatefrompng("laComanda/clases/fotos/insig.png");
        
        // Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
        $margen_dcho = 10;
        $margen_inf = 10;
        $sx = imagesx($marca_agua);
        $sy = imagesy($marca_agua);

        // Fusionar la estampa con nuestra foto con una opacidad del 50%
        imagecopymerge($im, $marca_agua, 0, imagesy($im) - $sy, 0, 0, $sx, $sy, 80); 

        
        $archivo = basename($nombre, ".jpg");
        $archivo .=  '.png' ;  
        $ruta = 'laComanda/clases/fotos/';     
        if(!file_exists($ruta)){
            mkdir($ruta,0777);
        }
        
         $imagen = $ruta . $archivo ;    
        
        
        imagepng($im, $imagen); 
        imagedestroy($im);
        return $archivo ;
    }

    

    
}


?>
<?php
include("clases/Mesa.php");
include("clases/IApiMesa.php");
class MesaAPI extends Mesa implements IApiMesa
{
	/*public $id;
 	public $idCliente;*/
	  
	 function __construct()
	 {
	 }
      
     public function solicitudMesa($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $newResponse = "";       
        $token = $request->getHeader('token')[0];        
        $idMesa = $request->getHeader('id')[0];
        //var_dump($idMesa);        
        $disponible = (Mesa::consultaMesa($idMesa)[0]['idCliente']);
        
        if($disponible == 0){            
            $emailCliente = AutentificadorJWT::ObtenerData($token);              
            $cliente = Usuario::traeId($emailCliente);        
            $idCliente = $cliente[0][0];
            $mesa = new Mesa ($idMesa,$idCliente,4);
            $mesaOK = Mesa::solicitud($mesa);

            if($mesaOK){
                $clase->respuesta = "la mesa fue solicitada exitosamente"; 
            }
            else{
                $clase->respuesta = "Hubo un error , intentelo mas tarde";    
            }
        }else{
            $clase->respuesta = "La mesa solicitada se encuentra ocupada, elija otra";
        }
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
     }
	  
      public function estado($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $obj = $request->getParsedBody();        
        $estado = $obj['estado'] ;
        $idMesa = $obj['id'] ;         
        $facturacion = "";
        $cambioMesaOK =  Mesa::actualizarMesa($estado,$idMesa);
        switch ($estado) {
            
            case 5:
                $clase->respuesta = "El estado de la mesa se actualizo";
                break;
           case 6:
                    $idCliente = (Mesa::consultaMesa($idMesa)[0]['idCliente']);                
                    $idPedido = (Pedido::traerPedidoPorIdCliente($idCliente)[0]['id']);                
                    $pedidoPrecios = Pedido::pedidoPrecio($idPedido);
                    $pedidoFacturado = 0;
                    date_default_timezone_set("America/Argentina/Buenos_Aires"); 
                    $fecha = date("H:i:s");
                    $existeFactura = Factura::existe($idPedido,$fecha);
                    if($existeFactura == NULL){
                            for($i = 0 ; $i< count($pedidoPrecios);$i++){
                                $pedidoFacturado = $pedidoFacturado + $pedidoPrecios[$i]['factura'] ;                      
                            } 
                        $fac = new Factura ($idPedido,$fecha,$idMesa,$pedidoFacturado);
                        $facturacion = Factura::insertar($fac);
                        if($facturacion){
                            $clase->respuesta = "El estado de la mesa se actualizo y se facturo correctamente" ;
                        }else{
                            $clase->respuesta = "El estado de la mesa se actualizo pero no pudo se facturar , intentelo de nuevo" ; 
                        }
                    }else{
                             $clase->respuesta = "ya existe una factura con ese pedido";    
                        }
                    break; 
            case 7:    
                    $clase->respuesta = "La mesa fue cerrada exitosamente";           
                    break;
            default:
                # code...
                break;
        }       
        
       /* $newResponse=$response->withJson($clase, 401);
        return $newResponse;*/
     }

     public function mesaNueva($request,$response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $obj = $request->getParsedBody();
        $id = $obj['id'] ;
        $estado = 0 ;
        $idC = 0 ;
        $mesa = new Mesa($id,$idC,$estado) ;
        $mesaNuevaOK = Mesa::insertarMesa($mesa);
        if($mesaNuevaOK){
            $clase->respuesta = "nueva mesa : $id insertada";
        }
        else {
            $clase->respuesta = "Error, inserte de nuevo la mesa";
        }
     }
      
     public function bajaMesa($request,$response){
        $clase = new stdclass();
        $obj = $request->getParsedBody();
        var_dump($obj['mesa']);
        $existeMesa = Mesa::mesaExistente($obj['mesa']);        
        if($existeMesa){
            $mesaBorrada = Mesa::eliminar($obj['mesa']);
            if($mesaBorrada){
                $clase->respuesta = "La mesa ha sido borrada exitosamente" ;
            }else {
                $clase->respuesta = "La mesa no se ha podido borrar, inténtelo nuevamente" ;
            }
        }
        else {
            $clase->respuesta = "La mesa no existe, inténtelo nuevamente" ;
        }
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
     
     }

     public function modifMesa($request,$response){
        $clase = new stdclass();
        $obj = $request->getParsedBody();
        //var_dump($obj['mesa']);
        $existeMesa = Mesa::mesaExistente($obj['mesa']);
        if($existeMesa){
            $mesaModf = Mesa::modificar($obj['mesa'],$obj['modMesa']);
            if($mesaModf){
                $clase->respuesta = "La mesa ha sido modificada exitosamente" ;
            }else {
                $clase->respuesta = "La mesa no se ha podido modificar, inténtelo nuevamente" ;
            }
        }
        else {
            $clase->respuesta = "La mesa no existe, inténtelo nuevamente" ;
        }
        $newResponse=$response->withJson($clase, 401);
        return $newResponse;
     }

     public function mesaMasUsada($request,$response){
        $mesa = Factura::mesaMas();
        $mesaMas = array();        
        foreach ($mesa as $m) {
            $mesaMas[] = ($m['mesa']);            
        }
        $clase = new stdclass();
        if(sizeof($mesaMas) > 0 ){
            $clase->respuesta = "La mesa mas usada es " ;
        foreach ($mesaMas as $m) {
           $clase->respuesta .= $m .  ", " ;
        }
        $rest = substr($clase->respuesta,0,-2);
        $clase->respuesta = $rest ;
        }    
        $newResponse = $response->withJson($clase,200);
        return $newResponse;       
     }

     public function mesaMenosUsada($request,$response){
        $mesa = Factura::mesaMenos();
        $mesaMenos = array();        
        foreach ($mesa as $m) {
            $mesaMenos[] = ($m['mesa']);            
        }
        $clase = new stdclass();
        if(sizeof($mesaMenos) > 0 ){
            $clase->respuesta = "La mesa menos usada es " ;
        foreach ($mesaMenos as $m) {
           $clase->respuesta .= $m .  ", " ;
        }
        $rest = substr($clase->respuesta,0,-2);
        $clase->respuesta = $rest ;
        }    
        $newResponse = $response->withJson($clase,200);
        return $newResponse;
     }

     public function mesaConMayorFactura($request,$response){
        $factura = Factura::mesaFacturaMayor();
        $clase = new stdclass();
        $clase->titulo = "Mesa Con Mayor Importe"  ;  
        $clase->respuesta = $factura;
        $newResponse = $response->withJson($clase,200);
        return $newResponse;
     }

     public function mesaConMenorFactura($request,$response){
        $factura = Factura::mesaFacturaMenor(); 
        $clase = new stdclass();
        $clase->titulo = "Mesa Con Menor Importe"  ;  
        $clase->respuesta = $factura;
        $newResponse = $response->withJson($clase,200);
        return $newResponse;
    }

    public function mesaMasFact($request,$response){
        $factura = Factura::mesaAgrupadas();
        $importes = array();
        $numeroMayor = 0 ; 
        $facturaMayor =  array();        
        foreach ($factura as $f) {            
            $importes[] = $f['Importe'];            
        }
        
        for($i = 0 ; $i < count($importes);$i++){
            if($importes[$i] > $numeroMayor){
                $numeroMayor = $importes[$i];
            }
        }

        $i = 0;
        foreach ($factura as $f) {
           if($numeroMayor == $factura[$i]['Importe']){
            $facturaMayor = $factura[$i] ;
           }
           $i = $i + 1 ;
        }
         
        $clase->titulo = "Mesa Mas Facturada"  ;  
        $clase->respuesta = $facturaMayor;
        $newResponse = $response->withJson($clase,200);
        return $newResponse;
       
        
    }

    public function mesaMenosFact($request,$response){
        $factura = Factura::mesaAgrupadas();
        $importes = array();        
        $numeroMenor = 0;
        $numeroMayor = 0 ;
        $facturaMenor = array();
        
        
        foreach ($factura as $f) {            
            $importes[] = $f['Importe'];            
        }
        
        for($i = 0 ; $i < count($importes);$i++){
            if($importes[$i] > $numeroMayor){
                $numeroMayor = $importes[$i];
            }
        }
         $numeroMenor = $numeroMayor ;
        for($i = 0 ; $i < count($importes);$i++){
            if($importes[$i] < $numeroMenor){
                $numeroMenor = $importes[$i];
            }
        }

        $i = 0;
        foreach ($factura as $f) {
           if($numeroMenor == $factura[$i]['Importe']){
            $facturaMenor = $factura[$i] ;
           }
           $i = $i + 1 ;
        }

        $clase->titulo = "Mesa Menos Facturada"  ;  
        $clase->respuesta = $facturaMenor;
        $newResponse = $response->withJson($clase,200);
        return $newResponse;

    }

    public function facturacionMesa($request,$response){
        $clase = new stdclass();
        $obj = $request->getParsedBody();
        $fechaInit = $obj['inicio'];
        $fechaFin = $obj['fin'] ;
        $mesa = $obj['mesa'] ;
        $factura = Factura::facturacion($mesa,$fechaInit,$fechaFin);
        $clase->titulo = "Facturada la mesa: " . $mesa .  "  entre " . $fechaInit . " y " . $fechaFin ;
        $clase->respuesta = $factura;
        $newResponse = $response->withJson($clase,200);
        return $newResponse;

    }

    public function bajaFactura($request,$response){
        $clase = new stdclass();
        $obj = $request->getParsedBody();
        $codigo = $obj['pedido'];
         $facturaEliminada = Factura::eliminar($codigo);
         if($facturaEliminada){
            $clase->respuesta = "la Factura ha sido eliminada" ;
         }
         else {
            $clase->respuesta = "Error , Intentelo de nuevo" ;
         }
    }

    
}

?>
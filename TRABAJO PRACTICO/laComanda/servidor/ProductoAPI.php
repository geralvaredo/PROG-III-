<?php
include("laComanda/clases/Producto.php");
include("laComanda/clases/IApiProducto.php");

class ProductoAPI extends Producto implements IApiProducto
{
    function __construct()
    {
    }
  
    public function insertarProd($request,$response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $newResponse = "";       
        $obj = $request->getParsedBody();
        $duplicado = Producto::traeProductoPorNombre($obj["descripcion"]);
        if($duplicado == NULL){
            $ultimoProd = Producto::traerUltimoProducto();            
            $idUltimo = $ultimoProd[0][0] + 1;
            //var_dump($idUltimo);
            $prod = new Producto($idUltimo,$obj['descripcion'],$obj['precio']);
            $productoOK = Producto::insertar($prod);            
            if($productoOK){
                $clase->respuesta = "El producto $prod->descripcion se ingreso correctamente" ;                
            }else{
                $clase->respuesta= "Hubo un error. Intente de nuevo";                
            }

        }
        else{
            $clase->respuesta="El producto ya se encuentra registrado en el sistema";
        }     
      return $newResponse= $response->withJson($clase, 401);
    }
    public function bajaProducto($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $newResponse = "";       
        $obj = $request->getParsedBody();
        $existeProducto = (Producto::existeProducto($obj['id'])[0]['codigo']);        
        if($existeProducto != NULL){
            
            $prodEliminado = Producto::borrarProducto($obj['id']);
            if($prodEliminado){
                $clase->respuesta = "El producto ha sido eliminado exitosamente" ;
            }
            else {
                $clase->respuesta = "El producto no se ha podido eliminar, intentelo de nuevo" ;
            }
        }
        else {
            $clase->respuesta = "El producto no existe , intentelo de nuevo" ;
        }

        return $newResponse= $response->withJson($clase, 401);
    }
    
    public function modifProducto($request, $response){
        $clase = new stdclass();
        $clase->respuesta = "";
        $newResponse = "";       
        $obj = $request->getParsedBody();
        $codigo = Producto::ProductoPorId($obj['id']);
        if($codigo != NULL){
            $p = new Producto($obj['id'],$obj['descripcion'],$obj['precio']);
            $prodModificado = Producto::modificacion($p);
            if($prodModificado){
                $clase->respuesta = "El producto ha sido modificado exitosamente" ;
            }
            else {
                $clase->respuesta = "El producto no se ha podido modificar, intentelo de nuevo" ;
            }
        }
        else {
            $clase->respuesta = "El producto no existe , intentelo de nuevo" ;
        }

        return $newResponse= $response->withJson($clase, 401);
    }
}
?>
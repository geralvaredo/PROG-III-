<?php 
class PedidoPuesto  
{
    public $idPedido ;
    public $idEmpleado ;

    function __construct($idPed,$idU){
        $this->idPedido = $idPed ;
        $this->idEmpleado = $idU ;
    }
     
    public static function existeAsignacion($pedido,$empleado){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT idPedido FROM pedido_puesto where idPedido = '$pedido' AND idEmpleado = '$empleado'");
         $consulta->execute();
        return  $consulta->fetchAll();	
    }
    
    public static function existeAsignacionProd($pedido,$empleado,$prod){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT idPedido FROM pedido_puesto where idPedido = '$pedido' AND idEmpleado = '$empleado' AND idProducto = '$prod'");
        $consulta->execute();
        return  $consulta->fetchAll();	
    }
    
	  public static function asignacion($pedido,$empleado,$producto){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO pedido_puesto (idPedido,idEmpleado,idProducto) values('$pedido','$empleado','$producto')");
		return $consulta->execute();	
	  }

      public static function reasignar($pedido,$empleado){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido_puesto SET idEmpleado = '$empleado' WHERE idPedido = '$pedido'");
		return $consulta->execute();	
      }
      
      public static function eliminarAsignacion($pedido,$empleado){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM pedido_puesto WHERE idPedido = '$pedido' AND idEmpleado = '$empleado'");
		return $consulta->execute();	
      }    
}

?>
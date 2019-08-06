<?php
class Pedido
{
	public $fecha ;
	public $id;
	public $idCliente ;
	public $estado;	
	public $tiempoEstimado ;
	public $horaInicio ;
	public $productoId ;
	public $cantidad ;

	
	function __construct($fec,$idPedido,$idC,$est,$tiempo,$prod,$cant) {
			$this->fecha = $fec;
			$this->id = $idPedido ;
			$this->idCliente = $idC ;
			$this->estado = $est ;
			$this->horaInicio = $tiempo ; 
			$this->productoId = $prod ;
			$this->cantidad = $cant ;	
  }

  public static function actualizarHora($id,$hora,$prodId) {
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE pedido set horaInicio = '$hora' where id = '$id' and productoId = '$prodId'");
	return $consulta->execute();			
		
}  

	public static function pedidosHoras() {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id ,horaInicio,horaFin, tiempo FROM pedido");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);		
	}
	
  public static function traerPedidoEmpleado($idP) {
	   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	   $consulta =$objetoAccesoDato->RetornarConsulta("SELECT prod.descripcion 
		 from producto prod , pedido p, pedido_puesto pp 
	   where p.producto = prod.codigo AND
					p.id = pp.idPedido and
					pp.idEmpleado = '$idP'");
			   $consulta->execute();			
			   return $consulta->fetchAll();	
	  }

		public static function operacionSectorEmpleado($idP,$fec) {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta(
				"SELECT ped.fecha, u.nombre , u.apellido , p.descripcion 
				from usuario u , producto p , pedido ped , pedido_puesto pedp
				where u.IdPuesto = '$idP' AND
				pedp.idEmpleado = U.id  AND
				pedp.idPedido = ped.id AND
				ped.productoId = p.codigo AND
				ped.fecha = '$fec'");
				$consulta->execute();			
				return $consulta->fetchAll(PDO::FETCH_ASSOC);	
    }
  	  
	  
	 public static function operacionSector($idP) {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta(
				"SELECT ped.fecha, u.nombre , u.apellido , p.descripcion 
				from usuario u , producto p , pedido ped , pedido_puesto pedp
				where u.IdPuesto = '$idP' AND
				pedp.idEmpleado = U.id  AND
				pedp.idPedido = ped.id AND
				ped.productoId = p.codigo");
				$consulta->execute();			
				return $consulta->fetchAll(PDO::FETCH_ASSOC);	
	 }
	 
	 public static function pedidosMasVendidos() {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta(
				"SELECT productoId , count(productoId) AS PEDIDO_MAS_VENDIDO 
				from pedido p 
				group by productoId 
				having count(productoId)=(
				Select max(A.CNT) 
				from (Select count(productoId) as CNT 
				from pedido group by (productoId)) as A)");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);	
	}

	public static function pedidoMenosVendido() {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta(
				"SELECT productoId , count(productoId) AS PEDIDO_MAS_VENDIDO 
				from pedido p 
				group by productoId 
				having count(productoId)=(
				Select min(A.CNT) 
				from (Select count(productoId) as CNT 
				from pedido group by (productoId)) as A)");
				$consulta->execute();			
				return $consulta->fetchAll(PDO::FETCH_ASSOC);	
	}

	public static function operacionEmpleado() {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from pedido_asignado");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);	
  }
	
	public static function traerPedidoPorId($ped) {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT ped.id, ped.fecha, p.descripcion  from pedido ped, producto p where id ='$ped' and ped.productoId = p.codigo ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);		
	}

  public static function traerPedidoPorIdCliente($idC){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select id, estado, tiempo,productoId,cantidad from pedido where `idCliente` ='$idC'");
			  $consulta->execute();			
			  return $consulta->fetchAll(PDO::FETCH_ASSOC);		
	}
	
	public static function tieneProducto($ped,$idProd) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT productoId from pedido where id = '$ped' AND productoId ='$idProd'");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function traeEstado($idP,$idProd){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT estado from pedido where `id` ='$idP' AND `productoId` = '$idProd'");
			$consulta->execute();			
			return $consulta->fetchAll();
	}	

	public static function traePedidoExistente($idP){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select id from pedido where `id` ='$idP'");
		$consulta->execute();			
		return $consulta->fetchAll();
	}

	public static function PedidoIdPorCliente($idC){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id from pedido where idCliente ='$idC'");
		$consulta->execute();			
		return $consulta->fetchAll();
	}
	
	public static function pedidoIdFecha($fec,$idC) {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id from pedido where idCliente ='$idC' and fecha = '$fec'");
			$consulta->execute();			
			return $consulta->fetchAll();
	}
		
	public static function traerUltimoPedido() {
			 $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			 $consulta =$objetoAccesoDato->RetornarConsulta("SELECT MAX(id) AS id FROM pedido");
			 $consulta->execute();			  			
			 return $consulta->fetchObject();	
	}

	public static function insertarPed($obj){
        $response = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedido (fecha,id,idCliente,estado,horaInicio,productoId,cantidad)values('$obj->fecha','$obj->id','$obj->idCliente','$obj->estado', '$obj->horaInicio' ,'$obj->productoId','$obj->cantidad')");
        if($consulta->execute()){
            $response = true;
        }  		  
       	return $response ;    
	}

	public static function cancelar($ped){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido set estado = 8 where id = '$ped'");
		return $consulta->execute();
	}

	public static function pedidoPrecio($ped){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT ped.fecha ,ped.id , (p.precio * ped.cantidad) as factura
		from pedido ped , producto p
		where ped.id = '$ped' AND
		p.codigo = ped.productoId");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public static function EstadoPedEstimacion($pedido,$tiempo,$prod){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido set  tiempo = '$tiempo' where id = '$pedido' and productoId = '$prod'");
			return $consulta->execute();
	}

	 public static function pedidoEnPreparacion($hora,$est,$ped,$prod){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido set horaInicio = '$hora' , estado = $est where id = '$ped' and productoId = '$prod'");
		return $consulta->execute();
	}

	public static function pedidoParaServir($hora,$estado,$pedido,$prod){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido set estado = '$estado' , horaFin = '$hora' where id = '$pedido' and productoId = '$prod'");
			return $consulta->execute();
	}

	public static function pedidosCancelados(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT ped.id, ped.fecha, p.descripcion  from pedido ped, producto p where  ped.estado = 8  and ped.productoId = p.codigo ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function eliminarPedidos($idPed){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from pedido WHERE id= '$idPed'");	
			if($consulta->execute())
				return true ;
			else	
				return false ;
	}

	public static function modificar($p,$prodModif){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido set fecha = '$p->fecha', horaInicio = '$p->horaInicio' , estado = '$p->estado' , productoId = '$prodModif' , cantidad = '$p->cantidad' where productoId = '$p->productoId'");
		return $consulta->execute();
	}

	public static function v_listaPedidos(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT p.fecha AS fecha, p.id AS nroPedido,concat(u.nombre,' ',u.apellido) AS Cliente,
			e.Nombre AS Estado, pr.descripcion AS Pedido
			 from (((pedido p join usuario u) join estado e) 
			 join producto pr)
			 where p.idCliente = u.id and p.estado = e.Id and p.productoId = pr.codigo");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);	
	}

}



?>
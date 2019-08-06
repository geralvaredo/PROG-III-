<?php
class Factura
{
	public $codFactura;
 	public $codPedido;
  	public $fecha;
	public $mesa ;
	public $total;

	function __construct($ped,$fec,$mes,$t){
		$this->codPedido = $ped ;
		$this->fecha = $fec ;
		$this->mesa = $mes ;
		$this->total = $t;
	}
	  
	public static function pedidosFacturados(){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("SELECT codigoFactura as codigo,codigoPedido as pedido, fecha , total from factura");
			  $consulta->execute();			
			  return $consulta->fetchAll(PDO::FETCH_CLASS, "factura");		
	}

	public static function pedidosFacturadosPorId($ped){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT codigoFactura as codigo,codigoPedido as pedido, fecha , total from factura where codigoPedido = '$ped'");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "factura");		
	}

	public static function insertar($fac){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO factura (codigoPedido,mesa,fecha,total) values ('$fac->codPedido','$fac->mesa','$fac->fecha','$fac->total')");	
		if($consulta->execute())
			return true ;
		else	
			return false ;
	}

	public static function eliminar($ped){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from factura WHERE codigoPedido= '$ped'");	
		if($consulta->execute())
			return true ;
		else	
			return false ;
	}
	

	public static function mesaMas(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
					$consulta =$objetoAccesoDato->RetornarConsulta(
					"SELECT mesa , count(mesa) AS MESA_MAS_USADA 
					from factura p 
					group by mesa 
					having count(mesa)=(
					Select max(A.CNT) 
					from (Select count(mesa) as CNT 
					from factura group by (mesa)) as A)");
			$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);			
	}	

	public static function mesaMenos(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta(
				"SELECT mesa , count(mesa) AS MESA_MENOS_USADA
				 from factura p 
				 group by mesa
				 having count(mesa)=
				 ( Select min(A.CNT) 
				 from (Select count(mesa) as CNT 
				 from factura group by (mesa)) as A)");
				$consulta->execute();			
				return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function mesaFacturaMayor(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT mesa, max( total) as Importe from factura ");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);			
	}

	public static function mesaFacturaMenor(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT mesa, min( total) as Importe from factura ");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);			
	}

	public static function mesaConMayorFact(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT mesa, max(suma) sumaTotal from (select mesa ,sum(total) AS suma from factura group by mesa) as Resultado
		");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function mesaAgrupadas(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT mesa, sum(total) as Importe from factura GROUP by mesa");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
		
	}

	public static function facturacion($m,$fechaInicio,$fechaFin){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT sum(total) as TotalFacturado  FROM factura WHERE mesa = '$m'  AND fecha  BETWEEN '$fechaInicio' and '$fechaFin'");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function existe($idP,$fec){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT codigoPedido  FROM factura WHERE codigoPedido = '$idP' AND fecha = '$fec'");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}

}



?>
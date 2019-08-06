<?php
class Mesa
{
	public $id;
 	public $idCliente;
	public $estado ;  

	function __construct($idM,$idC,$est){
		 $this->id = $idM ;
		 $this->idCliente = $idC ;
		 $this->estado = $est ;
	 }
  	
	public static function consultaMesa($idMesa){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select idCliente from mesa where Id ='$idMesa'");
			  $consulta->execute();			
			  return $consulta->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function solicitud($mesa){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE mesa set idCliente = '$mesa->idCliente', estado = '$mesa->estado' where Id = '$mesa->id'");
			return $consulta->execute();		 
	}

	public static function mesaPorIdCliente($idC){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select Id,idCliente,estado from mesa where IdCliente ='$idC'");
			$consulta->execute();		
			return $consulta->fetchObject();
	}

	public static function actualizarMesa($est,$idM){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE mesa set estado = '$est'  where Id = '$idM'");
			return $consulta->execute();		 
	}
		
	public static function modificar($mesa,$valor){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE mesa set Id = '$valor'  where Id = '$mesa'");
			return $consulta->execute();
	}

	public static function insertarMesa($mesa){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO  mesa (Id,IdCliente,estado) values ('$mesa->id','$mesa->idCliente','$mesa->estado')");
			return $consulta->execute();		 
	}
		
	public static function mesaExistente($m){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select Id FROM mesa where Id = '$m'");
			$consulta->execute();
			return $consulta->fetchObject();				 
	}

	public static function eliminar($mesa){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM mesa where Id = '$mesa'");
			return $consulta->execute();		 
	}

	

	
}



?>
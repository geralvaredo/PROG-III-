<?php
class Foto
{
	public $idPedido ;
	public $descripcion;
	
	function __construct($idP,$des) {
		$this->idPedido = $idP;
		$this->descripcion = $des ;
				
  }

  	public static function traerFoto($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT descripcion  FROM foto WHERE idPedido ='$id'");
		$consulta->execute();			
		return $consulta->fetchObject();		
	}

	public static function insertarFoto($f) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO foto (idPedido,descripcion) values('$f->idPedido','$f->descripcion')");
		return $consulta->execute();			
			
	}
	
    public static function borrarFoto($idP) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM foto where idPedido = '$idP'") ;
		return$consulta->execute();			
		 
	}

	public static function actualizarFoto($f) {
	    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE foto set descripcion =  '$f->descripcion' where idPedido = '$f->idPedido'");
		return $consulta->execute();			
		 
    }
  	  
}



?>
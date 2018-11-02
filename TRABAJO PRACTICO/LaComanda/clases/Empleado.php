<?php
include("clases/AccesoDatos.php");
class Empleado
{
	public $id;
 	public $nombre;
  	public $idPuesto;
  	
	  public static function traerEmpleados(){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select Id,Nombre as nombre, IdPuesto as puesto from empleado");
			  $consulta->execute();			
			  return $consulta->fetchAll(PDO::FETCH_CLASS, "empleado");		
	  }

	  public static function listarPorId($id){		  	  	
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select Id,Nombre as nombre, IdPuesto as puesto from empleado WHERE Id= $id");
			  $consulta->execute();
			  return $empleadoBuscado = $consulta->fetch(); 
			   	  		
	  }
	  public static function borrarPorId($id){ 
			 $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			 $consulta =$objetoAccesoDato->RetornarConsulta("
				 delete 
				 from empleado 				
				 WHERE Id= $id");	
				 $consulta->execute();
				 return $empleadoBorrado = $consulta->rowCount();
	  }
	  public static function insertar($obj){
		  		 $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				 $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (Nombre,IdPuesto)values('$obj->nombre',$obj->IdPuesto)");
				 $consulta->execute();
				 return $consulta->fetch(); 
 } 
 
 	  public static function modificar($obj){
		/*	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update empleado 
				set Nombre='$obj->nombre',
				IdPuesto = '$obj->IdPuesto',
				WHERE Id='$obj->id'");
			 $consulta->execute();
			return $consulta->fetch();*/
}
	  
/*
  	public function BorrarUsuario()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE Id=:id");	
				$consulta->bindValue(':id',$this->Id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

}*//*
	 	public static function BorrarUsuarioPorAnio($año)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from cds 				
				WHERE jahr=:anio");	
				$consulta->bindValue(':anio',$año, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }*/
	 /*
	public function ModificarUsuario()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set Nombre='$this->Nombre',
				 Clave = '$this->Clave',
				WHERE Id='$this->Id'");
			return $consulta->execute();

}*//*
	 public function ModificarUsuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set Id= :id,
				Nombre=: nombre,
				Clave=: clave
				WHERE Id=:id");
			$consulta->bindValue(':id',$this->Id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->Nombre, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $this->Clave, PDO::PARAM_STR);
			
			return $consulta->execute();
	 }*/
/*
  	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->Id."  ".$this->Nombre ."  ". $this->Clave;
}*//*
	 public function InsertarElCd()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (Nombre,Clave)values('$this->Nombre','$this->Clave)");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

}*/
/*
	 public function InsertarElCdParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (Nombre,Clave)values(:nombre,:clave)");
				$consulta->bindValue(':nombre',$this->titulo, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $this->año, PDO::PARAM_STR);
				
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 */
	  	
/*
	public static function TraerUnCd($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, titel as titulo, interpret as cantante,jahr as año from cds where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
			return $cdBuscado;				

			
	}*/
/*
	public static function TraerUnCdAnio($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=? AND jahr=?");
			$consulta->execute(array($id, $anio));
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}
*//*
	public static function TraerUnCdAnioParamNombre($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}
	*//*
	public static function TraerUnCdAnioParamNombreArray($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			$consulta->execute(array(':id'=> $id,':anio'=> $anio));
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}*/



}



?>
<?php
class Puesto
{
	public $id;
	 public $nombre;
	 
	 function __construct($nom){
		 $this->nombre = $nom ;
	 }
      
  	  	
	  public static function traerPuestos(){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select Id,Nombre  from puesto");
			  $consulta->execute();			
			  return $consulta->fetchAll(PDO::FETCH_CLASS, "puesto");		
	  }

	  public static function traerIdPuesto($nombrePuesto)
	  {
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select Id from puesto where Nombre = '$nombrePuesto'");
			  $consulta->execute();			
			  return $consulta->fetchAll();		
	  }

	  public static function IdPuesto($iidd)
	  {
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select Id from puesto where Id = '$iidd'");
			  $consulta->execute();			
			  return $consulta->fetchAll();		
	  }

	  public static function insertar($obj){
		$response = false;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT into puesto (Nombre)values('$obj->nombre')");
		if($consulta->execute()){
		$response = true;
		}  		  
		 return $response ;
  }

  	public static function eliminar($iD){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from puesto WHERE Id = '$iD'");	
		if($consulta->execute())
				return true ;
			else	
				return false ;		 
	  }

	  public static function modificar($iD,$nom){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE puesto SET Nombre = '$nom' where Id = '$iD'");	
		if($consulta->execute())
				return true ;
			else	
				return false ;		 
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

	 }*/
	 	/*public static function BorrarUsuarioPorAnio($año)
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
				

}*//*
	 public function InsertarElCdParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (Nombre,Clave)values(:nombre,:clave)");
				$consulta->bindValue(':nombre',$this->titulo, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $this->año, PDO::PARAM_STR);
				
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }*/
	 
 	
/*
	public static function TraerUnCd($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, titel as titulo, interpret as cantante,jahr as año from cds where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
			return $cdBuscado;				

			
	}
*//*
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
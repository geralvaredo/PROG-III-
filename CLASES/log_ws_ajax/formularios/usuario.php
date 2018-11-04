<?php
class Usuario
{
	public $id;
	public $nombre;
	public $email;
	public $password;
	public  $tipo;
	

	public static function TraerTodos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
		$sql = "SELECT id, Nombre, Email, Password,Tipo
				FROM usuarios";

		$consulta = $objetoAccesoDato->RetornarConsulta($sql);
		$consulta->execute();

		//return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");

		
		return $consulta->fetchall(PDO::FETCH_BOTH);
		
	}
	 public function InsertarElCd()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cds (titel,interpret,jahr)values('$this->titel','$this->interpret','$this->jahr')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }


	   	public static  function BorrarCd($titulo)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from cds 				
				WHERE titel=:titel");	
				$consulta->bindValue(':titel',$titulo, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	   	

}
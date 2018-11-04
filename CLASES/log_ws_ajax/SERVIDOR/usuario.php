<?php
class Usuario
{
	public $id;
	public $nombre;
	public $email;
	public $password;
	public $tipo;
	public $foto;

	public function __construct($id,$nombre,$email,$password,$tipo,$foto)
	{
		$this->id=$id;
		$this->nombre = $nombre;
		$this->email = $email;
		$this->password =$password;
		$this->tipo = $tipo;
		$this->foto = $foto;
	}

	public static function TraerTodos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
		$sql = "SELECT id, Nombre, Email, Password,Tipo,Foto
				FROM usuarios";

		$consulta = $objetoAccesoDato->RetornarConsulta($sql);
		$consulta->execute();

		//return $consulta->fetchall(PDO::FETCH_CLASS, "Usuario");
		return $consulta->fetchall(PDO::FETCH_BOTH);

		
	}
	 public function InsertarUsuario()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (Nombre,Email,Password,Tipo,Foto)values('$this->nombre','$this->email','$this->password','$this->tipo','$this->foto')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }


	   	public static  function BajaUsuario($id)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuarios 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	   	
	public static function TraerUnUsuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, Nombre as nombre, Email as email,Password as password,Tipo as tipo from usuarios where id = 3");
			$consulta->execute();
			return $consulta->fetchall(PDO::FETCH_BOTH);
			
		}

		public function ModificarCd()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set Nombre='$this->nombre',
				Email='$this->email',
				Password='$this->password',
				Tipo='$this->tipo',
				Foto='$this->foto'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }

	 public static function ModificarFoto($array)
	 {
	 	$id= $array[0];
	 	$foto=$array[1];
	 	
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set Foto='$foto'
				WHERE id='$id'");
			return $consulta->execute();

	 }

	 public static function SubirFoto($foto)
	{
	
		$archivoTmp = date("Ymd_His") . ".jpg";
		$destino = "tmp/" . $archivoTmp;
		$PATCH = $_SERVER['DOCUMENT_ROOT'];
		return $foto["archivo"]["tmp_name"];
        return move_uploaded_file($foto["archivo"]["tmp_name"],$PATCH."/"."hola.jpg");


        
		if (!move_uploaded_file($_FILES["archivo"]["tmp_name"],"/tmp/$archivoTmp")) {

	
			$retorno= "Ocurrio un error al subir el archivo. No pudo guardarse.";
			return $retorno;
		}
		else{
			$retorno = "Archivo subido exitosamente!!!"; 
			return $retorno;
		}
	}
	

}
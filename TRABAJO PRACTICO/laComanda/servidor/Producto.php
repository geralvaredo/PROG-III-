<?php
class Producto
{
	public $codigo;
 	public $descripcion;
	public $precio;
	

	function __construct($cod,$des,$pre)
    {
		$this->codigo = $cod ;
		$this->descripcion = $des ;
		$this->precio = $pre ;
    }
  	
	  public static function traerProductoPorId($des){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select codigo from producto where descripcion = '$des'");
			  $consulta->execute();			
			  return $consulta->fetchObject();		
	  }

		public static function ProductoPorId($cod){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select codigo from producto where codigo = '$cod'");
			  $consulta->execute();			
			  return $consulta->fetchObject();		
		}

		public static function pedidoIdDescripcion($idProducto) {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta(
				"SELECT descripcion 
				from producto 
				WHERE codigo = '$idProducto'");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);	
	 }
		
		public static function existeProducto($des){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select codigo from producto where codigo = '$des'");
			  $consulta->execute();			
			  return $consulta->fetchAll(PDO::FETCH_ASSOC);			
	  }

		public function borrarProducto($id){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from producto WHERE codigo= '$id'");	
					if($consulta->execute())
						return true ;
					else	
						return false ;
		 }
	  
	  public static function traeProductoPorNombre($nombre)
	  {
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select codigo,descripcion, precio from producto where descripcion = '$nombre'");
			  $consulta->execute();			
			  return $consulta->fetchAll();		
	  }

	  public static function insertar($obj){
        $response = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
          $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo,descripcion,precio)values('$obj->codigo','$obj->descripcion','$obj->precio')");
        if($consulta->execute()){
            $response = true;
        }  		  
       return $response ;    
	}
	
	public static function traerUltimoProducto(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select MAX(codigo) from producto");
		$consulta->execute();			
		return $consulta->fetchAll();
	}

	public static function modificacion($obj) {		  	  	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE producto set  descripcion = '$obj->descripcion', precio = '$obj->precio' where codigo = '$obj->codigo'");
		return $consulta->execute(); 
}

}



?>
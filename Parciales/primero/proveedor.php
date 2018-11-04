<?php
class Proveedor
{

	private $id;
 	private $nombre;
  	private $email;
  	private $foto;

	public function getId()
	{
		return $this->id;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function getFoto()
	{
		return $this->foto;
	}
	public function getEmail()
	{
		return $this->email;
	}

	public function setId($valor)
	{
		$this->id = $valor;
	}
	public function setNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function setFoto($valor)
	{
		$this->Foto = $valor;
	}
	public function setEmail($valor)
	{
		$this->email = $valor;
	}


	public function __construct($id=NULL, $nombre=NULL, $pathFoto=NULL, $email = NULL)
	{
		if($id !== NULL && $nombre !== NULL){
			$this->id = $id;
			$this->nombre = $nombre;
			$this->foto = $pathFoto;
			$this->email = $email;
		}
	}


  	public function toString()
	{
	  	return $this->id." - ".$this->nombre." - ".$this->foto ." - ". $this->email."\r\n";
	}

	public static function guardar($obj)
	{
		$resultado = FALSE;
		
	
		$ar = fopen("proveedores.txt", "a");
		
		
		$cant = fwrite($ar, $obj->toString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		fclose($ar);
		
		return $resultado;
	}

	public static function modificar($obj){
		$resultado = TRUE;
		$id = 0;
		$listaDeProveedores = Proveedor::traerTodosLosProveedores();
		$lista = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($listaDeProveedores); $i++){
			if($listaDeProveedores[$i]->id == $obj->id){
				$imagenParaBorrar = trim($listaDeProveedores[$i]->foto);
				$id = trim($listaDeProveedores[$i]->id);
				continue;
			}
			$lista[$i] = $listaDeProveedores[$i];
		}

		array_push($lista, $obj);
		$origen = "imagenes/".$imagenParaBorrar  ;
		$tipoFoto = pathinfo($imagenParaBorrar,PATHINFO_EXTENSION);		
		$destino = "backUpFotos/". $id . "-" . date("Y-m-d") . "." . $tipoFoto ;
		copy($origen,$destino);
		 
		unlink("imagenes/".$imagenParaBorrar);
		
		
		$ar = fopen("proveedores.txt", "w");
		
		
		foreach($lista AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		
		fclose($ar);
		
		return $resultado;
	}
/*
	public static function eliminar($cod)
	{
		if($codBarra === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeProductosLeidos = Producto::TraerTodosLosProductos();
		$ListaDeProductos = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeProductosLeidos); $i++){
			if($ListaDeProductosLeidos[$i]->codBarra == $codBarra){//encontre el borrado, lo excluyo
				$imagenParaBorrar = trim($ListaDeProductosLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeProductos[$i] = $ListaDeProductosLeidos[$i];
		}

		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/productos.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeProductos AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
	*/
	public static function traerTodosLosProveedores()
	{

		$ListaDeProveedoresLeidos = array();
		
		$archivo=fopen("proveedores.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$proveedor = explode(" - ", $archAux);			
			$proveedor[0] = trim($proveedor[0]);
			if($proveedor[0] != ""){
				$ListaDeProveedoresLeidos[] = new Proveedor($proveedor[0], $proveedor[1],$proveedor[2],$proveedor[3]);
			}
		}
		fclose($archivo);
		
		return $ListaDeProveedoresLeidos;
		
	}
	public static function validarNombre($nombre)
	{
		$mensaje = "";
		$cantidad = 0;		
		/*$obj[] = array();	*/
		$ListaDeProveedoresLeidos = Proveedor::traerTodosLosProveedores();	
		for($i=0; $i<count($ListaDeProveedoresLeidos); $i++){
			if($ListaDeProveedoresLeidos[$i]->nombre == $nombre){
				$cantidad++;				
				$mensaje = "Se encontraron: " . $cantidad . " Coincidencias" ;
				/*$obj[] = $ListaDeProveedoresLeidos[$i] ;*/
			}
			else{
				$mensaje = "No existe el proveedor : " . $nombre;
			}
			
		}	
		/*print_r($obj);*/
		return $mensaje;
		
	}
	
	
	public static function validarId($id)
	{		
		$valida = false ;	
		$ListaDeProveedoresLeidos = Proveedor::traerTodosLosProveedores();	
		for($i=0; $i<count($ListaDeProveedoresLeidos); $i++){
			if($ListaDeProveedoresLeidos[$i]->id == $id){				
				$valida = true ;
				break ;
			}
			else{
				$valida = false ;				
			}
			
		}	
		
		return $valida;
		
	}	
	
	public static function guardarFoto($temporal,$archivo,$nombre){
		
		$tipoFoto = pathinfo($archivo,PATHINFO_EXTENSION);
		$nuevaFoto = $nombre . "." .  $tipoFoto ;
		$destino = "imagenes/" . $nuevaFoto ; 
		move_uploaded_file($temporal,$destino);
		return $nuevaFoto;

	} 

	public static function listarTabla(){
		$ListaDeProveedoresLeidos = Proveedor::traerTodosLosProveedores();
		$cadena = "<table>";
		$cabecera = "<thead> 
					<tr>
					<td>  ID </td> 
					<td>  NOMBRE </td>
					<td>  EMAIL </td>
					<td>  FOTO </td>
					</tr>
					</thead>" ;
			$cuerpo = "<tbody>"	;	
		for($i = 0;$i< count($ListaDeProveedoresLeidos);$i++){
			$cuerpo .= 
		"<tr>
		<td>". $ListaDeProveedoresLeidos[$i]->id ."</td> 
		<td>" .$ListaDeProveedoresLeidos[$i]->nombre  ."</td>
		<td>" .$ListaDeProveedoresLeidos[$i]->email    . "</td>
		<td><img src='imagenes/" . $ListaDeProveedoresLeidos[$i]->foto   . "' width='100px' height='100px' /></td>
		</tr>" ;
		}			
		$cuerpo .= "</tbody>"; 

		$cadena .= $cabecera . $cuerpo . "</table>" ; 

		return $cadena ;
	}
	
}
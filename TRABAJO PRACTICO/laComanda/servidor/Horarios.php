<?php
class Horarios
{
	public $IdEmpleado;
 	public $fecha;
	public $ingreso;
	public $egreso;  
	  
	function __construct($id,$fec,$in,$out) {
        $this->IdEmpleado = $id;       
        $this->fecha = $fec;
        $this->ingreso = $in;
        $this->egreso = $out;        
      }

	  public static function traerHorarios(){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select IdEmpleado as empleado ,fecha , ingreso , egreso from horarios");
			  $consulta->execute();			
			  return $consulta->fetchAll(PDO::FETCH_CLASS, "horarios");		
	  }

	  public static function horariosVista(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from v_horarios");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_ASSOC);		
}


	  public static function traerHorarioPorIdEmpleado($id,$fec){
			  $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			  $consulta =$objetoAccesoDato->RetornarConsulta("select IdEmpleado, fecha , ingreso, egreso from horarios where IdEmpleado = ? AND fecha = ?");
			  $consulta->execute(array($id, $fec));			
			  return $consulta->fetchAll();
	  }

	  public static function insertarHorario($obj){
			$response = false;
        	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
          	$consulta = $objetoAccesoDato->RetornarConsulta("INSERT into horarios (IdEmpleado,fecha,ingreso,egreso)values('$obj->IdEmpleado','$obj->fecha','$obj->ingreso','$obj->egreso')");
        	if($consulta->execute()){
            $response = true;
        	}  		  
       return $response ;	
	  }  

	  public static function ActualizarEgreso($obj){
		$response = false;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		  $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE horarios set egreso = '$obj->egreso'  where IdEmpleado = '$obj->IdEmpleado'");
		if($consulta->execute()){
		$response = true;
		}  		  
   return $response ;	
  }  
}

?>
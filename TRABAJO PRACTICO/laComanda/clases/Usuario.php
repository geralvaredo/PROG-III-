<?php 
include("clases/AccesoDatos.php");
class Usuario 
{
    public $email ;
    public $clave ;
    public $nombre ;
    public $apellido ;
    public $idPuesto;

    function __construct($email,$clave,$nom,$ape,$puesto) {
        $this->email = $email;       
        $this->clave = $clave;
        $this->nombre = $nom;
        $this->apellido = $ape;
        $this->idPuesto = $puesto;
      }

    public static function traeUsuario($emailCliente){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select  `email`, `clave` , `nombre`, `apellido` , `IdPuesto` from `usuario` where `email` = '$emailCliente'");
        $consulta->execute();
        $miUsuario = $consulta->fetchAll();
        return $miUsuario;				
    }
    
    public static function traeId($emailCliente){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select `id` from `usuario` where `email` = '$emailCliente'");
        $consulta->execute();
        return $miUsuario = $consulta->fetchAll();
       				
    }
    
    public static function insertar($obj){
        $response = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
          $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (email,clave,nombre,apellido,idPuesto)values('$obj->email','$obj->clave','$obj->nombre','$obj->apellido','$obj->idPuesto')");
        if($consulta->execute()){
            $response = true;
        }  		  
       return $response ;    
    }

    public static function borrarUsuario($email,$clave){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from usuario WHERE email= '$email' AND clave = '$clave'");	
        if($consulta->execute())
            return true ;
        else	
			return false ;
	 }

     public static function modificacion($obj,$ID)  {		  	  	
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario set email = '$obj->email' , clave = '$obj->clave', nombre = '$obj->nombre', apellido = '$obj->apellido' , IdPuesto = '$obj->idPuesto' where id = '$ID'");
        return $consulta->execute(); 
}

     public static function EmpleadosHorarios(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from v_horarios");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_ASSOC);		
     }

     public static function listadoEmpleados(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from v_empleados");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
     }
   



}

?>
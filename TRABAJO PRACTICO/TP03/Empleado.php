
<?php 

/**
 * 
 */
include "Persona.php";

class Empleado extends Persona
{
    protected $_legajo;
    protected $_sueldo;

    public function getLegajo()
    {
        return $this->_legajo ;
    }
    public function getSueldo()
    {
        return $this->_sueldo;
    }

    function __construct($nombre,$apellido,$dni,$sexo,$legajo,$sueldo)
    {
         parent::__construct($nombre,$apellido,$dni,$sexo) ;
         $this->_legajo = $legajo ;
         $this->_sueldo = $sueldo;
    }

    public function Hablar($v1) 
    {
       echo "El Empleado Habla: " . $v1 ; 
    }

    public function ToString()
    {
        $cadena = parent::ToString() ;
        return $cadena .= "=>" .  $this->getLegajo() . "=>"
        . $this->getSueldo()   ;
    }

    public static function Leer()
    {
        $ListaDeEmpleado = array() ;
        $archivo = fopen("empleados.txt","r");
            while (!(feof($archivo))) 
            {
                $renglon = fgets($archivo) ; 
                $Empleado = explode("=>",$renglon);
                if($Empleado[0] != "")

                $ListaDeEmpleado [] = $Empleado ;     
            }
            fclose($archivo) ;
            return $ListaDeEmpleado;
            
    }

    public static function Guardar($emp1)
    {
        $archivo = fopen("empleados.txt","a") ;
        $renglon = "" ;
        $lista = Empleado::Leer(); 
        $guardado = false; 
        foreach ($lista as $empleado)
         {  
               if($empleado == $emp1)
              { 
                  echo "El Empleado Ya Fue Guardado" ;
                  $guardado = true ;
                  break;
               }
              
                  
        }
            if(!$guardado)
           { 
               $renglon .= "<br>" . $emp1->ToString() ;
           }
            //if(!$guardado)

           fwrite($archivo,$renglon);

        fclose($archivo);

        http://.www.youtube.com ;
    }


}



?>
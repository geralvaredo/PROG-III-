
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
        return $cadena .= "<br>" . "Legajo: " . $this->getLegajo() . "<br>"
        . "Sueldo:" . $this->getSueldo() . "<br>" . "<br>" ;
    }


}



?>

<?php 

/**
 * 
 */
 Require "Empleado.php" ;
class Fabrica 
{
    private $_empleados = array()  ;
    private $_razonSocial ;
    function __construct($razon)
    {
        $this->_razonSocial = $razon ;
        
    }

    public function AgregarEmpleado($e)
    {
        array_push($this->_empleados,$e) ;

    }
    public function CalcularSueldos()
    {
        $total = 0 ;
        foreach ($this->_empleados as  $item) {
            
            $total += $item->getSueldo() ;
        }

        return $total ;

    }

    public function EliminarEmpleado($e)
    {
        for ($i=0; $i < count($this->_empleados); $i++) { 
            
            if($this->_empleados[$i] == $e)
            {
                unset($this->_empleados[$i]);
                break;
            }
        }
            
    }

    public function EliminarEmpleadoRepetidos()
    {
       //print_r(array_unique($this->_empleados)) ;
               
            
        
      
    }


    public function ToString()
    {
        $cadena = "<br>" . "Razon Social :" . $this->_razonSocial . "<br>" ;

        foreach ($this->_empleados as $item) {
            
            $cadena .= $item->ToString() . "<br>";
        }
        return $cadena ;
    }

}



?>
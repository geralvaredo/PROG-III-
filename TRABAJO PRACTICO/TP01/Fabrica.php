
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
        $this->EliminarEmpleadoRepetidos() ;  

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

     private function EliminarEmpleadoRepetidos()
    {
         
        $this->_empleados = array_unique($this->_empleados,SORT_REGULAR) ;
    
        
      
    }


    public function ToString()
    {
        $cadena = "<br>" . "Razon Social :" . $this->_razonSocial . "<br>"  ;

        foreach ($this->_empleados as $item) {
            
            $cadena .=  "<br>" . $item->ToString() . "<br>";
        }
        return $cadena ;
    }








}



?>
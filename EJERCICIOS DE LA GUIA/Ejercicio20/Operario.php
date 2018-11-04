
<?php 


/**
 * 
 */
class Operario 
{
    private $_legajo;
    private $_nombre;
    private $_apellido ;
    private $_salario ;


    public function getLegajo()
    {
        return $this->_legajo ;
    }
    public function setLegajo($legajo)
    {
        $this->_legajo = $legajo;
    }
    public function getNombreApellido()
    {
        return $this->_nombre . " , " . $this->_apellido;
    }
    public function setNombre($nombre)
    {
        $this->_nombre = $nombre; 
    }
    
    public function setApellido($apellido)
    {
        $this->_apellido = $apellido ;
     }
    public function getSalario()
    {
        return $this->_salario;
    }
    public function setSalario($salario)
    {
        $this->_salario = $salario ;
    }
    
    public function SetAumentarSalario($s1)
     {
       $this->_salario = $this->salario * ( $s1 / 100) ;  
     }

    function __construct($legajo,$apellido,$nombre)
    {
        $this->setLegajo($legajo)  ;
        $this->setNombre($nombre) ;
        $this->setApellido($apellido) ;
         
    }

     private function Mostrar()
     {
         return "<br>" . "legajo: ". $this->getLegajo() . "<br>" . "NombreyApellido: " . $this->getNombreApellido() . "<br>"
         .  "Salario: ". $this->getSalario() . "<br>" ;
     }

     public static function mostrarOP($op1)
     {
         echo $op1->Mostrar();
     }

     public function Equals($op1,$op2)
     {
         if($op1->getNombreApellido() == $op2->getNombreApellido() && $op1->getLegajo() == $op2->getLegajo() )
         {
             return true ;
         }
         else
         {
             return false;
         }
     }

}




?>

<?php 

/**
 * 
 */
abstract class Persona 
{
    private $_apellido ;
    private $_nombre; 
    private $_dni ;
    private $_sexo ;

     public function getNombre()
     {
         return $this->_nombre;
     }   
      public function getApellido()
     {
         return $this->_apellido ;
     }
     public function getDni()
     {
         return $this->_dni ;
     }
     public function getSexo()
     {
         return $this->_sexo ;
     }


    function __construct($nombre,$apellido,$dni,$sexo )
    {
       $this->_nombre = $nombre;
       $this->_apellido = $apellido ;
       $this->_dni = $dni ;
       $this->_sexo = $sexo ;

    }

        public abstract function Hablar($v1) ;

      
       public function ToString()
       {
           return  $this->getNombre() . "=>" . $this->getApellido() . "=>" . $this->getDni() 
           . "=>" . $this->getSexo()   ;
       }








}



?>
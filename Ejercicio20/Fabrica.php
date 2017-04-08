
<?php 

    /**
     * 
     */
     require("Operario.php") ;

    class Fabrica 
    {
        private $_cantidadMax ;
        private $_operarios = array();
        private $_razonSocial ;         
        
        function __construct($razon)
        {
           $this->_razonSocial = $razon;
           $this->_cantidadMax = 5 ;
        }

        public function Add($op1)
        {
            $respuesta = "No se Agrego" ;
                
            
                if($this->_operarios != " ")

                if($this->_operarios != $op1 && count($this->_operarios) < $this->_cantidadMax )
           {  
                     $respuesta = "Se Agrego" ;
                  $this->_operarios[] = $op1 ;
           }

           return $respuesta .= " el Operario : " .   $op1->getNombreApellido() . "<br>" ." A la Fabrica: " .
          $this->_razonSocial . "<br>"  ;    
        }

            private function RetornarCostos()
            {
               $costo = 0 ;
               foreach ($_operarios as $item) {
                   
                   $costo += $item->getSalario() ;

               }

               return $costo ;
            }

             public  function MostrarOperarios()
           {
                  $cadena = "" ;
                foreach ($this->_operarios as $item) {
                    
                 $cadena .= Operario::mostrarOP($item) . "<br>" ;
               }

                return $cadena ; 
            }

  



    public static function MostrarCosto($f1)
         {
                echo $f1->RetornarCostos();
        }


    public function Remove($op1)
       {
         $respuesta = "Operario No Encontrado" ;
         $res = false ;
        for ($i=0; $i <count($this->_operarios) ; $i++)    { 
          if($this->_operarios[$i] == $p1){
                
          $respuesta = "Operario: " . $p1->getNombre() .  " Fuera de la Fabrica" ;
                $v1->_listaDePasajeros[$i] = 0 ;
                $res = true ;
                break;
            } 
        
        
        
                                                          }
                echo $respuesta ; 
                return $res ;
            
            
            
            
            }




    }
        

?>
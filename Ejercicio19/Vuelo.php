
<?php 

/**
 * 
 */
 Require ("pasajero.php") ;

class Vuelo 
{
    private $_fecha;
    private $_precio ;
    private $_empresa ;
    public $_listaDePasajeros = array(); 
    public $_cantMaxima ;

    function getFecha()
    {
        return $this->_fecha ;
    }
    function getPrecio()
    {
        return $this->_precio ;
    }
    function getEmpresa()
    {
        return $this->_empresa ;
    }
    function getListaPasajeros()
    {
        return $this->_listaDePasajeros ;
    }
    function getCantidad()
    {
        return $this->_cantMaxima ;
    }
    function __construct($empresa,$precio,$cantidad = NULL)
    {
        $this->_empresa = $empresa ;
        $this->_precio = $precio ;
        $this->_cantMaxima = $cantidad;
    }


    function infoVuelo()
    {
        $cadena = "<br>" . $this->getFecha() . "<br>" . $this->getEmpresa() .
        "<br>" . $this->getPrecio() . "<br>"  . $this->getCantidad() . "<br>" ;

        foreach ($this->_listaDePasajeros as $item) {
            $cadena .= $item->GetinfoPasajero()  ;

        }
        return $cadena ;
    }
    function AgregarPasajero($p1)
    {
           $respuesta = "No se Agrego" ;
                
            
     if($this->_listaDePasajeros != " ")

      if($this->_listaDePasajeros != $p1 && count($this->_listaDePasajeros) < $this->getCantidad() )
           {  
                     $respuesta = "Se Agrego" ;
                  $this->_listaDePasajeros[] = $p1 ;
           }            
                 
              

      return $respuesta .= " el Pasajero : " .   $p1->GetNombre() . " Al Vuelo: " .
          $this->getEmpresa() . "<br>"  ;
    }


    public static function Add ($v1,$v2)
    {
            $totalv1 = 0 ;
            $totalv2 = 0 ;
            $TotalVuelo = 0 ; 
            foreach ($v1->_listaDePasajeros as $item) {
            
            if($item->esPlus)
            $totavl += $item->getPrecio() *0.2 ;
            else
            $totalv1 += $item->getPrecio()  ;

            break;
        }

        foreach ($v2->_listaDePasajeros as $item) {
            
            if($item->esPlus)
            $totalv2 += $item->getPrecio() *0.2 ;
            else
            $totalv2 += $item->getPrecio()  ;

            break;
        }

        return $TotalVuelo = $totalv1 + $totalv2 ;


       }
       
      /*  function sumar($v1,$v2)
       {
            

    
       }
        */
        
    

    public static function Remove($p1,$v1)
    {
        $respuesta = "Pasajero No Encontrado" ;
        for ($i=0; $i <count($v1->_listaDePasajeros) ; $i++)    { 
            if($v1->_listaDePasajeros[$i] == $p1){
                
                $respuesta = "Pasajero: " . $p1->getNombre() .  " Fuera del Vuelo" ;
                $v1->_listaDePasajeros[$i] = 0 ;
                break;
            } 
        
        
        
        }
        return $respuesta ;
    
    }

}



?>
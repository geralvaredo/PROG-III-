
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
    private $_listaDePasajeros = array(); 
    private $_cantMaxima ;

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
        return "<br>" . $this->getFecha() . "<br>" . $this->getEmpresa() .
        "<br>" . $this->getPrecio() . "<br>" . $this->getListaPasajeros() . "<br>" . $this->getCantidad() ;
    }
    function AgregarPasajero($p)
    {
        if(!$p->Equals() && $count($_listaDePasajeros) < $p->getCantidad() )
        {   

        }

    }

}



?>
<?php 

/**
 * 
 */

 //include "Punto.php" ;
class Rectangulo 
{
    private  $_vertice1 ;
    private $_vertice2 ;
    private $_vertice3 ;
    private $_vertice4 ;
    public $area ;
    public  $perimetro ;
    public $ladoUno ;
    public $ladoDos ;


    function __construct($v1,$v3)
    {
        $this->_vertice1 = $v1 ;
        $this->_vertice3 = $v3 ;
    }


}



?>
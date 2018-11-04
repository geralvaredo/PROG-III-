<?php 

/**
 * 
 */
class Auto 
{
    public $_color ;
    public $_precio ;
    public $_marca ;
    public $_fecha ;
    function __construct($marca,$color,$precio = NULL ,$fecha = NULL)
    {
        $this->_marca = $marca ;
        $this->_color = $color ;
        $this->_precio = $precio;
	      $this->_fecha = $fecha;
        
    }
    


 function AgregarImpuestos($imp)
 {
     $this->_precio = $this->_precio + $imp ;
 }

   function ToString()
   {
       return $this->_marca . "<br>" . $this->_color . "<br>" . $this->_precio . "<br>" . $this->_fecha . "<br>" ;
   }


 static function MostrarAuto($Auto)
 {
    return  $Auto->ToString();
 }



function Equals ($a1, $a2)
{
    if($a1->_marca == $a2->_marca)
   return true ; 
    else
      return false ;
}


static function Add ($a1,$a2)
{
    $total = 0;
    if($a1->_marca == $a2->_marca && $a1->_color == $a2->_color)
    {
        $total = $a1->_precio + $a2->_precio ;
    }
    else
     {$total = 0;}

     return $total ;
}

}
?>
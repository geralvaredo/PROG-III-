<?php 
abstract class Figura
{
	protected $_color ;
	protected $_perimetro ;
	protected $_superficie ;
	
	public function GetColor()
	{
		return $this->_color ;
	}
	public function SetColor($c)
	{
		$this->_color = $c ;
	}

	function __construct()
	{
		
	}

	public abstract function Dibujar() ;

	protected abstract function CalcularDatos() ;

	public  function ToString()
	{	
		return  "Superficie: " . $this->_superficie . "<br>" . "Perimetro: ". $this->_perimetro . "<br>" ; //. "Color:" . $this->GetColor()   ; 	

	}


}


 ?>
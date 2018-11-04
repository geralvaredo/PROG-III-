<?php 

/**
* 
*/
  //require "FiguraGeometrica.php" ;

class Triangulo extends Figura
{
	public $_base ;
	public $_altura ;
	function __construct($v1, $v2)
	{
		$this->_base = $v1  ;
		$this->_altura = $v2 ;
		$this->CalcularDatos() ;	
	}

	public function CalcularDatos() 
	{
		$this->_superficie = (($this->_base * $this->_altura) /2) ;
		$this->_perimetro =  $this->_base * 3 ;
		
	}
	 public function Dibujar()
	 {

		//$tri[0] = array('f' => "**");
		//$tri[1] = array('f' =>"****");
		//$tri[2] = array('f' => "***");
		
	
		$ast =  "*" ;
		$espacio = "&nbsp" ;
		echo $espacio .$espacio .$espacio . $espacio. $espacio .  $ast . "<br>";
		echo $espacio. $espacio . $espacio .$ast . $ast . $ast . "<br>";
		echo $espacio . $ast . $ast . $ast .$ast.$ast ;
		echo "<br>" . "<br>" ;
		return "Color: " . $this->GetColor() ;
	 }	

	public  function ToString()
	{	
		echo  parent::ToString() . "<br>" . "Base: " . $this->_base . "<br>" . "Altura: " . $this->_altura . "<br>" . "<br>" .  $this->Dibujar() . "<br>"  ; 	

	}


}

 ?>
<?php 

	//require "FiguraGeometrica.php" ; 

class Rectangulo extends Figura
{
	private $ladoUno ;
	private $ladoDos ;

	function __construct($v1, $v2)
	{
		parent::__construct();
		$this->ladoUno = $v1 ;
		$this->ladoDos = $v2 ;
		$this->CalcularDatos() ;
		

	}

	public function CalcularDatos() 
	{
		$this->_superficie = $this->ladoUno * $this->ladoDos ;
		$this->_perimetro = ($this->ladoUno * 2) + ($this->ladoDos * 2) ;
		
	}

	public function Dibujar()
	{
		
		$ast =  "*****" ;
		$espacio = "&nbsp" . "&nbsp" . "&nbsp"  ;
		echo $espacio . $ast . "<br>";
		echo $espacio . $ast . "<br>";
		echo $espacio . $ast . "<br>";
		echo "<br>" ;
		return "Color: " .  $this->GetColor();

}
	

	public function ToString()
	{	
		echo parent::ToString() . "<br>" . "Lado 1ero: " . $this->ladoUno . "<br>" . "lado 2do: " . $this->ladoDos  . "<br>" . $this->Dibujar() . "<br>" ; 	
		
	}

	






}


 ?>
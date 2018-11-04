<?php 

	require "FiguraGeometrica.php" ;
	include "rectangulo.php" ;
    include "triangulo.php" ;

	$r1 = new rectangulo(2,4) ;
	$r1->SetColor("Blue");	
	$r1->ToString();
	echo "<br>" ;
	
	

	//$r1->Dibujar();
	echo "<br>" ;
	
	
	$t1 = new triangulo(3,5) ;
	$t1->SetColor("Red");
	$t1->Tostring();
	
	echo "<br>" ;
	//$t1->Dibujar();
	 
	
	//var_dump($r1) ;
  

      
 




 ?>
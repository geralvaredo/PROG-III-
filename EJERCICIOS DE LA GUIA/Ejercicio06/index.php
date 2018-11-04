<?php

	//echo "hola mundo" ;
	
	$ar = array();
	$ar[0] = rand(1,10) ;
	$ar[1] = rand(1,10) ;
	$ar[2] = rand(1,10) ;
	$acumulador = 0 ;
	$promedio = 0 ;
	array_push($ar,rand(1,10),rand(1,10)) ;
	
	for ($i=0; $i < count($ar) ; $i++) 
	{ 
		echo $ar[$i] . "<br>";
		$acumulador += $ar[$i] ;
	}
	 
  $promedio = $acumulador / count($ar) ;

  if ($promedio > 6) 
  {
  	echo "Mayores a 6" ;
  }
   elseif ($promedio == 6) 
   {
     echo "Igual a 6" ;
   }
   elseif ($promedio < 6 ) 
   {
   		echo "Menor a 6" ;
   }

?>
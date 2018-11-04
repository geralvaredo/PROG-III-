<?php

	//PRIMER EJERCICIO
	/*
		COMENTARIO BLOQUE

	*/
		
		//$nombre = "german"   ;
		//echo "Hola mundo" . "<br>" .  $nombre ;
		//echo   . $nombre ;

		/* APLICACION 01 */


		$contador = 0 ;
		$acumulador = 1 ;

		while ($acumulador < 1000) 
		{
			$contador = $contador + 1 ;
			$acumulador += $contador ;
			
			echo   $acumulador . " " ;
		}

		echo  "	Contador: " . $contador ; 
?>
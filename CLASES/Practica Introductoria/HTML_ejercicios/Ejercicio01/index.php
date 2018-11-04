	
<?php

		$contador = 0 ;
		$acumulador = 1 ;

		while ($acumulador < 1000) 
		{
			$contador = $contador + 1 ;
			$acumulador += $contador ;
			
			echo "<font color='white'>" .  $acumulador . " " . "</font>";
		}	
         
		echo  "<font color='white'>" . "Contador: "  . $contador . "</font>"   ; 


?>









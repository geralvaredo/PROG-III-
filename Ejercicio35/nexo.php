<?php 

 $caracteres = strlen($_POST['numero']);
 $numeros = str_split ($_POST['numero']) ;
 $pares = 0;
 $impares = 0 ;
 $total = 0 ;
 echo "<pre>" ;
 print_r($numeros);
 echo "</pre>" ;


 for ($i=0; $i < count($numeros) ; $i++) { 
     if( $numeros[$i] % 2 == 0 ){
        
        $pares += $numeros[$i];
     }
     elseif($numeros[$i] % 2 != 0){
        $impares  += $numeros[$i];
     }
     $total +=  $numeros[$i];
     
    
 } 





 echo "pares :" . $pares;
 echo "<br>";
 echo "impares :" . $impares;
 echo "<br>";
echo "total : " . $total ;
?>
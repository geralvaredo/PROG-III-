<?php 
     $a = rand(1,10) ;
    $b = rand(1,10) ;
    $c = rand(1,10) ;

    echo $a . "<br>" .  $b . "<br>" . $c  . "<br>" ;

    
$valorMedio = ($a + $b + $c) / 3 ;
    if($valorMedio == $a || $valorMedio == $b || $valorMedio == $c )    
        $resul = "Valor Medio :" . $valorMedio ;
    else
        $resul = "No tiene Valor Medio" ;

    echo $resul ;


?>
    




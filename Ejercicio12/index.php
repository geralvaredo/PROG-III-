<?php 

$ar = array("a","b","c","d" );
$ar2 = array("H","O","L","A") ;

function invertir($arc)
{
   return $arc = array_reverse($arc);
}
 $ar = invertir($ar) ;
 
$ar2 = array_reverse($ar2) ;

/* EL sort() ORDENA DE MENOR A MAYOR */
/*EL rsort() ORDENA DE MAYOR A MENOR */


foreach ($ar as $item)    
{
    echo $item ;        
}

echo "<br>" ;
foreach ($ar2 as  $value) {
    echo $value ;
}

 ?>
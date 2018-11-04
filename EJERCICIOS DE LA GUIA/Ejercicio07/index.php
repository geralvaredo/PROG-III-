<?php
$ar = array();
$contador = 0 ;
array_push($ar,1,3,5,7,9,11,13,15,17,19) ;
$j =0;
for ($i=0; $i < count($ar); $i++) { 
    
    echo $ar[$i] . "<br>" ;
}
foreach ($ar as $value) 
{
   echo $value . "<br>" ;    
}

while($contador < count($ar))
{
    echo  $ar[$contador] . "<br>" ;
    $contador++ ;   
}


?>
<?php

echo "FECHA: " . date("Y-m-d") . "<br>" ;
echo "FECHA: " . date("Y.m.d") . "<br>" ;
echo "FECHA: " . date("Y/m/d") . "<br>" ;
echo date('l jS \of F Y ') . "<br>";
echo date(DATE_RFC2822) . "<br>";
echo date("Y-m-d H:i:s") . "<br>" . "<br>" ;


$mesactual = date("m") ;

$verano = array(12,01,02) ;
$otonio = array(03,04,05) ;
$invierno = array(06,07,08) ;
$primavera = array(09,10,11) ;

if(in_array ($mesactual,$verano))
{
    echo "Es Verano" ;
}
elseif(in_array($mesactual,$otonio))
{
    echo "Es Otoño" ;
}
elseif (in_array($mesactual,$invierno)) 
{
  echo "Es Invierno" ;
}
elseif (in_array($mesactual,$primavera)) 
{
   echo "Es Primavera" ;
}

//echo $mesactual ;

?>
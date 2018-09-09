<?php 

Require ("Vuelo.php") ;

$p1 = new Pasajero("Oscar","Cordoba","20555987",true) ;
$p2 = new Pasajero("Martin","Palermo","20444987",false)  ;
$p3 = new Pasajero("Jorge","Bermudez","20258753",true) ;
$p4 = new Pasajero("Juan Roman", "Riquelme","20159753",false) ;

$p5 = new Pasajero("Chicho", "Serna","20159753",false) ;

//Agrego pasajeros a un vuelo
/*Pasajero::MostrarPasajero($p1) ;
Pasajero::MostrarPasajero($p2) ;
Pasajero::MostrarPasajero($p3) ;
Pasajero::MostrarPasajero($p4) ;
*/

$v1 = new Vuelo("Avianca",14000,3) ;
$v2= new Vuelo ("Iberia",16000,1) ;


echo $v1->AgregarPasajero($p1) ;
echo $v2->AgregarPasajero($p2) ;
echo $v1->AgregarPasajero($p3) ;
echo $v2->AgregarPasajero($p4) ;
echo $v1->AgregarPasajero($p5) ;


//echo "<pre>" ;
//print_r($v2->_listaDePasajeros);
//echo "</pre>" ;

echo $v1->infoVuelo() ;
echo $v2->InfoVuelo() ;

  Vuelo::Add($p1,$p2);

echo $v1->Remove($p1,$v1) ;

//echo "<pre>" ;
//print_r($v1->_listaDePasajeros);
//echo "</pre>" ;

?>
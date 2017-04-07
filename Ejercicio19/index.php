<?php 

Require ("Vuelo.php") ;

$p1 = new Pasajero("jorge","newberry","40555987",true) ;

$v1 = new Vuelo("Avianca",14000,5) ;

Pasajero::MostrarPasajero($p1) ;

$v1->AgregarPasajero($p1) ;

echo $v1->infoVuelo() ;

  //  $v1->AgregarPasajero($p1) ;
    //$v1->Add($p1);

?>
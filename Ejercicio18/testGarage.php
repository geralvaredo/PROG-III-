<?php

require "../Ejercicio17/TestAuto.php";
//require "../Ejercicio17/Auto.php";
require "Garage.php";

$g1 = new Garage("Est", 50);
echo "<pre>";
print_r($g1);
echo "</pre>";
$g1->Equals($g1,$Auto1);
$g1->Add($g1,$Auto1);
$g1->Add($g1,$Auto2);

echo $g1->MostrarGarage() ;

echo $g1->Remove($g1,$Auto1) ;
?>
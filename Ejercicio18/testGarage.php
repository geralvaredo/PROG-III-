

<?php 

require "../Ejercicio17/TestAuto.php" ;
//require "../Ejercicio17/Auto.php" ;
include "Garage.php" ;

$g1 = new Garage("Est",50) ;

$g1->Equals($g1,$Auto1) ;

$g1->Add($g1,$Auto1) ;

//var_dump($g1);
echo $g1->MostrarGarage() ;



$g1->Remove($g1,$Auto1) ;


 
  
 



?>
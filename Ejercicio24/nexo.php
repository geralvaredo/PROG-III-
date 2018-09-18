<?php 

require ("Enigma.php") ;

$palabra = "hola" ;


$obj = new Enigma($palabra) ;
$clave = Enigma::encriptar($palabra) ;
Enigma::guardar($clave) ;
echo  $clave . "<br>";
 $claveD = Enigma::desencriptar($clave);
 echo "<pre>" ;
 print_r ($claveD) ;
 echo "</pre>" ;
?>
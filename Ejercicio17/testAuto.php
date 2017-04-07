<?php 

require "Auto.php" ;



$Auto1 = new Auto("Ferrari","Rojo") ;
$Auto2 = new Auto("Ferrari","Negro") ;
$Auto3 = new Auto("Ferrari","Azul",12000) ;
$Auto4 = new Auto("Ferrari","Azul",15000) ;
$Auto5 = new Auto("Ford","Negro",11000,date("Y-m-d")) ;
//var_dump($Auto1) ;

/*
echo Auto::MostrarAuto($Auto1) ;
echo Auto::MostrarAuto($Auto2) ;
echo Auto::MostrarAuto($Auto3) ;
echo Auto::MostrarAuto($Auto4) ;
echo Auto::MostrarAuto($Auto5) ;

$Auto3->AgregarImpuestos(1500) ;
$Auto4->AgregarImpuestos(1500) ;
$Auto5->AgregarImpuestos(1500) ;
echo "<br>" ;
echo Auto::MostrarAuto($Auto3) ;
echo Auto::MostrarAuto($Auto4) ;
echo Auto::MostrarAuto($Auto5) ;
echo  "<br>" ;

$importe = Auto::Add($Auto1,$Auto2) ;
echo $importe . "<br>" ;

if (Auto::Equals($Auto1,$Auto2)) 
echo "Son Iguales" . "<br>" ;
else
echo "Son Distintos" . "<br>" ;

if(Auto::Equals($Auto1,$Auto5))
echo "Son Iguales" . "<br>" ;
else
echo "Son Distintos" . "<br>" ;
*/
?>
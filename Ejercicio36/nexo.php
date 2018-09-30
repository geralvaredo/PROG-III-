<?php 
   $url = $_SERVER['REQUEST_URI']; 
 $foto = str_replace("/nexo.php?.","",$url); 
 
 echo $link = '<img  src =' . $foto  .'>' ;
echo "<br>" ;
echo "<a style= 'color: green; font-weight: bolder; font-size:50px;' href='http://localhost/practica/Ejercicio36/index.php'> Volver </a>"

?>
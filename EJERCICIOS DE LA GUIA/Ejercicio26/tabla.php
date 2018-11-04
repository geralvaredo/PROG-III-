<?php 

echo tabla();

 function tabla(){
    $columna= 3;
    $fila = 2;
    $tabla= array();

    for($i=1;$i<=$columna;$i++){
        for($j=1;$j<=$fila;$j++){
            $tabla[$i][$j] =  "HOLA" ;                
        }
    }
   
    
    /*echo "<pre>" ;
    print_r($tabla) ;
    echo "</pre>" ;*/
 // FALTA TABLA    
    
    


}
  
    



?>
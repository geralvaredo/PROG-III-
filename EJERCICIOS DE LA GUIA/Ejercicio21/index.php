<?php

function retorno (){
    $una = 0;
    $dos = 0;
    $tres = 0;
    $cuatro = 0;
    $masDeCuatro = 0;
    $listaPalabras = array();
    $largo = 0;
    $archivo = fopen("archivo.txt","r");
    while(!feof($archivo)){
        $renglon = fgets($archivo);
        $palabra = explode(" ",$renglon);
        
        $listaPalabras[] = $palabra ;       
        
    }
   fclose($archivo);
   
   for($i = 0 ; $i<count($listaPalabras);$i++){
      for($j = 0 ;  $j<count($listaPalabras[$i])  ; $j++){
        echo("<pre>");   
        print_r($listaPalabras[$i][$j]);
        echo("</pre>");
          $largo = strlen($listaPalabras[$i][$j]);
          
          if($largo == 1){
            $una = $una + 1;
           
        } 
        elseif($largo == 2){
            $dos = $dos +1 ;
            
        }
        elseif($largo == 3){
            $tres = $tres + 1;
        }
        elseif($largo == 4){
            $cuatro = $cuatro + 1;
        }
        else{
            $masDeCuatro = $masDeCuatro + 1;
             }
      }
    } 
    

   echo  "Hay " .  $una . " palabras de una 1 letra" . "<br>" 
    . "Hay " . $dos . " palabras de 2 letras " . "<br>"  
    . "Hay " . $tres . " palabras de 3 letras" . "<br>" 
    . "Hay " . $cuatro . " palabras de 4 letras" . "<br>" 
    . "Hay " . $masDeCuatro . " palabras de mas de 4 letras" . "<br>" ;
   
}



?>
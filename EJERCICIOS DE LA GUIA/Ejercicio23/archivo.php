<?php   
       $url = $_POST['url']  ;
       if($url != NULL){
        retorno($url);
        echo "Url Ingresada exitosamente";
       } 
       else{
            echo "Ingrese url";
       }
       
      
          
      function retorno ($url){
               
        $archivoOrigen = fopen($url,"r");
        $date = date("Y-m-d");
        $path = 'misArchivos/archivoNuevo' . $date  . ".txt" ;
        $archivoDestino = fopen($path,"a");
        $listaLetras = "";
        
        while(!feof($archivoOrigen)){
           $renglonOrigen = fgets($archivoOrigen);
           $listaLetras = $renglonOrigen;
        }

         /* El fgets toma el primer renglon
           Lo tiramos a una variable como string para poder sepaparlo
           lo separamos con el preg_split y le indicamos en los parametros el delimitador ... etc
           lo invertimos con array_reverse 
           la variable $listaLetras vuelve a ser un array 
           con el metodo implode volvemos a convertir $listaLetras en una variable String
           el metodo fwrite() acepta unicamente parametros string, no acepta arrays 
         */
          $listaLetras = preg_split('//',$listaLetras,-1,PREG_SPLIT_NO_EMPTY);
          echo "<pre>" ;
          print_r($listaLetras);
          echo "</pre>" ;
          $listaLetras = array_reverse($listaLetras);
          echo "<pre>" ;
          print_r($listaLetras);
          echo "</pre>" ;
          $listaLetras = implode($listaLetras);
          //echo $listaLetras;
          echo "<br>" ;
           fwrite($archivoDestino,$listaLetras);            
           fclose($archivoOrigen);
           fclose($archivoDestino);
       
       
       
    }


?>
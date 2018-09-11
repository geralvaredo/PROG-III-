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
       
        while(!feof($archivoOrigen)){
           $renglonOrigen = fgets($archivoOrigen);
           fwrite($archivoDestino,$renglonOrigen); 
          }
        fclose($archivoOrigen);
        fclose($archivoDestino);
       
       
       
    }


?>
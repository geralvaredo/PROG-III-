<?php 
    
     if( $_POST['boton'] == 'enviar'){
         
        $superficie =  isset($_POST['super']) ?  $_POST['super'] : NULL;
        $perimetro = isset($_POST['peri'])  ? $_POST['peri'] : NULL  ;
        $base  = $_POST['base'] !=  null  ? $_POST['base']  : NULL ;
        $altura = $_POST['altura'] !=  null  ? $_POST['altura']  : NULL ;
        if($superficie){
                  
           $resultado = $base * $altura / 2;
           echo "La superficie es: " . $resultado ;
           echo "<br>" ;
           echo "<a href=' ./inicio.html'title=''Ir la página anterior>Volver</a>" ;
         }
         if($perimetro){               
            $resultado = $base * 2 +  $altura * 2;
            echo "El perimetro es: " . $resultado ;
            echo "<br>" ;
            echo "<a href=' ./inicio.html'title=''Ir la página anterior>Volver</a>" ;
         }
          
     }           
        
    
    ?>
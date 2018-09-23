<?php 
    
     if( $_POST['boton'] == 'enviar'){
         
         $base  = $_POST['1'] !=  null  ? $_POST['1']  : NULL ;
          $altura = $_POST['2'] !=  null  ? $_POST['2']  : NULL ;       
          $resultado = $base * $altura / 2;
          echo "El area es: " . $resultado ;
          echo "<a href=' ./inicio.html'title=''Ir la página anterior>Volver</a>" ;
     }           
        
    
    ?>
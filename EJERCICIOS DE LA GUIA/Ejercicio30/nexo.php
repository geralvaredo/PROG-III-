<?php 

if($_POST['boton'] == 'enviar'){
    $dia = isset($_POST['dia'])  ? $_POST['dia'] : NULL  ;
    $mes = isset($_POST['mes'])  ? $_POST['mes'] : NULL ;
    $anio = isset($_POST['anio'])  ? $_POST['anio'] : NULL ;
    $mensaje = "" ;
     if($dia != null){  
             $mensaje = "El dia es " .  date("d") ; 
     }
     if($mes != null){
         $mensaje .= ",  El mes es " . date("m") ;
     }
     if($anio != null){
        $mensaje .= ",  El año es " . date("Y") ;
    }
     echo $mensaje ;
}

?>
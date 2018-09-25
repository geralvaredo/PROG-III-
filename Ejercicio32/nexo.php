<?php
if(isset($_POST['boton'])){
    $destino = $_POST["destino"];
    $pago = $_POST['pago'] ;
    $pasajero = $_POST['pasajero'];
    $mensaje = "El Viaje cuesta : " ;
    $extra = 0 ;
    $total ; 
    if($pasajero > 2)
    {
      $extra = 0.35 ; 
    }   
    if($pago ==  "efectivo") {
        $total =  (($destino - ($destino * 0.12 )) * $pasajero) * ($extra * ($pasajero - 2));
    }
    else{
          $mensaje .=  $destino - ($destino * 0.07 ) ;
    }
    
    echo $mensaje . $total ;

}


?>
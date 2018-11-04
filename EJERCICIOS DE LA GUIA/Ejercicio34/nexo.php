<?php 
if (isset($_POST['boton'])){
    $importe = $_POST['importe'];
    $pagar ;
    if($importe >= 300 && $importe <= 550){
     $pagar = $importe - ($importe * 0.10) ;
    }
    elseif($importe > 550){
        $pagar = $importe - ($importe * 0.20) ;
    }
    else{
        $pagar = $importe ;
    }
    
    echo "Importe a pagar: " . $pagar ;
    
}

?>
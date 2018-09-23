<?php 
     if($_POST['boton'] == 'enviar') {
        $ingreso = $_POST['ingreso'] != NULL ? $_POST['ingreso'] : NULL ;
     $reingreso = $_POST['reingreso'] != NULL ? $_POST['reingreso'] : NULL;
     if($ingreso == $reingreso){
        header('Location: wellcome.php');   
     }
     else{
        header ("Location: inicio.php") ; 
       }
     }
     
?>
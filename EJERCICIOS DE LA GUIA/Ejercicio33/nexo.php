<?php
if(isset($_POST['boton'])){
    $nombre    = $_POST['nombre'];
    $apellido  = $_POST['apellido'];
    $edad      = $_POST['edad'];
    $direccion = $_POST['direccion'];
    $email     = $_POST['email'];
    $cv        = $_POST['cv'];

    echo $nombre . "<br>" . $apellido . "<br>" . $edad . "<br>" . $direccion . "<br>" . $email 
    . "<br>" . $cv ; 

}



?>
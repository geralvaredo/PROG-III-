<?php
include("Usuario.php") ;

$correo = $_POST['correo'];
$clave = $_POST['clave'];

echo $resultado = Usuario::verificacionUsuarioContra($correo,$clave) ;

?>
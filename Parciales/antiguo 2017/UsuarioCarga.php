<?php
include("Usuario.php") ;
$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$perfil = $_GET['perfil'];
$edad = $_GET['edad'];
$clave = $_GET['clave'];

$usu = new Usuario($correo,$clave,$nombre,$perfil,$edad) ;

Usuario::altaUsuario($usu);
echo "<pre>";
print_r($usu);
echo "</pre>";
?>

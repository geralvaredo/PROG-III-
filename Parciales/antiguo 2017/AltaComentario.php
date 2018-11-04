<?php

include("Usuario.php");
$correo = $_POST['correo'] ;
$titulo = $_POST['titulo'] ;
$comentario = $_POST['comentario']; 

if(Usuario::verificarUsuario($correo))
{
    $resultado = Usuario::altaComentario($correo,$titulo,$comentario);
    echo $resultado ;
}
else
{
    echo "usuario no existe";
}




?>
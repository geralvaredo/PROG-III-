<?php

include("Usuario.php");
$correo = $_POST['correo'] ;
$titulo = $_POST['titulo'] ;
$comentario = $_POST['comentario'];
$archivo = $_FILES["archivo"]['name'] ;
$temporal = $_FILES["archivo"]["tmp_name"] ;
$tipoArchivo =  pathinfo( $archivo, PATHINFO_EXTENSION );
$nuevoArchivo = $titulo . "." .  $tipoArchivo;

$destino = "ImagenesDeComentario/" . $nuevoArchivo ;
if(Usuario::verificarUsuario($correo))
{
    if(!empty($archivo))
    {        
        move_uploaded_file($temporal,$destino) ;
        $resultado = Usuario::altaComentarioConImagen($correo,$titulo,$comentario,$nuevoArchivo);
    }
    
    echo $resultado ;
}
else
{
    echo "usuario no existe";
}




?>
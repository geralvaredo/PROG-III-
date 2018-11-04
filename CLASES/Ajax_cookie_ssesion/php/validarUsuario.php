<?php 
require_once("../clases/usuarios.php");
session_start();// Para inicializar la session siempre debe estar este metodo en la primera linea
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$recordar=$_POST['recordarme'];


$retorno;

$arrayUsuarios = usuario::TraerTodoLosUsuarios();
foreach ($arrayUsuarios as $usu) {
			
	if($usuario == $usu->usuario)
	{
		if($clave== $usu->contrasena){
			
				// le asigno a la session "usuario" el array de usuarios
				$_SESSION['usuario']=$usu; 
				$retorno=" ingreso";
		}else{
			$retorno = "contrasena invalidad";
		}
	}else{
		$retorno = "usuario invalido";
	}


/*if($usuario=="admin@admin.com.ar" && $clave=="admin")
{			
	if($recordar=="true")
	 {
	 	setcookie("registro",$usuario,  time()+36000 , '/');
		
	 }else
	{
		setcookie("registro",$usuario,  time()-36000 , '/');
		
	 }

	*/


}	



echo $retorno;
?>
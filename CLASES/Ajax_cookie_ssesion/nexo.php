<?php 
require_once("clases/AccesoDatos.php");
require_once("clases/usuarios.php");

$queHago=$_POST['queHacer'];

switch ($queHago) {
	case 'foto':
		include("partes/imagen.php");
		break;
	case 'video':
			include("partes/video.html");
		break;	
	case 'MostarBotones':
			include("partes/botonesABM.php");
		break;
	case 'MostrarGrilla':
			include("partes/formGrilla.php");
		break;
	case 'MostarLogin':
			include("partes/formLogin.php");
		break;
	case 'MostrarFormAlta':
			include("partes/formCd.php");
		break;
	case 'BorrarUsuario':
			$usuario = new usuario();
			$usuario->id=$_POST['id'];
			$cantidad=$usuario->BorrarUsuario();
			echo $cantidad;

		break;
	case 'GuardarUsuario':
			$usuario = new usuario();
			$usuario->id=$_POST['id'];
			var_dump($_POST['id']);
			$usuario->usuario=$_POST['usuario'];
			$usuario->contrasena=$_POST['contrasena'];
			$usuario->tipo=$_POST['tipo'];
			$cantidad=$usuario->GuardarUsuario();
			var_dump($cantidad);

		break;
	case 'TraerUsuario':
			$Usuario= usuario::TraerUnUsuario($_POST['id']);		
			 $usu =json_encode($Usuario);
			 echo $usu;
		break;
	default:
		# code...
		break;
}

 ?>
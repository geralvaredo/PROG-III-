<?php 
session_start();

if(isset($_SESSION['usuario']))
{


if($_SESSION['usuario']->tipo == "admin"){

	require_once("./clases/AccesoDatos.php");
	require_once("./clases/usuarios.php");
	require_once("botonesABM.php");


	$arrayDeUsuarios=usuario::TraerTodoLosUsuarios();

	

 ?>
<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
			<th>Editar</th><th>Borrar</th><th>id</th><th>cantante</th><th>disco</th><th>año</th>
		</tr>
	</thead>
	<tbody>

		<?php 

foreach ($arrayDeUsuarios as $usuario) {
	echo"<tr>
			<td><a onclick='EditarUsuario($usuario->id)' class='btn btn-warning'> <span class='glyphicon glyphicon-pencil'>&nbsp;</span>Editar</a></td>
			<td><a onclick='BorrarUsuario($usuario->id)' class='btn btn-danger'>   <span class='glyphicon glyphicon-trash'>&nbsp;</span>  Borrar</a></td>
			<td>$usuario->id</td>
			<td>$usuario->usuario</td>
			<td>$usuario->contrasena</td>
			<td>$usuario->tipo</td>
		</tr>   ";
}
		 ?>
	</tbody>
</table>

<?php 

// sin login 
}else if($_SESSION['usuario']->tipo == "user")
	{
	require_once("./clases/AccesoDatos.php");
	require_once("./clases/usuarios.php");


	$arrayDeUsuarios=usuario::TraerTodoLosUsuarios();


?>
		<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
			<th>Editar</th><th>Borrar</th><th>id</th><th>cantante</th><th>disco</th><th>año</th>
		</tr>
	</thead>
	<tbody>

		<?php 

foreach ($arrayDeUsuarios as $usuario) {



	echo"<tr>
			<td>$usuario->id</td>
			<td>$usuario->usuario</td>
			<td>$usuario->contrasena</td>
			<td>$usuario->tipo</td>
		</tr>   ";
}
		 ?>
	</tbody>
</table>	

<?php

	}

}
	?>
	
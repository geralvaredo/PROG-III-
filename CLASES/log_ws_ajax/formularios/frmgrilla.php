

<?php 


if(isset($_SESSION['usuario']))
{
	 		
		require_once('./servidor/AccesoDatos.php');
		require_once("./servidor/usuario.php");

	if($_SESSION['usuario']["Tipo"]== 1009)
	{
	
	include("botonesABM.php");		
		
	


    $host = 'http://localhost:8080/log_ws_ajax/SERVIDOR/testWS.php';
    $client = new nusoap_client($host . '?wsdl');
        $arrayDeUsuarios = $client->call('TraerTodos',array());

 ?>
  
<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
			<th>Editar</th><th>Borrar</th><th>id</th><th>Email</th><th>Nombre</th><th>Password</th><th>Tipo</th><th>Foto</th>

		</tr>
	</thead>
	<tbody>

		<?php 

foreach ($arrayDeUsuarios as $usuario) {
$nombre = $usuario['Nombre'];
$id = $usuario['id'];
$pw = $usuario['Password'];
$tipo = $usuario['Tipo'];
$email = $usuario['Email'];
$foto = $usuario['Foto'];
	
	echo"<tr>
			<td> <input type='submit' value='Modificar' onclick='ModificarUsuario($id)'></td>
			<td> <input type='submit' value='Borrar' onclick='BorrarUsuario($id)'></td>
			<td>$id</td>
			<td>$email</td>
			<td>$nombre</td>
			<td>$pw</td>
			<td>$tipo</td>
			<td><IMG src='./SERVIDOR/tmp/$foto' width='50' height='50'/></td>

		</tr>   ";
}
		 ?>
	</tbody>
</table>

<?php 

// sin login 
}else if($_SESSION['usuario']["Tipo"] == 1007)
	{



    	 $host = 'http://localhost:8080/log_ws_ajax/SERVIDOR/testWS.php';
  	  $client = new nusoap_client($host . '?wsdl');
        $arrayDeUsuarios = $client->call('TraerTodos',array());
	

?>
		<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
				<th>Editar</th><th>Borrar</th><th>id</th><th>Email</th><th>Nombre</th><th>Password</th><th>Tipo</th><th>Foto</th>
		</tr>
	</thead>
	<tbody>

		<?php 

foreach ($arrayDeUsuarios as $usuario) {
$nombre = $usuario['Nombre'];
$id = $usuario['id'];
$pw = $usuario['Password'];
$tipo = $usuario['Tipo'];
$email = $usuario['Email'];
$foto = $usuario['Foto'];


	echo"<tr>
			<td>SOLO ADMINISTRADORES</td>
			<td>SOLO ADMINISTRADORES</td>
			<td>$id</td>
			<td>$email</td>
			<td>$nombre</td>
			<td>$pw</td>
			<td>$tipo</td>
			<td><IMG src='./SERVIDOR/tmp/$foto' width='50' height='50'/></td>

		</tr>   ";
}
		 ?>
	</tbody>
</table>	

<?php

	}else if($_SESSION['usuario']["Tipo"] == 1008)
	{


		
    	 $host = 'http://localhost:8080/log_ws_ajax/SERVIDOR/testWS.php';
  	  $client = new nusoap_client($host . '?wsdl');
        $arrayDeUsuarios = $client->call('TraerTodos',array());
	

?>
		<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
				<th>Editar</th><th>Borrar</th><th>id</th><th>Email</th><th>Nombre</th><th>Password</th><th>Tipo</th><th>Foto</th>
		</tr>
	</thead>
	<tbody>

		<?php 

foreach ($arrayDeUsuarios as $usuario) {
$nombre = $usuario['Nombre'];
$id = $usuario['id'];
$pw = $usuario['Password'];
$tipo = $usuario['Tipo'];
$email = $usuario['Email'];
$foto = $usuario['Foto'];

if($_SESSION['usuario']["id"] == $id)
{
echo"<tr>
			<td> <input type='submit' value='Modificar'></td>
			<td> <input type='submit' value='Borrar'></td>
			<td>$id</td>
			<td>$email</td>
			<td>$nombre</td>
			<td>$pw</td>
			<td>$tipo</td>
			<td><IMG src='./SERVIDOR/tmp/$foto' width='50' height='50'/></td>

		</tr>   ";

}else
	{

	echo"<tr>
			<td>SOLO ADMINISTRADORES</td>
			<td>SOLO ADMINISTRADORES</td>
			<td>$id</td>
			<td>$email</td>
			<td>$nombre</td>
			<td>$pw</td>
			<td>$tipo</td>
		</tr>   ";
	}
}
		 ?>
	</tbody>
</table>	

<?php

	}
}
	?>
	
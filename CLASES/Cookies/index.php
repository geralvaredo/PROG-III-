<?php
  $path = "gestion.php" ;
  require_once "Alquiler.php" ;

if($_COOKIE["pelicula"]!= "x" && (!is_null($_COOKIE["pelicula"])))
{

echo "<h1>"."ULTIMA PELICULA: ".$_COOKIE["pelicula"]."</h1>";

}else if(is_null($_COOKIE["pelicula"])) {
	echo "<h1>"."NO SE ALQUILARON PELICULAS"."</h1>";

}

?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
 <form action= "<?php echo $path ?>"   name="Alquiler" method="POST"  >
 	<table border = "1px">
 		<tr>
 		<th> CLIENTES </th> <th> PELICULAS </th> <th> ALQUILA POR </th> <th> ES PARA NIÑOS?</th>	
 		<tr>	
 		<!-- TEXTBOX -->
 		<th> <input type="Text" name="cliente" placeholder="Ingrese Usuario Aqui" /></th>	
 		<!-- COMBOBOX -->
 		<th> <select name="pelicula"> 
 		<option value="Avengers"> Avengers </option>
 		<option value="Iron Man"> Iron Man</option>
 		<option value="Thor"> Thor</option>
 		<option value = "Capitan America"> Capitan America</option>
 		</select> </th>
 		<!-- RADIOBUTTON -->
 		
 		<th>   
 		 
 		 <input type = "radio" id="Alquiler" name= "Alquiler" value="1" > 1 dia 	
 		 <input type = "radio" id = "Alquiler" name= "Alquiler" value = "2"> 2 dias
 		 <input type = "radio"	id="Alquiler" name="Alquiler" value="3"> 3 dias
 		 
 		  </th>
 		 <!-- CHECKBOX -->
 		<th> 
 			<input type="checkbox" name="nino" value="si" unchecked > </th>
 	</table>
 	<br>	
 	<input type="submit"  name="boton" value= "Alquilar" >



 </form>



</body>
</html>



<!DOCTYPE html>
<html>
<title> GESTION DE ALQUILERES</title>
<head> 
<?php
	require_once "Alquiler.php" ;
    $cliente = $_POST['cliente'];
    $pelicula = $_POST['pelicula'];
    $dias = $_POST['Alquiler'] ;
    $condicion = false ;
    if(isset($_POST['nino'])) 
    {
	$condicion = true ;
    }


if(isset($_POST['boton']))
{
	$a = new Alquiler($cliente, $pelicula,$dias);
	Alquiler::RegistrarAlquiler($a);
 	$registro = array() ;
	$registro[] = Alquiler::obtenerAlquileres() ;
	echo "Importe". $a->CalcularImporte();
	
	
}
	



?>


 </head>
<body>

<form  name="Gestion" method="POST"  >
 	 
 	<table border = "1px">
 		               
 		    <?php
 			  		
					Alquiler::Tabla();
						if(sizeof($registro)==0)
						{
						$_cookie_value= "x";
						}
						else
						{

					$cookie_name = "pelicula " ;
					$_cookie_value = $_POST['pelicula'] ;
					setcookie($cookie_name,$_cookie_value) ;
						}
					//$listadoAlquiler[] = Alquiler::obtenerAlquileres() ;

 			  		
 			   
 			   
 			    //echo $listadoAlquiler ;

 		?>					
 			</table> 
 		
<input type="Text" name="cliente" > <input type="Submit" name="devolver">
<br>





 </form>


 



</body>
</html>
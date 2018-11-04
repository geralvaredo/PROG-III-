<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/estilo.css"> 
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"> </script>
    <script type='text/javascript' src = 'js/funciones.js' ></script>
  <?php 
    include("clases/Usuario.php") ;
    include("clases/Container.php");
    ?>
</head>
<body>      
    <div class="container">
         <div class="page-header">
            <a class="sesion" href="VerificarUsuario.php"> CERRAR SESION</a>
        <h1 align="center" class="listado-usuario"  > LISTADO DE USUARIOS</h1>
        </div>                
    </div>          
      <div class="container">          
          <div class="table-responsive">       
        <?php           
         $lista = Usuario::leer();
        $grilla = '<table class="table">
				<thead">
				<tr >
				<th>  USUARIO </th>
                <th>  CORREO  </th>
                <th>  EDAD  </th>
				<th>  ACCION  </th>
				</tr> 
				</thead>';
            
           ?>                        
           <div id="tabla-usuario" >
             <?php               
                foreach($lista as $usuario)   {
                 
                  $nombre = $usuario->getNombre();
                  $correo = $usuario->getCorreo();
                  $edad = $usuario->getEdad();        
                  $grilla .= " <tbody> <tr><td>" .
                "$nombre" . "</td><td>" . "$correo" . "</td><td>" .  
                "$edad" .  "</td><td>" .     
                "<input type='button' class='btn btn-danger' id='accion' name='accion' onclick='eliminar($nombre)'  value= 'eliminar'>" . "</td> <tr>" ;
              }
                $grilla .= ' </tbody> </table>';	
               echo $grilla ;
                           
               ?>
               
           </div>  
        </div>
        <br><br>
         <a href="ContainerAlta.php" class="btn btn-info">Alta Container</a> 
         <a href="filtradoContainer.php" class="btn btn-success"> Filtrar </a>
        </div>    
            
                
          <div class="container">
         <div class="page-header">
        <h1 align="center" class="listado-container"  > LISTADO DE CONTAINERS</h1>
        </div> 
    </div>
     
    <div class = "container">
        <div  class="table-responsive" >
            <?php 
            
              $listaContainer = Container::leer();
              $grillaContainer = '<table class="table">
				<thead">
				<tr >
				<th>  NUMERO </th>
                <th>  DESCRIPCION  </th>
                <th>  PAIS  </th>
				<th>  FOTO  </th>
                <th>  ACCION  </th>
				</tr> 
				</thead>';
            
            
            ?>
            <div id="tabla-container" >
               <?php
                foreach($listaContainer as $container)   {
                 
                  $numero = $container->getNumero();
                  $descripcion = $container->getDescripcion();
                  $pais = $container->getPais();        
                  $grillaContainer .= " <tbody> <tr><td>" .
                "$numero" . "</td><td>" . "$descripcion" . "</td><td>" .  
                "$pais" .  "</td><td>". "<img src='". "archivos/" .$container->getFoto(). " ' border='0' width='150' height='50'>" . "</td><td>" .     
                "<input type='button' class='btn btn-danger' id='accion' name='accion' onclick='bajaContainer($numero)'  value= 'eliminar'>" . "</td> <tr>" ;
              }
                $grillaContainer .= ' </tbody> </table>';	
                echo $grillaContainer ;
                
                ?>
                
                </div>           
            </div>       
        </div>  
      
                
                              
</body>
</html>
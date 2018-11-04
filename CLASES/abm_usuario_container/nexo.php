<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/estilo.css">
    <title>ABM</title>
</head>
  
<body class="volver"> 
<?php 
include "clases/Usuario.php" ;
include "clases/Container.php"; 
$boton = $_POST['accion'] ;
$mensaje = "";
$volverListado = "<a href='Listado.php' class='btn btn-info' title='Volver'>Volver</a>" ; 
$volverLogin = "<a href='VerificarUsuario.php' class='btn btn-info' title='Volver'>Volver</a>" ; 
$volverAlta="<a href='UsuarioCarga.php' class='btn btn-info' title='Volver'>Volver</a>" ; 
?> 
   
 <?php
switch($boton){
    
    case 'cerrar':
                        header('Location: VerificarUsuario.php');
                        break;    
       
    case 'guardar' :
                       $nombre = $_POST['nombre'] ;
                       $correo = $_POST['correo'] ;
                       $edad   = $_POST['edad'] ;
                       $clave  = $_POST['clave'] ;
                       if(Usuario::verificacion($nombre,$clave))
                       {
                           echo $mensaje= "<p>el usuario ya existe, reingrese otro usuario por favor</p>"; 
                           echo $volverAlta;
                       }
                       else
                       {
                        $u1 = new Usuario($nombre,$correo,$edad,$clave);
                       Usuario::altaUsuario($u1);
                       echo $mensaje = "<p>" ."Usuario: " . $u1->getNombre() . "  Dado de Alta Exitosamente</p> ";
                         echo  $volverLogin;
                       }
                       
                         break;      
    case 'ingresar':       
                       $usuario = $_POST['usuario'] ;
                       $contra = $_POST['clave'] ;
                       
                        if(Usuario::verificacion($usuario,$contra)){
                        header('Location: Listado.php');
                         echo  $volver; 
                        }    
                       else{
                              echo $mensaje = "<p>" . "Usuario Incorrecto o no Registrado" ."</p>";   
                               echo $volverLogin ;
                                }   
                        break;
        
    case 'eliminar':
                        $usuario = $_POST['usu'];
                        $valor = Usuario::baja($usuario);           
                        if($valor)
                        {
                         echo $mensaje = "<p>" . "usuario: " . $usuario ." eliminado </p>"    ;
                           
                        }
                        else{
                            echo $mensaje = "<p>" . "Error al eliminar el usuario: " . $usuario ."</p>"    ;
                        }
                        echo $volverListado ;      
                        break;

    case 'Alta' :
                                                
                        $numero = $_POST['numero'] ;                         
                        $descripcion = $_POST['descripcion'] ; 
                        $pais = $_POST['pais'] ;
                        $archivo = $_FILES["archivo"]['name'] ;
                        if(Container::verificacion($numero,$pais))
                        {
                            echo $mensaje = "<p>el container con ese numero ya existe en " . $pais . "</p>";  
                        }
                        else{    
                        if(!(empty($archivo))){
                        $temporal = $_FILES["archivo"]["tmp_name"] ;
                          
                        $destino = "archivos/" . $archivo ;                    
                        $existe = file_exists($destino);                        
                        if(!$existe){
                        $container = new Container($numero,$descripcion,$pais,$archivo) ;
                        Container::altaContainer($container);    
                        move_uploaded_file($temporal,$destino) ;                       
                        echo $mensaje = "<p>Container nro: " . $container->getNumero() . "<br>" . "Pais: " . $container->getPais(). "<br>" . "Foto: " . $archivo . "<br>". " dado de Alta con exito </p>" ;
                        echo "<br>"."<br>"."<img src='". $destino." ' border='0' width='300' height='100'>" . "<br><br>" ;
                        }
                        else {
                                echo "<p> el archivo: ".  $archivo . " ya existe </p>";        
                             }
                        
                        if(file_exists($temporal)){                            
                            unlink($temporal);
                         }
                        }    
                        else{
                             echo $mensaje = "<p> el archivo esta vacio </p>";
                            }
                        }     
                
                         echo $volverListado ;
                        break; 
    case  'Baja' : 
                        $cont = $_POST['container']  ;
                        $valor =Container::baja($cont);
                        if($valor)
                         {
                         echo $mensaje = "<p>" . "Container nro: " . $cont ." eliminado </p>"   ;                             
                        }
                        else{
                            echo $mensaje = "<p>" . "Error al eliminar el Container nro: " . $cont ."</p>"    ;
                        } 
                        echo $volverListado ;
                        break;

    case 'filtrar':
                        $pais = $_POST['pais'];                           
                        echo Container::filtrado($pais);
        
                        break;
}
    
    
/*echo "<pre>" ;
                        print_r($_FILES) ;
                        echo "</pre>" ;*/


?>
    
</body>
</html>





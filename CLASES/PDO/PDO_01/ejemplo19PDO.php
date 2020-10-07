<!DOCTYPE html>
<html>
     <head>
        <title> Ejempos PHP</title>
         

        <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
      <div class="container">
            <div class="page-header">
                <h1>Ejemplos de PHP</h1>      
            </div>
            <div class="jumbotron">
                <h3 class="text-info">Método de instancia para Modificar.</h3>
                    <div class="well well-sm text-info">
                                 $arraysDeCd =usuario::TraerTodoLosUsuarios();<br>
                                 echo "creo la tabla"<br>
                                


                                  foreach ($arraysDeCd as $cd) {<br>
                                   //formo el contenido de las celdas<br>
                                  }<br>
                                  echo" cierro la tabla"; <br>
                                    ?><br>
                                 


                                    
                    </div>
             </div>
             <h3 >  Método de la clase  </h3>
                                    <?php
                                    include_once ("clases/AccesoDatos.php");
                                    include_once ("clases/Usuario.php");

                                   $arraysDeCd =Usuario::TraerTodoLosUsuarios();

                                  echo" <table class='table  '>
                                    <thead>
                                      <tr>
                                        <th>Modificar</th>
                                        <th>borrar</th>
                                        <th>Nombre</th>
                                        <th>Clave</th>
                                   
                                      </tr>
                                    </thead>";



                                  foreach ($arraysDeCd as $Usuario) {
                                    echo "<tr>
                                        <td> <a class='btn btn-warning' onClick=modificar($Usuario->Id) >Modificar</a></td>
                                        <td> <a class='btn btn-danger' onClick=BorrarId($Usuario->Id)>Borrar</a></td>
                                        <td>$Usuario->Id</td>
                                        <td>$Usuario->Nombre</td>
                                        <td>$Usuario->Clave</td>
                                      </tr>";
                                  }
                                  echo" </table>"; 
                                    ?>
                            <a class="btn btn-info" href="indexPDO.html">Menu principal</a>


                  </div>

    </body>
     <script type="text/javascript" src="js/jquery.min.js"></script>
          <script type="text/javascript" src="js/funciones.js"></script>
     
</html>




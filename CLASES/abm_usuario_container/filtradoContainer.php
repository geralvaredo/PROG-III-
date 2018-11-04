<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/estilo.css"> 
    <script type='text/javascript' src = 'js/funciones.js' ></script>
    <title>FILTRADO</title>
</head>
<?php include ("clases/Container.php"); ?>
<body>


      <div class="page-header">
        <h1 align="center" >FILTRADO DE CONTAINERS</h1>
        </div> 


 <div class="container" >
      <div  class="col-xs-3" > 
           <div class="formulario">
            <form action="" method="post">
             <label for="FILTRAR POR PAIS"> FILTRAR POR PAIS</label>
              <input type="text" name="pais" class="form-control" placeholder="ingrese pais a filtrar">
              <br>
              <input type="submit" class="btn btn-success" name="accion" id="filtrar" value="filtrar" > 
            </form>
            
              
              
          </div>
     </div>
 </div>
<br>
 <div class = "container">
        <div  class="table-responsive" >
            <?php 
                $pais = "";
                if(!isset($_POST['accion']))
               {
                   echo Container::traerContainer();
               }
                else
                {
                   $pais = $_POST['pais'];  
                    echo  Container::filtrarPorPais($pais);    
                }          
                      
                 
        ?>  

     </div>
    </div>






</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/estilo.css"> 
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"> </script>
      <script src="//code.jquery.com/jquery-latest.js"></script>
    <script type='text/javascript' src = 'js/funciones.js' ></script>
    <title>Container</title>
    
</head>
<body>
 <div class="container">
        <div class="page-header">
        <h1 align="center" class="menu-principal" >CONTAINER</h1>
        </div>  

        <div class="col-xs-3" > 
           <div class="formulario">
            <form action="nexo.php" enctype="multipart/form-data" multiple accept = "image/png,.jpg,image/gif" method="POST">
          <br><br>       
          <label  for="NUMERO">NUMERO</label>    
          <input type="text"class="form-control" id="numero" name="numero" placeholder="ingrese numero" required >
         <br><br>
          <label  for="DESCRIPCION">DESCRIPCION</label> 
         <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="ingrese descripcion" required>  
           <br><br>
         <label  for="PAIS">PAIS</label> 
         <input type="text" class="form-control" id="pais" name="pais" placeholder = "ingrese pais" required>
         <br><br>
         <label  for="FOTO">FOTO</label> 
         <input type="file" class="form-control" id="archivo" name="archivo">          
         <br><br> 
         <input class="btn btn-primary btn-default" type="submit" name="accion" value="Alta" onclick="" >        
         <a href="javascript:history.back(-1);" name="volver" class="btn btn-info" title="Volver" onclick="recargar()">Volver</a>   
                  
               </form>
      
        </div>
          </div>  
    </div>
    
</body>
</html>
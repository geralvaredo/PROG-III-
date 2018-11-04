<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/estilo.css"> 
      
    <title>Login</title>
</head>
<body>
      <div class="container">
      
      <div class="page-header">
        <h1 align="center" >INGRESO</h1>
        </div>  

        <div  class="col-xs-3" > 
           <div class="formulario">

    <form action="nexo.php" enctype="multipart/form-data" method="POST">
      <br><br> 
      <label  for="NOMBRE">USUARIO</label>    
      <input type="text" class="form-control"  name="usuario"  placeholder="ingrese nombre">
      <br><br>
      <label  for="CONTRASEÑA">CONTRASEÑA</label> 
      <input type="password" class="form-control" name="clave" placeholder="ingrese contraseña">
      <br><br> 
      <input class="btn btn-primary btn-default" type="submit" name="accion" value="ingresar">
        
      <a href="inicio.html" class="btn btn-info" title="Volver">Volver</a>
      </form>
       
       
       
        </div>
           </div>
      

    </div>
   
     
      
      
      
   
    </body>
</html>
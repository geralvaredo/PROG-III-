
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/ingreso.css" rel="stylesheet">
<html>
<head>
  <title></title>

<?php

session_start();
if(!isset($_SESSION['usuario']))
{
  ?>
    <div id="formLogin" class="container">

      <form  class="form-ingreso " onsubmit="validarLogin();return false;">
        <h2 class="form-ingreso-heading">Ingrese sus datos</h2>
        <label for="correo" class="sr-only">Correo electrónico</label>
                <input type="text" id="correo" value="<?php if(isset($_COOKIE['registro'])) echo $_COOKIE['registro']; ?>" class="form-control" placeholder="Correo electrónico" required="" autofocus="" value="<?php  if(isset($_COOKIE["registro"])){echo $_COOKIE["registro"];}?>">
        <label for="clave" class="sr-only">Clave</label>
        <input type="password" id="clave" minlength="4" class="form-control" placeholder="clave" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="recordarme" checked> Recordame
          </label>
          
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
      <p></p>
      <p></p>
      </form>
       </div> <!-- /container -->
<?php
}else 
{ ?>
 <button class="btn btn-lg btn-danger btn-block" onclick="deslogear()" >Salir</button>
<?php
}
   

?>


 

 
  


<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/ingreso.css" rel="stylesheet">

    <div class="container">

      <form class="form-ingreso" onsubmit="GuardarUsuario();return false">
        <h2 class="form-ingreso-heading">Usuario</h2>
        <label for="usuario" class="sr-only">Usuario</label>
        <input type="text"  minlength="6"  id="usu" title="Se necesita un nombre de usuario" class="form-control" placeholder="Usuario">
        <label for="contrasena" class="sr-only">Contraseña</label>
        <input type="text"  minlength="6"  id="clave" title="Se necesita una contraseña"  class="form-control" placeholder="Contraseña" required="" autofocus="">
        <label for="tipo" class="sr-only">Tipo</label>
        <input type="text"     max="2099" id="tipo" class="form-control" placeholder="tipo" required="" autofocus="">
       <input readonly   type="hidden"    id="idUsuario" class="form-control" >
       
        <button  class="btn btn-lg btn-success btn-block" type="submit"><span class="glyphicon glyphicon-floppy-save">&nbsp;&nbsp;</span>Guardar </button>
     
      </form>

    </div> <!-- /container -->


    
  

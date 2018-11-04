<?php

if(!isset($_SESSION['usuario']))
{


 ?>

</head>
<body>
    <div class="container">
        <div class="page-header">
        </div>
        <div class="page-header" align="center">   
        </div>
        <div>
       
                <br/>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/funcionesLogin.js"></script>
                <input type="text" name = "nombre"  value="titulo" id="nombre"> ingrese Nombre
                <br>
                <input type="text" name = "email" id="email"> ingrese email
                <br>
                <input type="text" name = "pw"  id="pw"> ingrese contraseña
                <br>
                <input type="submit" value="Loguearse"   onclick="ValidarLogin()" name="btn"/>
                

        </div>
    <nav>
          <?php
}else{


          ?>
 <button class="btn btn-lg btn-danger btn-block" onclick="deslogear()" >Salir</button>

  <?php

}

          ?>
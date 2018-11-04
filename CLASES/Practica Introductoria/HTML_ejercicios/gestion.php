

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <title>Document</title>
</head>
<body>


<?php


switch ($_POST['boton']) 
{
    case 'EJERCICIO01':
        include("Ejercicio01/index.php ");
        break;
    case 'EJERCICIO02':
        include("Ejercicio02/index.php ");
        break;
    case 'EJERCICIO03':
        include("Ejercicio03/index.php ");
        break;
    case 'EJERCICIO04':
        include("../PROG03/Ejercicio01/index.php ");
        break;
    case 'EJERCICIO05':
        include("../PROG03/Ejercicio01/index.php ");
        break;
    case 'EJERCICIO06':
        include("../PROG03/Ejercicio01/index.php ");
        break;
    default:
        # code...
        break;
}


?>   


 


</body>
</html>




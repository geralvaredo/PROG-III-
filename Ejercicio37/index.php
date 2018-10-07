<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php $nexo = 'nexo.php?' ;
          
    ?>
</head>
<body>
    <table style ='border="1"' >
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Imagen</th>
        </tr>
        </thead>
        <tr>
            <td>Bart</td>
            <td><a href="<?php echo $nexo . $im1 = './imagenes/bart.jpg' ?>"  ><img width="100" height="100" src="./imagenes/bart.jpg"/></a></td>
        </tr>
        <tr>
            <td>Buho</td>
            <td> <a href="<?php echo $nexo . $im2 = './imagenes/buho.jpg' ?>" ><img width="100" height="100" src="./imagenes/buho.jpg"/></a> </td>
        </tr>
        <tr>
            <td>Pingüino</td>
            <td> <a href="<?php echo $nexo . $im3 = './imagenes/pinguino.jpg' ?>"  ><img width="100" height="100" src="./imagenes/pinguino.jpg"/></a> </td>
        </tr>
        <tr>
            <td></td>
            <td> 
             <form method = "POST" enctype="multipart/form-data"> <input style ='color: transparent;' type="file" name="foto">  </form>
             </td>
        </tr>
        </table>

</body>
</html>
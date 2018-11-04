<?php 


function invertir($palabra,$max)
{
    if( strlen($palabra) < $max || ($palabra=='Recuperatorio' || $palabra =='Parcial' || $palabra == 'Programacion')  )    
    {
        return 1;
    }
    else {
        return 0;
    }
}


?>
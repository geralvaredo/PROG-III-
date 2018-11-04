<?php 

 $indice = rand(0,3) ;
$operador = array("+","-","*","/") ;

$op1 = rand(1,10) ;
$op2 = rand(1,10) ;

$simbolo = $operador[$indice] ;
$resul = 0 ;

echo $op1 . "<br>" . $op2 . "<br>" ;
echo "indice : " . $indice  . "<br>"  ;


echo  $simbolo . "<br>" ; 

switch ($simbolo) 
{
    case '+':
        $resul = $op1 + $op2 ;
        echo $resul ;
        break;
    case '-':
        $resul = $op1 - $op2 ;
        echo $resul ;
        break;
  case '*':
        $resul = $op1 * $op2 ;
        echo $resul ;
        break;
  case '/':
        $resul = $op1 / $op2 ;
        echo $resul ;
        break;            
    default:
        # code...
        break;
}


?>
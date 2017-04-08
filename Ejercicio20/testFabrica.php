

<?php 

    include ("Fabrica.php") ;

    $op1 = new Operario(10,"Tevez","Carlos") ;;
    $op2 = new Operario(11,"Schelotto","Guille") ;

    $op1->setSalario(1000);
    $op2->setSalario(2000);

    $fabrica1 = new Fabrica("BBVA Frances") ;

    echo $fabrica1->Add($op1) ;

    $fabrica1->MostrarOperarios();

?>
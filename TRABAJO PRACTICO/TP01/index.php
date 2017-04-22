
<?php 
    Require("Fabrica.php") ;

    $emp1 = new Empleado("Hanamichi","Sakuragi","20164758","masculino",10,10000) ;
    $emp2 = new Empleado("Takenori","Akagi","18268742","Masculino",4,20000) ;
    $emp3 = new Empleado("Ryota","Miyagi","19349761","Masculino",7,15000);

    //echo  $emp1->ToString() ;
    
    //$emp1->Hablar("Español") ;
    
    $fabrica1 = new Fabrica("Shohoku") ;
    
    $fabrica1->AgregarEmpleado($emp1);    
    $fabrica1->AgregarEmpleado($emp2);
    $fabrica1->AgregarEmpleado($emp3);
    $fabrica1->AgregarEmpleado($emp1);
        echo "<pre>" ;
    print_r($fabrica1->ToString());
    echo "</pre>" ;
    
     //echo $fabrica1->ToString();

     echo "Sueldo :" .  $fabrica1->CalcularSueldos() . "<br>";

     echo "----------------------CAMBIOS--------------------------------" ;

     $fabrica1->EliminarEmpleado($emp2) ;
     echo "<br>" ;
     //$fabrica1->EliminarEmpleadoRepetidos();
    
     echo $fabrica1->ToString();
     
?>
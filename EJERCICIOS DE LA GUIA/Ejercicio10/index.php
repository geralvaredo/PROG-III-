<?php 

 $lapicera[0]= array('color' => "Yellow" ,
                      'marca' => "Cross" ,
                     'precio' => 100 ) ;
 $lapicera[1] = array('color' => "Red", 
                       'marca' => "Faber",
                       'precio' => 150) ;
 $lapicera[2] =  array('color' => "Cyan",
                       'marca' => "BIC",
                       'precio' => 50) ;            
                         
                         
                         
 
 
 $lapiz[0] = array("Brown","Parker",200);
 $lapiz[1] = array("Blue","JOVI",30) ;
 $lapiz[2] = array("Black", "SILVAPEN",45) ; 


foreach ($lapicera as  $item) 
{
   echo $item['color'] . "<br>";
}

for ($i=0; $i < count($lapiz); $i++) 
{ 
     echo $lapiz[0][0] ;
     break;
}



?>
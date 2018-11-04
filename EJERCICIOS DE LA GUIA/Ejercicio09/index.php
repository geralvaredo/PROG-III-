<?php 

$l1 = array('color' => "Red" ,'marca' => 'Faber castell' , 'trazo' => 'fino' , 'precio' => 15);
$l2 = array('color' => "Green" ,'marca' => 'Silvapen' , 'trazo' => 'grueso' , 'precio' => 16);
$l3 = array('color' => "Blue" ,'marca' => 'JOVI' , 'trazo' => 'grueso' , 'precio' => 17);
$l4 = array('color' => "Black" ,'marca' => 'BIC' , 'trazo' => 'fino' , 'precio' => 12);

$lapicera = array();
array_push($lapicera,$l1,$l2,$l3,$l4) ;

//var_dump($lapicera) ;
foreach ($lapicera as $item) 
{
   echo $item['marca'] . " " . $item['color'] ." " . $item['trazo']. " " . $item['precio'] ."<br>"   ;
}


?>
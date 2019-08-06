
    <?php 
     class Tabla{
         
        public static function mostrarTablaPedido($t){
           
          

            echo "<table>" ;
            $tabla = "<thead><tr><th> FECHA </th> <th> NRO.PEDIDO </th><th> NOMBRE Y APELLIDO </th><th> ESTADO </th> <th> PEDIDO </th></tr></thead>" ;
            for ($j=0; $j < count($t); $j++) { 
                $tabla .= "<tbody><tr><td>" . $t[$j]["fecha"] . "</td><td>" . $t[$j]["nroPedido"] . "</td><td>" . $t[$j]['Cliente'] . "</td><td>" . $t[$j]['Estado'] . "</td><td>" .  $t[$j]['Pedido'] . "</td></tr>" ;
            }
             $tabla .= "</tbody></table>";
             echo $tabla ;  
             
                      
        }   

       public static function exportPedido($data){

        $fileName = "export_excel" .  ".xls" ;
        // headers for download
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        
         $flag = false;
         
        foreach($data as $row) {
            if(!$flag){
                // display column names as first row
                 implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }           
             implode("\t", array_values($row)) . "\n";
            }

        exit;   
               
        
       }
     }          
    
    ?>
    




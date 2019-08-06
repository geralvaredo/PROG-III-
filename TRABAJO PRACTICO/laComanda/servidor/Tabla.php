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
             $flag = false;         
             foreach($t as $row) {
                 if(!$flag){                
                      implode("\t", array_keys($row)) . "\n";
                     $flag = true;
                     }           
                  implode("\t", array_values($row)) . "\n";
            }
             exit; 
        }
        public static function mostrarTablaProducto($t){                  
            echo "<table>" ;
            $tabla = "<thead><tr><th> FECHA </th> <th> NRO.PEDIDO </th><th> NOMBRE Y APELLIDO </th><th> ESTADO </th> <th> PEDIDO </th></tr></thead>" ;
            for ($j=0; $j < count($t); $j++) { 
                $tabla .= "<tbody><tr><td>" . $t[$j]["fecha"] . "</td><td>" . $t[$j]["nroPedido"] . "</td><td>" . $t[$j]['Cliente'] . "</td><td>" . $t[$j]['Estado'] . "</td><td>" .  $t[$j]['Pedido'] . "</td></tr>" ;
            }
             $tabla .= "</tbody></table>";
             echo $tabla ;
             $flag = false;         
             foreach($t as $row) {
                 if(!$flag){                
                      implode("\t", array_keys($row)) . "\n";
                     $flag = true;
                     }           
                  implode("\t", array_values($row)) . "\n";
            }
             exit; 
        }        
     }
    ?>
    




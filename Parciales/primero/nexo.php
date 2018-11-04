<?Php 
include ("proveedor.php");
include("pedidos.php");
$request = $_SERVER['REQUEST_METHOD'];
if($request == "POST"){
    $caso = $_POST['caso'];
    switch ($caso) {
        case 'cargarProveedor':
             $id = $_POST['id'] ;
             $nombre = $_POST['nombre'];
             $email = $_POST['email'] ;
             $temporal =  $_FILES['foto']['tmp_name'] ;
             $archivo = $_FILES['foto']['name'];
             $foto = Proveedor::guardarFoto($temporal,$archivo,$nombre);
             if(!Proveedor::validarId($id)){
                $p = new Proveedor($id,$nombre,$foto,$email) ;
                Proveedor::guardar($p);
             }
             else {
                  Echo "Ingrese un id que no exista" ;
             }
             
              
            break;
       case  'hacerPedido' :
                $idProv = $_POST['id'] ;
                $producto = $_POST['producto'];
                $cantidad = $_POST['cantidad'];           
                if(Proveedor::validarId($idProv)){
                $p = new Pedido($idProv,$producto,$cantidad);
                Pedido::guardarPedido($p);
            } 
              break;    
        case 'modificarProveedor':
            $id = $_POST['id'] ;
            $nombre = $_POST['nombre'];
            $email = $_POST['email'] ;
            $temporal =  $_FILES['foto']['tmp_name'] ;
            $archivo = $_FILES['foto']['name'];
            if(Proveedor::validarId($id)){
               $foto = Proveedor::guardarFoto($temporal,$archivo,$nombre);
               $p = new Proveedor($id,$nombre,$foto,$email) ;              
               Proveedor::modificar($p);                  
            }           
            break;              
            
        default:
            # code...
            break;
    }
    
    
}
if($request == "GET"){
    $caso = $_GET['caso'];
    switch ($caso) {
        case 'consultarProveedor':
            $nombre = $_GET['nombre'];
            echo Proveedor::validarNombre($nombre);
            break;
        case 'proveedores':
            echo "<pre>" ; 
            print_r(Proveedor::traerTodosLosProveedores());
            // Proveedor::listarTabla();
            echo "</pre>";  
            break;
        case 'listarPedidos':
            echo "<pre>" ;
            print_r(Pedido::traerPedidos());
            echo "</pre>" ; 
            break;
        case 'listarPedidoProveedor':
            $id = $_GET['id'];
            echo "<pre>" ;
            print_r(Pedido::listaProveedor($id));
            echo "</pre>" ; 
                break;
        case 'fotosBack':
            # code...
            break;            
        default:
            # code...
            break;
    }  
}
?>

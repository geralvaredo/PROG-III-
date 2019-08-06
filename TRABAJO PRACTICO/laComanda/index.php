<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
 
require_once 'composer/vendor/autoload.php';
require_once 'clases/UsuarioAPI.php' ;
require_once 'clases/PedidoAPI.php' ;
require_once 'clases/MesaAPI.php';
require_once 'clases/ProductoAPI.php' ;
require_once 'clases/AutentificadorJWT.php' ;
require_once 'clases/MiddlewareAPI.php' ;
require_once 'clases/PedidoPuesto.php' ;
require_once 'clases/EncuestaAPI.php' ;
require_once 'clases/PuestoAPI.php' ;
require_once 'clases/EstadoAPI.php' ;
require_once 'clases/Factura.php' ;
require_once 'clases/Foto.php' ;
require_once 'clases/Tabla.php' ;

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$_REQUEST['perfil'] = "" ;
$_REQUEST['token'] = "" ;
$app->group('', function(){ 
   
   $this->post("/altaUsuario",\UsuarioAPI::class . ':insertarUsuario');
   $this->post("/login",\UsuarioAPI::class . ':tokenUsuario')->add(\MiddlewareAPI::class . ':loginUsuario');  
  
   $this->group('/', function (){        
       
       $this->post('asignacion', \PedidoAPI::class . ':asignarEmpleado')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('altaPedido', \PedidoAPI::class . ':insertarPedido')->add(\MiddlewareAPI::class . ':VerificarUsuario');       
       $this->post('altaProducto', \ProductoAPI::class . ':insertarProd')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('altaFoto', \PedidoAPI::class . ':enviarFoto');
       $this->post('altaMesa', \MesaAPI::class . ':mesaNueva');
       $this->post('altaPuesto', \PuestoAPI::class . ':insertarPuesto');
       $this->post('altaEncuesta', \EncuestaAPI::class . ':insertarEncuesta');
       $this->post('altaEstado', \EstadoAPI::class . ':insertarEstado');
       $this->get('solicitarMesa', \MesaAPI::class . ':solicitudMesa');
       $this->post('estadoMesa', \MesaAPI::class . ':estado')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       
   });
   $this->group('/', function () {

       $this->post('eliminarUsuario', \UsuarioAPI::class . ':bajaUsuario')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarPedido', \PedidoAPI::class . ':bajaPedido')->add(\MiddlewareAPI::class . ':VerificarUsuario');
       $this->post('eliminarMesa', \MesaAPI::class . ':bajaMesa');
       $this->post('eliminarFoto', \PedidoAPI::class . ':bajaFoto');
       $this->post('eliminarProducto', \ProductoAPI::class . ':bajaProducto')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarEncuesta', \EncuestaAPI::class . ':bajaEncuesta');
       $this->post('eliminarPuesto', \PuestoAPI::class . ':bajaPuesto')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarEstado', \EstadoAPI::class . ':bajaEstado');
       $this->post('eliminarAsignacion', \PedidoAPI::class . ':bajaAsignacion')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
   });

    $this->group('/', function () {

      $this->post("modificarUsuario",\UsuarioAPI::class . ':modifUsuario');
      $this->post("modificarPedido",\PedidoAPI::class . ':modifPedido');
      $this->post("cancelacionPedido",\PedidoAPI::class . ':cancelarPedido');
      $this->post('modificarMesa', \MesaAPI::class . ':modifMesa');
      $this->post('modifFoto', \PedidoAPI::class . ':modificarFoto');
      $this->post('modificarProducto', \ProductoAPI::class . ':modifProducto');
      $this->post('modificarEncuesta', \EncuestaAPI::class . ':modifEncuesta');
      $this->post('modificarPuesto', \PuestoAPI::class . ':modifPuesto');
      $this->post('modificarEstado', \EstadoAPI::class . ':modifEstado');
      $this->post('reasignar', \PedidoAPI::class . ':reasignarEmpleado');
      $this->post('estadoPedido', \PedidoAPI::class . ':cambioPedido'); 
      $this->post('estimacionPedido', \PedidoAPI::class . ':estimacion'); 
  
    });
    $this->group('/', function () {
        $this->get('pedidos', \PedidoAPI::class . ':listaPedidos');
       $this->get('pedidoMasVendido', \PedidoAPI::class . ':listaPedidoMasVendido');
       $this->get('pedidoMenosVendido', \PedidoAPI::class . ':listaPedidoMenosVendido');
       $this->get('pedidosDemorados', \PedidoAPI::class . ':entregasDemoradas'); 
       $this->get('pedidosCancelados', \PedidoAPI::class . ':cancelaciones');       
       $this->get('mesaMuyUsada', \MesaAPI::class . ':mesaMasUsada') ;
       $this->get('mesaPocoUsada', \MesaAPI::class . ':mesaMenosUsada') ;
       $this->get('mesaMayorImporte', \MesaAPI::class . ':mesaConMayorFactura') ; 
       $this->get('mesaMenorImporte', \MesaAPI::class . ':mesaConMenorFactura') ; 
       $this->get('mesaMasFacturada', \MesaAPI::class . ':mesaMasFact') ;
       $this->get('mesaMenosFacturada', \MesaAPI::class . ':mesaMenosFact') ;       
       $this->post('facturacionEspecifica', \MesaAPI::class . ':facturacionMesa') ;
       $this->get('mejoresComentarios', \EncuestaAPI::class . ':mesaMenosUsada') ;
       $this->get('peoresComentarios', \EncuestaAPI::class . ':mesaMenosUsada') ;
       $this->get('clientes', \UsuarioAPI::class . ':listadoClientes');  
       $this->get('listadoPedidos', \PedidoAPI::class . ':pedidosIdEmpleado');
       $this->get('listaEmpleados', \UsuarioAPI::class . ':listarEmpleados');
       $this->post('listaOperacionSector', \PedidoAPI::class . ':listaPedidoPorSectorEmpleado');
       $this->get('listaOperacionEmpleado', \PedidoAPI::class . ':listaPedidoPorEmpleado'); 
       $this->post('listaOperacionPuesto', \PedidoAPI::class . ':listaPedidoPorSector');
    });
   //
  });

$app->run();
?>
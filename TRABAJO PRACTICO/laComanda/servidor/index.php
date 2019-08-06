<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
 
require_once 'laComanda/composer/vendor/autoload.php';
require_once 'laComanda/clases/UsuarioAPI.php' ;
require_once 'laComanda/clases/PedidoAPI.php' ;
require_once 'laComanda/clases/MesaAPI.php';
require_once 'laComanda/clases/ProductoAPI.php' ;
require_once 'laComanda/clases/AutentificadorJWT.php' ;
require_once 'laComanda/clases/MiddlewareAPI.php' ;
require_once 'laComanda/clases/PedidoPuesto.php' ;
require_once 'laComanda/clases/EncuestaAPI.php' ;
require_once 'laComanda/clases/PuestoAPI.php' ;
require_once 'laComanda/clases/EstadoAPI.php' ;
require_once 'laComanda/clases/Factura.php' ;
require_once 'laComanda/clases/Foto.php' ;
require_once 'laComanda/clases/Tabla.php' ;
require_once 'laComanda/clases/PDF.php' ;

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
       $this->post('altaMesa', \MesaAPI::class . ':mesaNueva')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('altaPuesto', \PuestoAPI::class . ':insertarPuesto')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('altaEncuesta', \EncuestaAPI::class . ':insertarEncuesta');
       $this->post('altaEstado', \EstadoAPI::class . ':insertarEstado')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->get('solicitarMesa', \MesaAPI::class . ':solicitudMesa');
       $this->post('estadoMesa', \MesaAPI::class . ':estado')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       
   });
   $this->group('/', function () {

       $this->post('eliminarUsuario', \UsuarioAPI::class . ':bajaUsuario')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarPedido', \PedidoAPI::class . ':bajaPedido')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarMesa', \MesaAPI::class . ':bajaMesa');
       $this->post('eliminarFoto', \PedidoAPI::class . ':bajaFoto');
       $this->post('eliminarProducto', \ProductoAPI::class . ':bajaProducto')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarEncuesta', \EncuestaAPI::class . ':bajaEncuesta');
       $this->post('eliminarPuesto', \PuestoAPI::class . ':bajaPuesto')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarEstado', \EstadoAPI::class . ':bajaEstado')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
       $this->post('eliminarAsignacion', \PedidoAPI::class . ':bajaAsignacion')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
   });

    $this->group('/', function () {

        $this->post("modifHoraPedido",\PedidoAPI::class . ':horaPedido');  
      $this->post("modificarUsuario",\UsuarioAPI::class . ':modifUsuario')->add(\MiddlewareAPI::class . ':VerificarUsuario');
      $this->post("modificarPedido",\PedidoAPI::class . ':modifPedido');
      $this->post("cancelacionPedido",\PedidoAPI::class . ':cancelarPedido');
      $this->post('modificarMesa', \MesaAPI::class . ':modifMesa')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
      $this->post('modifFoto', \PedidoAPI::class . ':modificarFoto');
      $this->post('modificarProducto', \ProductoAPI::class . ':modifProducto')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
      $this->post('modificarEncuesta', \EncuestaAPI::class . ':modifEncuesta');
      $this->post('modificarPuesto', \PuestoAPI::class . ':modifPuesto')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
      $this->post('modificarEstado', \EstadoAPI::class . ':modifEstado')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
      $this->post('reasignar', \PedidoAPI::class . ':reasignarEmpleado')->add(\MiddlewareAPI::class . ':VerificarPerfilUsuario');
      $this->post('estadoPedido', \PedidoAPI::class . ':cambioPedido');
      $this->post('estimacionPedido', \PedidoAPI::class . ':estimacion');  
  
    });
    $this->group('/', function () {
        $this->get('pedidos', \PedidoAPI::class . ':listaPedidos');
        $this->get('pedidoPDF', \PedidoAPI::class . ':exportPDF');
        $this->get('pedidoExcel', \PedidoAPI::class . ':exportExcel');
        $this->get('prodPDF', \ProductoAPI::class . ':exportPDF');
        $this->get('prodExcel', \ProductoAPI::class . ':exportExcel');
        $this->get('horariosPDF', \UsuarioAPI::class . ':exportPDF');
        $this->get('horariosExcel', \UsuarioAPI::class . ':exportExcel');
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
       $this->get('mejoresComentarios', \EncuestaAPI::class . ':buenosComentarios') ;
       $this->get('peoresComentarios', \EncuestaAPI::class . ':malosComentarios') ;
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
<?php 
interface IApiPedido{
   
    public function insertarPedido($request, $response);
    public function cambioPedido($request, $response);
     public function estimacion($request, $response) ;
     public function horaPedido($request, $response) ;
    public function asignarEmpleado ($request, $response);
    public function bajaAsignacion($request, $response) ;
    public function reasignarEmpleado($request, $response) ;
    public function pedidosIdEmpleado($request,$response) ;    
    public function bajaPedido($request, $response) ;
    public function modifPedido($request, $response) ;
    public function listaPedidos($request,$response) ;
    public function listaPedidoPorSectorEmpleado($request, $response);
    public function listaPedidoPorEmpleado($request, $response) ;
    public function listaPedidoMasVendido($request, $response) ;
    public function entregasDemoradas($request,$response) ;
    public function cancelaciones($request,$response) ;
    public function enviarFoto($request,$response) ;
    public function modificarFoto($request,$response);
    public function bajaFoto($request,$response)  ;
    public function cancelarPedido($request, $response) ;    
    
}

?>
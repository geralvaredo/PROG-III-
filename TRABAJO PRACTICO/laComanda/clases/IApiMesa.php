<?php 
interface IApiMesa{
    public function solicitudMesa($request, $response);
    public function estado($request, $response) ;
    public function mesaNueva($request,$response);
    public function bajaMesa($request,$response) ;
    public function modifMesa($request,$response) ;
    public function mesaMasUsada($request,$response) ;
    public function mesaMenosUsada($request,$response);
    public function mesaConMayorFactura($request,$response);
    public function mesaConMenorFactura($request,$response) ;
    public function mesaMasFact($request,$response);
    public function mesaMenosFact($request,$response);
    public function facturacionMesa($request,$response);
}

?>
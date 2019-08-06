<?php 
interface IApiProducto{
   
    public function insertarProd($request, $response);
    public function bajaProducto($request, $response);
    public function modifProducto($request, $response);
}

?>
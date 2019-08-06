<?php 
interface IApiUsuario{
   // public function validarUsuario($request, $response,$u);
    public function insertarUsuario($request, $response);
    public function tokenUsuario($request, $response);
    public function modifUsuario($request, $response);
    public function listadoClientes($request, $response);
    public function listarEmpleados($request, $response);
}

?>
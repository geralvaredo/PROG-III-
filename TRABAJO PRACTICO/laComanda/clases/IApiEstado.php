<?php 
interface IApiEstado{
    public function insertarEstado($request, $response);
    public function bajaEstado ($request,$response) ;
    public function modifEstado ($request,$response) ;
}
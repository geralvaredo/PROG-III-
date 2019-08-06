<?php 
interface IApiEncuesta{
    public function insertarEncuesta($request, $response);
    public function bajaEncuesta($request, $response) ;
    public function modifEncuesta($request, $response) ;
   
}
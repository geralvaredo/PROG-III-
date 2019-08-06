<?php 
interface IApiPuesto{
    public function insertarPuesto($request, $response);
    public function bajaPuesto($request, $response) ;
    public function modifPuesto($request, $response) ;
}

?>
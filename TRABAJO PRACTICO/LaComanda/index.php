<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once ("clases/EmpleadoAPI.php");
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);


$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! a SlimFramework");
    return $response;

});

/*
COMPLETAR POST, PUT Y DELETE
*/
$app->group("/empleado", function(){
    $this->post("/",\EmpleadoAPI::class . ':listar');
    $this->post("/{id}",\EmpleadoAPI::class . ':listarEmpleado');
    //$this->post("/insertar",\EmpleadoAPI::class . ':insertarEmpleado');
    $this->delete("/{id}",\EmpleadoAPI::class . ':borrarEmpleado');
    $this->put("/",\EmpleadoAPI::class . ':modificarEmpleado');
});

/*


$app->post('/empleado/{id}', function (Request $request, Response $response,$args) {    
    $id = $args['id'];
    $response->getBody()->write("Listado De Empleados:");
    $objeto = new EmpleadoAPI();    
    return $empleados = $objeto->listarEmpleado($request,$response,$id) ; 
});

$app->post('/insertar', function (Request $request, Response $response) {    
    $obj = $request->getParsedBody();
    $nombre = $obj['nombre'];
    $idPuesto = $obj['idPuesto'];
    $objeto = new EmpleadoAPI();
    $objeto->nombre = $nombre ;   
    $objeto->IdPuesto = $idPuesto ;
    return $empleados = $objeto->insertarEmpleado($request,$response,$objeto) ;
});

$app->delete('/empleado/{id}', function (Request $request, Response $response, $args) {    
    $id = $args['id'];    
    $objeto = new EmpleadoAPI();    
    return $empleados = $objeto->borrarEmpleado($request,$response,$id) ;

});

$app->put('/empleado', function (Request $request, Response $response) {    
    $obj = $request->getParsedBody();
    $nombre = $obj['nombre'];
    $idPuesto = $obj['idPuesto'];
    $objeto = new EmpleadoAPI();
    $objeto->nombre = $nombre;
    $objeto->IdPuesto = $idPuesto ;
    return $empleados = $objeto->modificarEmpleado($request,$response,$objeto);

});
*/
/*
$app->put('/empleado', function (Request $request, Response $response) {    
    $response->getBody()->write("Listado De Empleados:");
    
    return $response;

});

$app->delete('/empleado', function (Request $request, Response $response) {    
    $response->getBody()->write("Listado De Empleados:");
    
    return $response;

});
*/

/*
MAS CODIGO AQUI...
*/


$app->run();
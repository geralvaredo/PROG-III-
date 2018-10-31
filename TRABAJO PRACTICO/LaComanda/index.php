<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once 
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

$app->group('/comandaAPI', function() use ($app){
     $app->group('/empleado',function() use ($app) {
         $app->get('/listar','listarEmpleados');

     });
  });


$app->post('/empleado', function (Request $request, Response $response) {    
    $response->getBody()->write("Listado De Empleados:");
    $objeto = new Empleado();

    $newRes = $response
    return $response;

});

$app->put('/empleado', function (Request $request, Response $response) {    
    $response->getBody()->write("Listado De Empleados:");
    
    return $response;

});

$app->delete('/empleado', function (Request $request, Response $response) {    
    $response->getBody()->write("Listado De Empleados:");
    
    return $response;

});


/*
MAS CODIGO AQUI...
*/


$app->run();
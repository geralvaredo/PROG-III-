<?php 
 require_once('/lib/nusoap.php');
//***********************************************************************************************///
      class Validar{
      public static function ValidarLogon($arrayUsuarios){
 

//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
       
 var_dump($arrayUsuarios);
 die();
//2.- INDICAMOS URL DEL WEB SERVICE
        //$host = 'http://localhost/ws_2/ws_2/SERVIDOR/testWS.php';
        $host = 'http://localhost:8080/log_ws_ajax/SERVIDOR/testWS.php';
        
//3.- CREAMOS LA INSTANCIA COMO CLIENTE
    $client = new nusoap_client($host . '?wsdl');

//3.- CHECKEAMOS POSIBLES ERRORES AL INSTANCIAR
        $err = $client->getError();
   

//4.- INVOCAMOS AL METODO SOAP, PASANDOLE EL PARAMETRO DE ENTRAD
        $result = $client->call('ValidarLogon',array($arrayUsuarios));
     
          
            
//5.- CHECKEAMOS POSIBLES ERRORES AL INVOCAR AL METODO DEL WS 
        
       
    }

}

 ?>
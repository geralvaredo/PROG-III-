<?php 
///***********************************************************************************************///
///COMO PROVEEDOR DEL SERVICIO WEB///
///***********************************************************************************************///
//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
	require_once('../lib/nusoap.php'); 
	require_once('AccesoDatos.php');
	require_once('usuario.php');	

//2.- CREAMOS LA INSTACIA AL SERVIDOR
	$server = new nusoap_server(); 

//3.- INICIALIZAMOS EL SOPORTE WSDL (Web Service Description Language)
	$server->configureWSDL('Mi Web Service #2', 'urn:testWS'); 
	

	$server->register('ValidarLogon',                	
				array('arrayUser' => 'xsd:Array'),    
				array('return' => 'xsd:Array'),   
				'urn:testWS',                		
				'urn:testWS#ObtenerTodosLosCds',             
				'rpc',                        		
				'encoded',                    		
				'Inserta un cd en la base de datos'    			
			);
	$server->register('TraerTodos',                	
						array(),  
						array('return' => 'xsd:Array'),   
						'urn:wsPdo',                		
						'urn:wsPdo#TraerTodos',             
						'rpc',                        		
						'encoded',                    		
						'Inserta un cd en la base de datos'    			
					);
	$server->register('AltaUsuario',                	
						array('arrayAlta' => 'xsd:Array'),  
						array('arrayAlta' => 'xsd:Array'),   
						'urn:wsPdo',                		
						'urn:wsPdo#AltaUsuario',             
						'rpc',                        		
						'encoded',                    		
						'Inserta un cd en la base de datos'    			
					);
$server->register('BajaUsuario',                	
						array('arrayAlta' => 'xsd:Array'),  
						array(),   
						'urn:wsPdo',                		
						'urn:wsPdo#AltaUsuario',             
						'rpc',                        		
						'encoded',                    		
						'Inserta un cd en la base de datos'    			
					);
$server->register('TraerUsuario',                	
				array('arrayUser' => 'xsd:Array'),    
				array('return' => 'xsd:Array'),   
				'urn:testWS',                		
				'urn:testWS#ObtenerTodosLosCds',             
				'rpc',                        		
				'encoded',                    		
				'Inserta un cd en la base de datos'    			
			);

$server->register('ModificarUsuario',                	
						array('arrayAlta' => 'xsd:Array'),  
						array('arrayAlta' => 'xsd:Array'),   
						'urn:wsPdo',                		
						'urn:wsPdo#AltaUsuario',             
						'rpc',                        		
						'encoded',                    		
						'Inserta un cd en la base de datos'    			
					);

	$server->register('ModificarFoto',                	
						array('arrayAlta' => 'xsd:Array'), 
						array('return' => 'xsd:Array'),   
						'urn:wsPdo',                		
						'urn:wsPdo#TraerTodos',             
						'rpc',                        		
						'encoded',                    		
						'Inserta un cd en la base de datos'    			
					);


			//5.- DEFINIMOS EL METODO COMO UNA FUNCION PHP
	// function ObtenerCubo($numero) {
	 
	// 	return pow($numero, 3);
	// }

// function Insertar() {
		
// 		Cd::InsertarElCd();
// 	}


	function ValidarLogon($arrayUser)
	{
		$arrayUs=Usuario::TraerTodos();
		$bandera = false;
		foreach ($arrayUs as $usuario) {
		
			if($arrayUser[0] ==  $usuario[1])
			{
				
				if($arrayUser[1] == $usuario[2]){
					if($arrayUser[2] == $usuario[3]){
							
						return $usuario;
					}else{
						$bandera= false;
					}
				}else
				{
					$bandera= false;
				}
			}else{
				$bandera= false;
			}
		}

		if(!$bandera)
			return flase;
	}

	function TraerTodos()
	{

		return Usuario::TraerTodos();
	}
	function AltaUsuario($arrayAlta)
	{
		$usuario = new usuario(0,$arrayAlta[0],$arrayAlta[1],$arrayAlta[2],$arrayAlta[3],$arrayAlta[4]);
		return $usuario ->InsertarUsuario();
	}
	function BajaUsuario($idBaja)
	{
		$arrayUs=Usuario::TraerTodos();
		foreach ($arrayUs as $usuario) {
			if($usuario[0] == $idBaja)
			unlink("../SERVIDOR/tmp/$usuario[5]");
		}
		return Usuario::BajaUsuario($idBaja);
	}
	function TraerUsuario($idMod){
		$arrayUs=Usuario::TraerTodos();
		foreach ($arrayUs as $usuario) {
			if($usuario[0] == $idMod)
				return $usuario;
		}
	}
	function ModificarUsuario($arrayAlta)
	{

		$usuario = new usuario($arrayAlta[0],$arrayAlta[1],$arrayAlta[2],$arrayAlta[3],$arrayAlta[4],$arrayAlta[5]);
		return $usuario ->ModificarCd();
	}
	function ModificarFoto($arrayAlta)
	{
		return Usuario::ModificarFoto($arrayAlta);
	}
//6.- USAMOS EL PEDIDO PARA INVOCAR EL SERVICIO
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
	$server->service($HTTP_RAW_POST_DATA);

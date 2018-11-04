<?php 
define('METHOD','AES-256-CBC') ;
define('SECRET_KEY','007') ;
define('SECRET_IV','10');
class Enigma{    
   
    private $palabra ;

    function __construct($palabra){
       $this->palabra = $palabra ;    
    }
    
    public static function  encriptar($palabra){
        $key = hash('sha256',SECRET_KEY) ;
        $iv = substr(hash('sha256',SECRET_IV),0,16) ;
        $salida = openssl_encrypt($palabra,METHOD,$key,0,$iv) ;
        $salida = base64_encode($salida) ;
        return $salida;
    }
    
   public static function  desencriptar(){
        $listaDePalabras = array() ;
        $archivo = fopen("archivo.txt","r") ;
        while(!feof($archivo)){
            $encriptados = fgets($archivo) ;
            $palabra = explode('-',$encriptados);
            $palabra[0] = trim($palabra[0]);
            $key = hash('sha256',SECRET_KEY) ;
            $iv = substr(hash('sha256',SECRET_IV),0,16) ;
            $salida = openssl_decrypt( base64_decode($palabra[0]),METHOD,$key,0,$iv) ;
            $listaDePalabras[] = $salida ;
        }
          
        fclose($archivo) ;
        return $listaDePalabras;
    }   
    
   public static function guardar($encriptado){
    $resultado = false;
    $archivo = fopen("archivo.txt","a");
    if(fwrite($archivo,$encriptado . "-")){
      $resultado = true ;
    }
    fclose($archivo) ;

    return $resultado;

    
   } 


}



?>

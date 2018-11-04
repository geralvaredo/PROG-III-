<?php

    class Usuario {

       private $nombre;
       private $correo;
       private $edad;
       private $clave;  

        function getNombre()
        {
            return $this->nombre;
        }
                        
         function getCorreo()
        {
            return $this->correo;
        }
         function getEdad()
        {
            return $this->edad;
        }
         function getClave()
        {
            return $this->clave;
        }


       function __construct($nombre ,$correo,$edad,$clave)
       {
            $this->nombre = $nombre; 
            $this->correo = $correo ;
            $this->clave  = $clave ;
            $this->edad   = $edad; 
         
        }

      function toString()
      {
         return $this->getNombre() . "-" . $this->getCorreo() . "-" . $this->getEdad(). "-" . $this->getClave() . "\n" ;
      }
        public static function leer()
        {
          $listaDeUsuarios=  array();
          $archivo=fopen("usuario.txt","r");
          while(!feof($archivo))
          {
            $renglon=fgets($archivo);
            $usuario=explode("-",$renglon);
            $usuario[0]=trim($usuario[0]);
            
            if($usuario[0]!="" )
              $listaDeUsuarios[]= new Usuario(trim($usuario[0]),trim($usuario[1]),trim($usuario[2]),trim($usuario[3]));
               
                       
          }

          fclose($archivo);
          return $listaDeUsuarios;            
  }

    static function  altaUsuario($usuario)
    {
        $resultado = false;
        $path = 'abm_usuario_container/usuario.txt' ;
        if(file_exists($path)){
            $archivo =  fopen("usuario.txt","w") ;
            fwrite($archivo, $usuario->ToString()) ;
            fclose($archivo);
            $resultado = true;
        }
        else{
            $archivo =  fopen("usuario.txt","a") ; 
            fwrite($archivo, $usuario->ToString()) ;
            fclose($archivo);
            $resultado = true;
            }    
            
            return $resultado;
    }
    public static function baja($usuario)
    {
       // var_dump($usuario);
        
       
        if($usuario === NULL) {
            return FALSE ;
        }
            
         $resultado = true;
        $listaUsuarios = Usuario::leer();
        $listaActualizada = array();
        
        for($i=0; $i<count($listaUsuarios); $i++){
           if( $listaUsuarios[$i]->nombre == $usuario){//encontre el borrado, lo excluyo
               continue;
         }
             $listaActualizada[$i] = $listaUsuarios[$i];
          }
                    //echo  "<pre>" ;    
                  //print_r($listaUsuarios) ;
                  //echo "</pre>";
                
               /*  echo  "<pre>" ;    
                 print_r($listaActualizada) ;
                  echo "</pre>"; 
        */
              
        $archivo = fopen("usuario.txt","w") ;
        

        foreach($listaActualizada as $usuario )
        {
           $cant = fwrite($archivo,$usuario->Tostring());
            if($cant< 1){
                $resultado = false;
                break;
            
        }
      }
        /*for($i=0 ; $i< count($listaActualizada); $i++ )
        {         
          }  
         */      
        fclose($archivo) ;
        
        return $resultado ; 
        
    }
        
  
 
      public static function verificacion($usu,$cn)
	{
        
         $verificado = false;  
		     $lista = Usuario::leer();
          
          foreach($lista as $usuario)   
          {
            
              if($usuario->getNombre() == $usu && $usuario->getClave() 
                == $cn)
              {
                  $verificado = true;
              }
          }
         // var_dump($verificado) ;
          return $verificado ;
          
	}   
       
   
        
        
        
    }
    



?>